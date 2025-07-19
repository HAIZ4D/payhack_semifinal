<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EcoShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            transition: box-shadow 0.3s;
            height: 100%;
        }
        .product-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .product-image {
            height: 160px;
            object-fit: cover;
            width: 100%;
        }
        .buy-btn {
            background-color: #28a745;
            color: white;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <h2 class="mb-4 text-center">EcoFlow – Buy & Track Sustainability</h2>
    <div class="alert alert-success text-center">
        🌿 Your Total EcoPoints: <strong>{{ session('eco_points', 0) }}</strong>
        <a href="{{ route('eco.redeem') }}" class="btn btn-sm btn-outline-success ms-2">Redeem</a>
</div>


    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3">
            <div class="product-card d-flex flex-column">
                <img src="https://via.placeholder.com/200x160?text={{ urlencode($product->name) }}" class="product-image mb-2" alt="{{ $product->name }}">
                <h5>{{ $product->name }}</h5>
                <p class="text-muted">{{ $product->category }}</p>
                <p><strong>RM {{ number_format($product->price, 2) }}</strong></p>

                @if($product->eco_points > 0)
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-success">🌱 {{ $product->eco_points }} EcoPoints</span>
                </div>
                @endif

                <form method="POST" action="/donation-popup" class="mt-auto">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button class="btn buy-btn">Buy Now</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>


</body>
</html>
