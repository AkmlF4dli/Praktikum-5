<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
       return view('products.create');
    }

    public function store(Request $request)
    {
       // Validate the request...
       $validatedData = $request->validate([
          'name' => 'required|max:255',
          'description' => 'required',
          'price' => 'required|numeric',
          'stock' => 'required|numeric'
        ]);

       $product = new Product($validatedData);
       $product->save();

       return redirect()->route('products.index')->with('success', 'Product telah dibuat dengan sukses.');
    }

    public function show(Product $product)
    {
      return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
      return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
{
    // Validate the request...
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'description' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|numeric'
    ]);

    $product->update($validatedData);

    return redirect()->route('products.index')->with('success', 'Product telah diperbarui dengan sukses.');
}

public function destroy(Product $product)
{
    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product telah dihapus dengan sukses.');
}

    /**
     * Remove the specified resource from storage.
     */
   
}
