<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipment = Shipment::all();
        return view('datapengiriman', compact('shipment'));
    }
    
    public function changeStatus(Request $request, $id)
    {
        $shipment = Shipment::find($id);
        $shipment->status = $request->status;
        $shipment->waktusampai = $request->status === 'sampai' ? now() : null;
        $shipment->save();
    
        return back()->with('success', 'Status berhasil diperbarui.');
    }
}
