<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get()->take(5);
        return view('index', ['products' => $products]);
    }
    public function admin()
    {
        $products = Product::get();
        return view('productlist', ['products' => $products]);
    }
    public function create()
    {
    return view('registerproduct');
    }
    public function category($namaproduk)
    {
        $products = Product::where('category', $namaproduk)->get();
        $catename = Product::where('category', $namaproduk)->value('category');
        return view('kategori', [
            'products' => $products,
            'kate' => $catename
        ]);
    }

    public function dashboard()
    {
        $products = Product::get()->take(5);
        return view('dashboard', ['products' => $products]);
    }

    public function all()
    {
        $products = Product::get();
        return view('allproduct', ['products' => $products]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'productname' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'price' => 'required|numeric',
                'stock' => 'required|numeric',
                'description' => 'required',
                'imgname' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $imagePath = null;
            if ($request->hasFile('imgname')) {
                $imagePath = $request->file('imgname')->store('products', 'public');
            }

            $product = new Product();
            $product->productname = $request->input('productname');
            $product->category = $request->input('category');
            $product->price = $request->input('price');
            $product->stock = $request->input('stock');
            $product->description = $request->input('description');
            $product->imgname = $imagePath;
            $product->save();

            return redirect()->route('admin.main')->with('success', 'Produk berhasil terdaftar!');
        } catch (\Exception $e) {
            Log::error('Error creating product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create product. Please try again later.');
        }
    }

    public function tampilanedit($id)
    {
        $product = Product::findOrFail($id);  // Mencari produk berdasarkan ID
        return view('updateproduct', compact('product'));  // Mengirim data produk ke view
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id); // Temukan produk berdasarkan ID

        // Validasi data
        $validatedData = $request->validate([
            'productname' => 'required|string|max:255',
            'jenisberas' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'desc' => 'nullable|string',
            'imgname' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);
    
        // Jika ada file gambar baru yang di-upload
        if ($request->hasFile('imgname')) {
            // Hapus gambar lama jika ada
            if ($product->imgname) {
                Storage::delete($product->imgname);
            }
    
            // Upload gambar baru
            $validatedData['imgname'] = $request->file('imgname')->store('products', 'public');
            $product->update($validatedData);
            return redirect()->route('admin.main', $product);
        }
    
        // Update data lainnya
        $product->update($validatedData);
    
        return redirect()->route('admin.main')->with('success', 'Produk berhasil diperbarui.');
        
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Menghapus produk
        $product->delete();

        // Mengalihkan ke halaman daftar produk dengan pesan sukses
        return redirect()->route('admin.main');
    }

    public function show($namaproduk)
    {
        $product = Product::where('productname', $namaproduk)->first();
    

        if (!$product) {
            abort(404, 'Produk tidak ditemukan');
        }

        return view('deskripsi', ['product' => $product]);
    }
    
    
}
