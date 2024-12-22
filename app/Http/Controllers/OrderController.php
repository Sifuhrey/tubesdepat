<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Shipment;

class OrderController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang sedang login
        $orders = Order::with(['product', 'transaction', 'shipment'])
                        ->where('id_user', $userId)
                        ->get();

        return view('orders', compact('orders'));
    }
    public function showCheckoutPage(Request $request)
    {
        // Fetch the logged-in user details
        $user = Auth::id();
        
        // Retrieve the alamat (addresses) associated with the user
        $addresses = Address::where('id_user', Auth::id())->get();

        // If an address id is passed, show that address
        if ($request->has('alamat')) {
            $address = Address::find($request->alamat);
        }

        // Get the cart details (keranjang)
        if ($request->has('idcart')) {
            $cartDetails = Cart::where('id_keranjang', $request->idcart)
                                    ->with('produk')  // Assume that `produk` is the relation in Keranjang model
                                    ->first();
        }
        return redirect()->route('#halamancheckout');
    }
}
