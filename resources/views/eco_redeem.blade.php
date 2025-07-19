<!DOCTYPE html>
<html>
<head>
    <title>Redeem EcoPoints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="text-success mb-4">🎁 Redeem EcoPoints</h2>

    <div class="row">
        @foreach($rewards as $reward)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $reward['name'] }}</h5>
                    <p class="card-text">Cost: <strong>{{ $reward['cost'] }} EcoPoints</strong></p>
                    <button class="btn btn-outline-success w-100">Redeem</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <a href="/shop" class="btn btn-secondary">⬅ Back to Shop</a>
</div>
</body>
</html>
