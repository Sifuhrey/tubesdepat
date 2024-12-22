<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wishlist</title>
  @vite('resources/css/app.css')
  <link rel="icon" href="{{ asset('storage/assets/Artboard 1.png') }}" type="image/x-icon">
</head>

<body class="font-sans bg-white">
  <!-- Header -->
  <header class="bg-[#cdb77f] h-20 flex items-center gap-8 px-8 border-b border-[#9e8d63] sticky top-0 z-50">
  <img src="{{ asset('storage/assets/Artboard 1.png') }}" alt="Logo" class="ml-4 h-16 cursor-pointer transition-transform transform hover:scale-110" onclick="location.href = '{{ route('user.index') }}';">
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
    <form method="GET" id="search-box" action="{{ route('user.index') }}" class="relative w-1/4 transition duration-300">
      <input type="search" name="search" placeholder="Search essential, groceries, and more..." 
        class="w-full h-10 rounded-lg shadow-sm bg-[#f3f9fb] pl-12 text-gray-700 focus:outline-none">
      <button type="submit" class="absolute top-2 left-2">
        <img src="{{ asset('storage/assets/search-interface-symbol.png') }}" alt="Search Icon" class="w-4 h-4">
      </button>
    </form>
    <div class="flex gap-4 ml-auto">
      <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center shadow-md hover:scale-105 transition-transform cursor-pointer" onclick="location.href='{{ route('user.cart') }}';">
        <img src="{{ asset('storage/assets/shopping-cart.png') }}" alt="Cart" class="w-6">
      </div>
      <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center shadow-md hover:scale-105 transition-transform cursor-pointer" onclick="location.href='{{ route('user.profile') }}';">
        <img src="{{ asset('storage/assets/user.png') }}" alt="Profile" class="w-6">
      </div>
      <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center shadow-md hover:scale-105 transition-transform cursor-pointer" onclick="location.href='{{ route('orders.index') }}';">
        <img src="{{ asset('storage/assets/clipboard.png') }}" alt="Orders" class="w-6">
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="flex flex-col items-center mt-8">
    <section class="featured-products w-11/12">
      <h1 class="text-2xl font-bold mb-6">Wishlist Anda</h1>

      @if ($wishlists->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          @foreach ($wishlists as $wishlist)
            <div class="product bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-2xl transition duration-300">
              <img src="{{ url($wishlist['imgname'] )}}" alt="{{ $wishlist['productname'] }}" 
                class="w-full h-40 object-cover transition duration-300 hover:scale-110">
              <div class="p-4 text-center">
                <h3 class="text-lg font-semibold">{{ $wishlist['productname'] }}</h3>
                <p class="text-gray-600">Rp{{ number_format($wishlist['price'], 2, ',', '.') }}</p>
                <div class="flex justify-between mt-4">
                  <a href="" 
                    class="btn bg-[#cdb77f] hover:bg-[#625538] text-black hover:text-white py-2 px-4 rounded shadow transition duration-300">Buy Now</a>
                  <form action="#" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                      class="btn bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded shadow transition duration-300">Remove</button>
                  </form>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <p class="text-center text-gray-500 mt-8">Anda belum memiliki wishlist.</p>
      @endif
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
