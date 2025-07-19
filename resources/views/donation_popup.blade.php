@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h4>Would you like to round up your purchase?</h4>
    <p><strong>{{ $product->name }}</strong> costs RM{{ number_format($product->price, 2) }}</p>
    <p>Suggested donation: <strong>RM{{ number_format($donationAmount, 2) }}</strong> to support clean water.</p>

    <form action="/donation-submit" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <button name="accept" value="1" class="btn btn-success">Yes, Donate</button>
        <button name="reject" value="1" class="btn btn-secondary">No, Skip</button>
    </form>
</div>
@endsection