<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('id_user', Auth::id())
        ->with('produk') // Eager load the related Produk model
        ->get()
        ->map(function ($item) {
            return [
                'productname' => $item->produk->productname,
                'price' => $item->produk->price,
                'imgname' => $item->produk->imgname,
                'id_wishlist' => $item->id_wishlist,
            ];
        });

        return view('wishlish', compact('wishlists'));
    }

    public function store(Request $request)
    {
        $wish = new Wishlist();
        $wish->id_user = Auth::id();
        $wish->id_produk = $request->id_produk;
        $wish->save();
        return redirect()->route('wishlist.index');
    }

    public function destroy($id)
    {
        Wishlist::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Product removed from wishlist.');
    }
}
