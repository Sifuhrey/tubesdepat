<?php

namespace App\Http\Controllers;

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
}
