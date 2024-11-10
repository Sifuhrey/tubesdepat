<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller {
  public function index() {
    $products = Product::get();
    return view('index', [
      'products' => $products
    ]);
  }
  public function store(Request $request) {
    try {
      // Validasi data yang dikirim oleh pengguna
      $request->validate([
        'productname' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'price' => 'required|numeric',
        'stock' => 'required|numeric',
        'description' => 'required',
        'imgname' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);

      // Proses upload file gambar (jika ada)
      $imagePath = null;
      if ($request->hasFile('imgname')) {
        $imagePath = $request->file('imgname')->store('products', 'public');
      }

      // Simpan data produk ke database
      $product = new Product();
      $product->productname = $request->input('productname');
      $product->category = $request->input('category');
      $product->price = $request->input('price');
      $product->stock = $request->input('stock');
      $product->description = $request->input('description');
      $product->imgname = $imagePath;
      $product->save();

      // Redirect atau response setelah data berhasil disimpan
      return redirect('/')->with('success', 'Product created successfully.');
    } catch (\Exception $e) {
      // Catat pesan error ke log Laravel
      Log::error('Error creating product: ' . $e->getMessage());

      // Redirect atau response saat terjadi error
      return redirect()->back()->with('error', 'Failed to create product. Please try again later.');
    }
  }
}
