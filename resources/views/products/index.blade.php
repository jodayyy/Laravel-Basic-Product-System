@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Product List</h1>
        <form method="GET" action="{{ route('products.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search products..." value="{{ $query ?? '' }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Name</th>
                <th style="width: 15%;">Price (RM)</th>
                <th style="width: 35%;">Details</th>
                <th style="width: 10%;">Publish</th>
                <th style="width: 10%;">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->details }}</td>
                <td>{{ $product->publish ? 'Yes' : 'No' }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No products found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
