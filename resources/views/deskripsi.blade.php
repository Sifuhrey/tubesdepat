<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Deskripsi {{ $product->productname }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  @vite('resources/css/app.css')
  <link rel="icon" href="{{ asset('storage/assets/Artboard 1.png') }}" type="image/x-icon" />
</head>

<body class="font-abeezee bg-white">
  <header class="bg-[#cdb77f] h-[90px] flex items-center gap-[2vw] sticky top-0 z-10 border-b border-[#9e8d63]">
    <img id="logo" src="{{ asset('storage/assets/Artboard 1.png') }}" onclick="location.href = '{{ route('user.index') }}';" alt=""
      class="ml-[2vw] h-[80%] transition-transform duration-300 hover:scale-110" />
    <p id="usn" class="text-base">
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
    <form method="GET" id="search-box" action="searchresult.php" class="relative w-[20vw] hover:w-[25vw] transition-all duration-300">
      <input type="search" placeholder="Search essential, groceries, and more..."
        class="w-full h-[48px] border-none rounded-lg shadow bg-[#f3f9fb] pl-[44px] text-sm">
      <button type="submit"
        class="absolute top-[10px] left-[10px] bg-[#f3f9fb] rounded-full w-[32px] h-[32px] flex justify-center items-center">
        <img src="{{ asset('storage/assets/search.png') }}" alt="" class="w-[18px] h-[18px]" />
      </button>
    </form>
    <div class="flex items-center space-x-4">
      <div class="w-12 h-12 p-2 bg-gray-300 rounded-full flex items-center justify-center shadow-md hover:scale-105 transition-transform cursor-pointer">
        <img src="{{ asset('storage/assets/shopping-cart.png') }}" alt=""  onclick="location.href = '{{route('user.cart')}}'" />
      </div>
      <div class="w-12 h-12 p-2 bg-gray-300 rounded-full flex items-center justify-center shadow-md hover:scale-105 transition-transform cursor-pointer">
        <img src="{{ asset('storage/assets/like.png') }}" alt=""  onclick="location.href = '{{route('wishlist.index')}}'" />
      </div>
      <div class="w-12 h-12 p-2 bg-gray-300 rounded-full flex items-center justify-center shadow-md hover:scale-105 transition-transform cursor-pointer">
        <img src="{{ asset('storage/assets/user.png') }}" alt=""  onclick="location.href = '{{route('user.profile')}}'" />
      </div>
      <div class="w-12 p-2 h-12 bg-gray-300 rounded-full flex items-center justify-center shadow-md hover:scale-105 transition-transform cursor-pointer">
        <img src="{{ asset('storage/assets/clipboard.png') }}" alt=""  onclick="location.href = '{{route('orders.index')}}'" />
      </div>
    </div>
  </header>
  <main class="flex flex-col items-center mt-8">
    <section class="isi flex flex-wrap gap-48 justify-center md:flex-row space-y-6 md:space-y-0">
      <div class="product w-[300px] h-[300px] bg-[#d9d9d9] rounded-lg p-5 shadow flex items-center justify-center">
        <img src="{{ url($product->imgname) }}" alt="Product 1" class="brightness-90 rounded-sm" />
      </div>
      <div class="bayar w-[300px] flex flex-col items-start">
        <div class="text space-y-2">
          <h1 class="text-2xl font-bold">{{ $product->productname }}</h1>
          <h2 id="harga" class="text-xl font-semibold text-gray-800">Rp.{{ number_format($product->price, 2, ',', '.') }}/kg</h2>
          <h3 class="text-lg">Sisa {{ $product->stock }} pcs</h3>
        </div>
        <div class="container bg-[#d9d9d9] rounded-lg p-5 mt-5 shadow space-y-3">
          <h3 class="font-bold">Atur Jumlah</h3>
          <input type="number" name="stok" id="amount" min="1" max="{{ $product->stock }}"
            class="w-full h-10 text-center rounded shadow-inner border border-gray-200 focus:outline-none" />
          <h3>Sub Total</h3>
          <h3 id="subtotal" class="text-lg font-bold"></h3>
          <div class="tombol flex gap-5">
            <a href=""
              id="keranjang" class="btn bg-[#cdb77f] hover:bg-[#766947] text-black hover:text-white px-5 py-2 rounded shadow transition duration-300">
              Keranjang
            </a>
            <a href="{{ route('wishlist.store',['id_produk'=> $product->id_produk]) }}"
              class="btn bg-[#cdb77f] hover:bg-[#766947] text-black hover:text-white px-5 py-2 rounded shadow transition duration-300">
              Wishlist
            </a>
          </div>
        </div>
      </div>
    </section>
    <div class="description mx-40">
          <h2 class="text-2xl font-semibold">Jenis Beras : Beras {{ ucfirst($product->category) }} </h2>
          <br>
          <h2>Deskripsi</h2>
          <p class="font-semibold"> {{ $product->description}} </p>
        </div>

  </main>
</body>
<script>
    // Get the price from the server-side variable
    const price = {{ $product->price }}; // Ensure $data['price'] is passed correctly
    
    // Select DOM elements
    const jumlah = document.getElementById("amount"); // Input for amount
    const subtotalElement = document.getElementById("subtotal"); // Where subtotal will be displayed

    // Add event listener to calculate subtotal
    jumlah.addEventListener("input", function () {
        const amount = parseFloat(jumlah.value) || 0; // Safeguard for invalid inputs
        const sub = price * amount; // Calculate subtotal

        // Format and display the subtotal
        subtotalElement.innerHTML = "Rp. " + new Intl.NumberFormat('id-ID').format(sub);
    });
    document.getElementById('keranjang').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior

        const amount = document.getElementById('amount').value; // Get the input value
        const maxStock = {{ $product->stock }}; // Get the maximum stock from Blade
        const productId = {{ $product->id_produk }}; // Get the product ID from Blade

        if (amount < 1 || amount > maxStock) {
            alert(`Please enter a valid quantity between 1 and ${maxStock}`);
            return;
        }

        // Redirect to the route with dynamic quantity
        const url = `{{ route('cart.store', ['id_produk' => ':id_produk', 'quantity' => ':quantity']) }}`
            .replace(':id_produk', productId)
            .replace(':quantity', amount);

        window.location.href = url;
    });
</script>

</html>
