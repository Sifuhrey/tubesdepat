<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi Produk</title>
  @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans">
  <!-- Header -->
  <header class="bg-yellow-400 p-6 flex items-center justify-between">
    <img id="logo" src="{{ asset('assets/Artboard 1.png') }}" alt="Logo" class="h-12">
    <p class="text-black font-semibold">
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
  </header>

  <!-- Main Content -->
  <main class="max-w-4xl mx-auto mt-10 bg-white rounded-lg shadow-lg p-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Registrasi Produk</h1>

    <!-- Form -->
    <form action="{{route('product.store', $product->id_produk) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('POST')

      <!-- Product Name -->
      <div>
        <label for="productname" class="block text-gray-700 font-medium">Nama Produk</label>
        <input type="text" id="productname" name="productname" 
               class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:ring-yellow-300"
               placeholder="Masukkan nama produk" required>
      </div>

      <!-- Product Category -->
      <div>
        <label for="jenis_beras" class="block text-gray-700 font-medium">Kategori Produk</label>
        <select id="jenis_beras" name="jenis_beras" 
                class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:ring-yellow-300"
                required>
          <option value="null" disabled selected>Pilih Kategori</option>
          <option value="putih">Beras Putih</option>
          <option value="merah">Beras Merah</option>
          <option value="hitam">Beras Hitam</option>
          <option value="ketan">Beras Ketan</option>
          <option value="aromatik">Beras Aromatik</option>
        </select>
      </div>

      <!-- Product Price -->
      <div>
        <label for="price" class="block text-gray-700 font-medium">Harga</label>
        <input type="number" id="price" name="price" 
               class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:ring-yellow-300"
               placeholder="Masukkan harga produk" required>
      </div>

      <!-- Product Stock -->
      <div>
        <label for="stock" class="block text-gray-700 font-medium">Stok</label>
        <input type="number" id="stock" name="stock" 
               class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:ring-yellow-300"
               placeholder="Masukkan stok produk" required>
      </div>

      <!-- Product Description -->
      <div>
        <label for="desc" class="block text-gray-700 font-medium">Deskripsi Produk</label>
        <textarea id="desc" name="desc" rows="4"
                  class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:ring-yellow-300"
                  placeholder="Masukkan deskripsi produk" required></textarea>
      </div>

      <!-- Product Image -->
      <div>
        <label for="gambar" class="block text-gray-700 font-medium">Gambar Produk</label>
        <input type="file" id="gambar" name="gambar" accept="image/*"
               class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:ring-yellow-300" 
               required>
      </div>

      <!-- Submit Button -->
      <div class="text-center">
        <button type="submit" 
                class="px-6 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
          Daftar Produk
        </button>
      </div>

      @if (session('success'))
        <p class="mt-4 text-center text-green-600">{{ session('success') }}</p>
      @endif
    </form>
  </main>
</body>

</html>
