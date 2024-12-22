<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('storage/assets/Artboard 1.png') }}" type="image/x-icon" />
    @vite('resources/css/app.css')
</head>
<header class="bg-[#cdb77f] sticky top-0 z-10 border-b border-[#9e8d63] flex items-center p-4 gap-6">
    <img id="logo" src="{{ asset('storage/assets/Artboard 1.png') }}" class="h-10 w-auto cursor-pointer hover:scale-110 transition-transform duration-300" 
        alt="Logo" onclick="location.href='/dashboard';">
    <p class="text-lg">
    @php
            date_default_timezone_set("Asia/Jakarta");
            $hour = date('H');
            if ($hour >= 5 && $hour <= 11) {
                $greet="Selamat Pagi, " ;
                } elseif ($hour>= 12 && $hour <= 14) {
                    $greet='Selamat Siang, ' ;
                    } elseif ($hour>= 15 && $hour <= 17) {
                        $greet='Selamat Sore, ' ;
                        } else {
                        $greet='Selamat Malam, ' ;
                        }
                        echo $greet . strtok(ucwords(Auth::user()->username), " ") . '.';
                        @endphp
    </p>
    <div class="ml-auto w-12 h-12 bg-gray-300 rounded-full flex justify-center items-center">
        <img src="{{ asset('storage/assets/list.png') }}" class="h-6 w-auto cursor-pointer" alt="List" onclick="location.href='{{route('admin.main')}}'">
    </div>
</header>

<main class="flex flex-col items-center justify-center mt-10">
    <h1 class="text-2xl font-bold mb-6">Ubah Data Produk {{ $product->productname }}</h1>

    <form action="{{ route('product.update',['id'=> $product->id_produk]) }}" method="POST" enctype="multipart/form-data" class="w-4/5 space-y-6">
        @csrf
        @method('PUT')

        <input type="text" name="productname" class="block w-full p-4 bg-gray-200 rounded-lg shadow focus:outline-none" 
            value="{{ old('productname', $product->productname) }}" placeholder="Nama Produk" required>

        <select name="jenisberas" class="block w-full p-4 bg-gray-200 rounded-lg shadow focus:outline-none">
            <option value="{{ $product->category }}">Beras {{ ucfirst($product->category) }}</option>
            <option value="putih">Beras Putih</option>
            <option value="merah">Beras Merah</option>
            <option value="hitam">Beras Hitam</option>
            <option value="ketan">Beras Ketan</option>
            <option value="aromatik">Beras Aromatik</option>
        </select>

        <input type="number" name="price" class="block w-full p-4 bg-gray-200 rounded-lg shadow focus:outline-none" 
            value="{{ old('price', $product->price) }}" placeholder="Harga" required>

        <input type="number" name="stock" class="block w-full p-4 bg-gray-200 rounded-lg shadow focus:outline-none" 
            value="{{ old('stock', $product->stock) }}" placeholder="Stok" min="0" required>

        <textarea name="desc" class="block w-full h-full p-4 bg-gray-200 rounded-lg shadow focus:outline-none" 
            placeholder="Keterangan Produk" required>{{ old('desc', $product->description) }}</textarea>

        <input type="file" name="imgname" class="block w-full p-4 bg-gray-200 rounded-lg shadow focus:outline-none" accept="image/*" id="">

        <button type="submit" class="px-6 py-3 bg-[#cdb77f] text-white rounded-lg shadow-md hover:bg-[#9e8d63] transition-colors">Submit</button>
    </form>
</main>

