<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // ensure user is logged in
    }

    // show the product listing page
    public function index(Request $request)
    {
        $query = $request->input('search'); // Get the search input

        // Fetch products based on search query
        $products = Product::when($query, function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
              ->orWhere('details', 'like', '%' . $query . '%');
        })->get();

        return view('products.index', compact('products', 'query'));
    }

    // show the form to add a new product
    public function create()
    {
        return view('products.create');
    }

    // store a newly created product in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'details' => 'required',
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'publish' => $request->publish ?? false,
        ]);

        return redirect()->route('products.index');
    }

    // show the details of a single product
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // show the form to edit an existing product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // update an existing product in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'details' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'publish' => $request->publish ?? false,
        ]);

        return redirect()->route('products.index');
    }

    // delete a product from the database
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index');
    }
}
