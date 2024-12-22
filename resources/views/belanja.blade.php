<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans bg-gray-100">
    @yield('content')
    @extends('layouts.app')

@section('content')
<main class="bg-white">
    <!-- Header with the Logo and Username -->
    <header class="bg-[#cdb77f] sticky top-0 flex items-center gap-4 p-4">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-16 cursor-pointer">
        <p class="text-white">{{ auth()->user()->name }}</p>
    </header>

    <!-- Main Content Section -->
    <div class="px-4 py-6">
        <h1 class="text-xl font-semibold text-gray-800 mb-4">Checkout</h1>

        <div class="flex gap-6">
            <!-- Address Selection Section -->
            <div class="flex-1">
                <h2 class="text-lg font-semibold mb-2">Alamat Pengiriman</h2>

                <!-- Address List Loop -->
                @foreach ($addresses as $address)
                    <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                        <h3 class="font-semibold">{{ $address->label }}</h3>
                        <p>{{ $address->address }}</p>

                        <!-- Button to select this address -->
                        <a href="{{ route('checkout.show', ['idcart' => $idcart, 'alamatId' => $address->id]) }}" 
                           class="text-blue-500 hover:underline mt-2 inline-block">
                           Pilih Alamat
                        </a>
                    </div>
                @endforeach

                <!-- Form to add a new address -->
                <div class="bg-white p-4 rounded-lg shadow-md mt-6">
                    <h3 class="font-semibold mb-4">Tambah Alamat Baru</h3>
                    <form action="{{ route('checkout.store_address') }}" method="POST">
                        @csrf
                        <label for="address" class="block text-sm font-semibold mb-2">Alamat</label>
                        <textarea name="address" id="address" rows="4" class="w-full p-2 border rounded-lg" required></textarea>

                        <label for="label" class="block text-sm font-semibold mt-4 mb-2">Label Alamat</label>
                        <input type="text" name="label" id="label" class="w-full p-2 border rounded-lg" required>

                        <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded-lg">Simpan Alamat</button>
                    </form>
                </div>
            </div>

            <!-- Cart Items Section -->
            <div class="flex-1">
                <h2 class="text-lg font-semibold mb-2">Item dalam Keranjang</h2>
                @foreach ($cartItems as $item)
                    <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                        <h3 class="font-semibold">{{ $item->product_name }}</h3>
                        <p>{{ $item->quantity }} x Rp{{ number_format($item->price) }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Checkout Button to Proceed -->
        <a href="{{ route('payment.details', ['total' => $total, 'idalamat' => $selectedAddressId, 'idcart' => $cartId]) }}" 
           class="mt-4 block bg-blue-500 text-white text-center py-2 rounded-lg">
           Lanjutkan Pembayaran
        </a>
    </div>
</main>
@endsection

</body>
</html>
