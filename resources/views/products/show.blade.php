@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <p><strong>Price (RM):</strong> {{ $product->price }}</p>
    <p><strong>Details:</strong> {{ $product->details }}</p>
    <p><strong>Publish:</strong> {{ $product->publish ? 'Yes' : 'No' }}</p>
    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Back</a>
</div>
@endsection
