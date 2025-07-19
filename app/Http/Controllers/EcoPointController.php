<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EcoPointController extends Controller
{
    public function showRedeemPage()
    {
        // In a real app, you'd fetch user's available points & reward options
        $rewards = [
            ['name' => 'RM5 Voucher', 'cost' => 50],
            ['name' => 'Free Train Ticket', 'cost' => 80],
            ['name' => 'Eco Bottle', 'cost' => 100],
        ];

        return view('eco_redeem', compact('rewards'));
    }
}
