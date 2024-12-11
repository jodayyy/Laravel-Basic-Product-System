@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Product</h1>
    <form method="POST" action="{{ route('products.update', $product->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price (RM)</label>
            <input type="number" step="0.01" class="form-control" name="price" value="{{ $product->price }}" required>
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea class="form-control" name="details" required>{{ $product->details }}</textarea>
        </div>
        <div class="mb-3">
            <label for="publish" class="form-label">Publish</label><br>
            <input type="radio" id="publish_yes" name="publish" value="1" {{ $product->publish ? 'checked' : '' }}>
            <label for="publish_yes">Yes</label>
            <input type="radio" id="publish_no" name="publish" value="0" {{ !$product->publish ? 'checked' : '' }}>
            <label for="publish_no">No</label>
        </div>
        <button type="submit" class="btn btn-success">Update Product</button>
    </form>
</div>
@endsection
