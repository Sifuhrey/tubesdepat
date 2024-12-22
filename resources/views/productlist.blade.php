<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Produk</title>
    <link rel="icon" href="{{ asset('storage/assets/Artboard 1.png') }}" type="image/x-icon" />
    @vite('resources/css/app.css')
</head>
<body class="bg-white font-sans">
    <header class="bg-[#cdb77f] sticky top-0 z-10 shadow-md flex items-center px-8 py-4 gap-6">
        <img src="{{ asset('storage/assets/Artboard 1.png') }}" alt="Logo" class="h-16 cursor-pointer" onclick="window.location='{{ route('admin.main') }}'">
        <p class="text-lg font-semibold">
            @php
                date_default_timezone_set("Asia/Jakarta");
                $hour = date('H');
                if ($hour >= 5 && $hour <= 11) $greet = "Selamat Pagi, ";
                elseif ($hour >= 12 && $hour <= 14) $greet = "Selamat Siang, ";
                elseif ($hour >= 15 && $hour <= 17) $greet = "Selamat Sore, ";
                else $greet = "Selamat Malam, ";
            @endphp
            {{ $greet . auth()->user()->username }}
        </p>
        <div class="ml-auto flex gap-4">
            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center shadow-md cursor-pointer hover:scale-110 transition" onclick="window.location='{{ route('admin.main') }}'">
                <img src="{{ asset('storage/assets/shipment.png') }}" alt="Pengiriman">
            </div>
            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center shadow-md cursor-pointer hover:scale-110 transition" onclick="window.location='{{ route('admin.main') }}'">
                <img src="{{ asset('storage/assets/payment.png') }}" alt="Pembayaran">
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-gray-300 px-6 py-2 rounded-md shadow-md hover:scale-110 transition">Keluar Admin</button>
            </form>
        </div>
    </header>

    <main class="flex flex-col items-center py-8">
        <h1 class="text-2xl font-bold mb-6">Daftar Produk</h1>
        <a href="{{ route('product.store') }}" class="bg-[#cdb77f] px-8 py-3 rounded-md shadow-md text-lg font-semibold hover:scale-110 transition">Tambah Produk</a>
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8 w-11/12">
            @foreach ($products as $product)
            <article class="bg-[#cdb77f] rounded-lg shadow-md p-6 flex flex-col items-center gap-4">
<img src="{{ Storage::url($product->imgname) }}" alt="Product Image" class="w-40 h-40 object-cover rounded-md">
            <div class="text-center">
                    <h2 class="text-xl font-bold">{{ $product->productname }}</h2>
                    <p>Kategori: {{ $product->formatted_category }}</p>
                    <p>Harga: {{ $product->formatted_price }}</p>
                    <p>Stok: {{ $product->stock }}</p>
                    <p>Deskripsi: {{ $product->description }}</p>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('product.edit', $product->id_produk) }}" class="bg-gray-300 px-4 py-2 rounded-md shadow-md hover:scale-110 transition">Edit</a>
                    <form method="POST" action="{{ route('product.destroy', $product->id_produk) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-300 px-4 py-2 rounded-md shadow-md hover:scale-110 transition">Hapus</button>
                    </form>
                </div>
            </article>
            @endforeach
        </section>
    </main>
</body>
</html>
