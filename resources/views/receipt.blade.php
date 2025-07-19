<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Green Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="text-success">🌿 Green Receipt</h2>

    <div class="card p-4 mt-3">
        <p><strong>Product:</strong> {{ $product->name }}</p>
        <p><strong>Category:</strong> {{ $product->category }}</p>
        <p><strong>Paid:</strong> RM {{ number_format($total, 2) }}</p>
        <p><strong>Carbon Impact:</strong> {{ $carbon }} kg CO₂</p>
        <p><strong>Eco Suggestion:</strong> {{ $suggestion }}</p>
    </div>

@if(isset($prediction))
<div class="alert alert-info mt-4">
    <h5>AI Prediction</h5>
    <ol>
        @foreach(explode("\n", $prediction) as $line)
            @if(trim($line) !== '')
                <li>{{ trim($line) }}</li>
            @endif
        @endforeach
    </ol>
</div>
@endif

    <a href="/shop" class="btn btn-outline-primary mt-3">Back to Shop</a>
</div>
</body>
</html>
