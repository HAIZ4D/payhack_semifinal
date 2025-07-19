<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Donation;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GreenReceiptController extends Controller
{
    public function generate(Request $request)
    {
        $category = ProductCategory::where('name', $request->category)->first();

        if (!$category) {
            return response()->json(['error' => 'Unknown category'], 404);
        }

        return response()->json([
            'category' => $category->name,
            'carbon_impact' => $category->carbon_per_unit . ' kg CO₂',
            'message' => "This purchase = {$category->carbon_per_unit} kg CO₂",
            'suggestion' => $category->eco_suggestion,
        ]);
    }

    public function demoForm()
    {
        return view('green_receipt_demo');
    }

    public function demoSubmit(Request $request)
    {
        $category = ProductCategory::where('name', $request->category)->first();

        if (!$category) {
            return back()->with('error', 'Category not found.');
        }

        return view('green_receipt_demo', [
            'result' => [
                'category' => $category->name,
                'carbon_impact' => $category->carbon_per_unit . ' kg CO₂',
                'message' => "This purchase = {$category->carbon_per_unit} kg CO₂",
                'suggestion' => $category->eco_suggestion,
            ]
        ]);
    }

    public function showShop()
    {
        $products = Product::all();
        return view('shop', compact('products'));
    }

    public function processCheckout(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $category = ProductCategory::where('name', $product->category)->first();
        $currentPoints = session('eco_points', 0);
$newPoints = $currentPoints + $product->eco_points;
session(['eco_points' => $newPoints]);

        return view('receipt', [
            'product' => $product,
            'carbon' => $category->carbon_per_unit,
            'suggestion' => $category->eco_suggestion,
            'total' => $product->price,
        ]);
    }

    public function donationPrompt(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $donationAmount = round(ceil($product->price) - $product->price, 2);
        $currentPoints = session('eco_points', 0);
$newPoints = $currentPoints + $product->eco_points;
session(['eco_points' => $newPoints]);

        return view('donation_popup', [
            'product' => $product,
            'donationAmount' => $donationAmount
        ]);
    }

    public function donationSubmit(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $accepted = $request->has('accept');
        $donationAmount = $accepted ? round(ceil($product->price) - $product->price, 2) : 0;
        $total = $product->price + $donationAmount;

        Donation::create([
            'product_id' => $product->id,
            'accepted' => $accepted,
            'amount' => $donationAmount,
            'total_with_donation' => $total
        ]);

        $category = ProductCategory::where('name', $product->category)->first();

        // ✅ Call Gemini AI for prediction
        $prediction = $this->getGeminiPrediction($product->name, $product->material ?? 'unknown', $category->carbon_per_unit);


        return view('receipt', [
            'product' => $product,
            'carbon' => $category->carbon_per_unit,
            'suggestion' => $category->eco_suggestion,
            'total' => $total,
            'prediction' => $prediction
        ]);
    }

public function getGeminiPrediction($product, $material, $carbon)
{
    $apiKey = env('GEMINI_API_KEY');

    // ✅ Build prompt text separately
    $text = "Give a short, simple prediction about this product's environmental impact. 
Product: $product
Carbon impact: $carbon kg CO₂.
Infer the product's likely material if not stated. 
Then respond with only 3 bullet points:
1. Effect of carbon impact 
2. Environmental effect 
3. What might happen in future if users keep buying this product.";

    // ✅ Send request to Gemini API
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
    ])->post("https://generativelanguage.googleapis.com/v1/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
        'contents' => [
            [
                'parts' => [
                    [
                        'text' => $text
                    ]
                ]
            ]
        ]
    ]);

    // ✅ Handle response
    if ($response->successful()) {
        return $response->json('candidates.0.content.parts.0.text') ?? 'No prediction generated.';
    } else {
        \Log::error('Gemini error:', $response->json());
        return 'AI request failed. Please try again.';
    }
}


}
