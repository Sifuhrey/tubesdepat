<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang sedang login
        $cart = Cart::with('produk') // Assuming a relationship exists between Cart and Produk
            ->where('id_user', $userId)
            ->whereHas('produk', function ($query) {
                $query->where('stock', '>', 0);
            })
            ->get()
            ->map(function ($isi) {
                return [
                    'productname' => $isi->produk->productname,
                    'price' => $isi->produk->price,
                    'quantity' => $isi->quantity,
                    'imgname' => $isi->produk->imgname,
                    'id_keranjang' => $isi->id_keranjang,
                    'stock' => $isi->produk->stock,
                ];
            });


        return view('keranjang', compact('cart'));
    }
    public function store($id_produk,$quantity)
    {
        $cart = Cart::where('id_user', Auth::id())
            ->where('id_produk', $id_produk)
            ->first();

        // If the product is already in the cart, update the quantity
        if ($cart) {
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            // If it's a new product, create a new cart record
            $cart = new Cart();
            $cart->id_user = Auth::id();
            $cart->id_produk = $id_produk;
            $cart->quantity = $quantity;
            $cart->save();
        }

        // Redirect to the cart page
        return redirect()->route('user.cart');
    }
}
