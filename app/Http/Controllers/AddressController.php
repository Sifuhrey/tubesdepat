<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address; // Assuming you have an Address model to interact with 'alamat' table.
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
   /**
     * Display a listing of the addresses.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all addresses
        $addresses = Address::all();
        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new address.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('tambahalamat');
    }

    /**
     * Store a newly created address in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'label' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'courier_note' => 'nullable|string|max:255',
            'postalcode' => 'required|string|max:20',
        ]);

        // Create a new address
        Address::Create(
            ['id_user' => Auth::id(),'label' => $request->input('label'),
                'address' => $request->input('address'),
                'courier_note' => $request->input('courier_note'),
                'postalcode' => $request->input('postalcode'),]
        );

        // Redirect back with a success message
        return redirect()->route('user.profile')->with('success', 'Address created successfully.');
    }

    /**
     * Show the form for editing the specified address.
     *
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\View\View
     */
    public function edit($id)
{
    // Mengambil alamat berdasarkan id
    $address = Address::findOrFail($id);

    // Mengirimkan variabel $address ke view
    return view('editalamat', compact('address'));
}
    /**
     * Update the specified address in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $alamat
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'label' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'courier_note' => 'nullable|string|max:255',
            'postalcode' => 'required|string|max:20',
        ]);

        // Update the address
        $address = Address::findOrFail($id);
        $address->label = $request->input('label');
        $address->address = $request->input('address');
        $address->courier_note = $request->input('courier_note');
        $address->postalcode = $request->input('postalcode');
        $address->save();

        // Redirect back with a success message
        return redirect()->route('user.profile')->with('success', 'Address updated successfully.');
    }

    /**
     * Remove the specified address from storage.
     *
     * @param  \App\Models\Address  $alamat
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = Address::findOrFail($id);

        // Menghapus produk
        $product->delete();

        // Mengalihkan ke halaman daftar produk dengan pesan sukses
        return redirect()->route('user.profile');
    }
    public function show(Address $alamat)
    {
        return view('addresses.show', compact('alamat'));
    }
}
