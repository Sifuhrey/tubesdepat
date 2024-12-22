<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Beras {{ucfirst($kate)}}</title>
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
  <main>
   
        <section class="featured-products container mx-auto">
            <h2 class="text-2xl font-bold mb-6">Kategori Beras {{ucfirst($kate)}}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                <div class="rounded-lg shadow-md overflow-hidden">
                    <img src="{{ url($product->imgname) }}" alt="Product" class="h-48 w-full object-cover hover:scale-110 duration-200 ease-linear transition-transform">
                    <div class="p-4 text-center bg-white">
                        <p class="font-bold">{{ $product->productname }}</p>
                        <p class="text-gray-500">Rp.{{ number_format($product->price, 2, ',', '.') }}/pcs</p>
                        <a href="{{ route('product.show', ['namaproduk' => $product->productname]) }}" class="block mt-4 bg-custom-coklat text-black rounded-md px-4 py-2 hover:bg-yellow-600 hover:scale-110 ease-linear duration-200">Buy Now</a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </main>
    <footer class="bg-[#cdb77f] text-black flex flex-wrap py-32">
        <div class="flex flex-col items-start gap-4 px-10">
            <img src="{{ asset('storage/assets/Artboard 1.png') }}" alt="Logo" class="w-[122px] h-[80px]" />
            <div class="flex items-center gap-3">
                <img src="{{ asset('storage/assets/whatsapp.png') }}" alt="WhatsApp" class="w-[35px] h-[35px]" />
                <div>
                    <p>Whatsapp</p>
                    <p>+62 812-3456-7890</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <img src="{{ asset('storage/assets/call.png') }}" alt="Call" class="w-[35px] h-[35px]" />
                <div>
                    <p>Call Us</p>
                    <p>+62 812-3456-7890</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <img src="{{ asset('storage/assets/mail.png') }}" alt="Mail" class="w-[35px] h-[35px]" />
                <div>
                    <p>E-mail</p>
                    <p>oryva@gmail.com</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col px-10">
            <h3 class="font-bold">Customer Services</h3>
            <hr class="bg-black h-[3px] w-[167px]" />
            <ul class="space-y-2">
                <li>About Us</li>
                <li>Terms & Conditions</li>
                <li>FAQ</li>
                <li>Privacy Policy</li>
                <li>E-waste Policy</li>
                <li>Cancellation & Return Policy</li>
            </ul>
        </div>
    </footer>
</body>

</html>
