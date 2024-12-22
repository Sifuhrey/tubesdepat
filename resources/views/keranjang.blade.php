<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Product Page</title>
</head>

<body class="bg-gray-100">




    <div class="min-h-screen bg-gray-100">
        <header class="flex justify-between items-center bg-custom-coklat shadow-md p-6">
            <div class="flex items-center">
                <img src="/storage/assets/Artboard 1.png" alt="Logo" class="w-12 h-12 cursor-pointer" onclick="window.location='{{ route('user.index') }}'">
                <p class="ml-4 text-lg font-semibold">
                    @php
                    date_default_timezone_set("Asia/Jakarta");
                    $hour = date('H');
                    $greet = match (true) {
                    $hour >= 5 && $hour <= 11=> "Selamat Pagi, ",
                        $hour >= 12 && $hour <= 14=> "Selamat Siang, ",
                            $hour >= 15 && $hour <= 17=> "Selamat Sore, ",
                                default => "Selamat Malam, ",
                                };
                                echo $greet . strtok(ucwords(auth()->user()->username), " ") . '.';
                                @endphp
                </p>
            </div>
            <form class="flex" action="/search" method="GET">
                <input type="text" name="search" placeholder="Search products..." class="border rounded-l px-4 py-2 w-60">
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-r">Search</button>
            </form>
            <div class="flex items-center space-x-4">
                <div class="button-box w-[48px] h-[48px] bg-gray-300 rounded-full shadow-md flex items-center justify-center transition-transform duration-[420ms] hover:scale-110 hover:invert">
                    <img src="{{ asset('storage/assets/like.png') }}" alt="Wishlist" class="cursor-pointer w-[30px]"
                        onclick="location.href = '{{ route('wishlist.index') }}';" />
                </div>

                <div class="button-box w-[48px] h-[48px] bg-gray-300 rounded-full shadow-md flex items-center justify-center transition-transform duration-[420ms] hover:scale-110 hover:invert">
                    <img src="{{ asset('storage/assets/user.png') }}" alt="Profile" class="cursor-pointer w-[30px]"
                        onclick="location.href = '{{ route('user.profile') }}';" />
                </div>
                <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center shadow-md hover:scale-105 transition-transform cursor-pointer" onclick="location.href = '{{ route('orders.index') }}'">
                    <img src="{{ asset('storage/assets/clipboard.png') }}" alt="Orders" class="w-6 h-6" onclick="location.href = '{{ route('orders.index') }}';">
                </div>
            </div>
        </header>

        <main class="bg-white shadow-md rounded-lg mt-6 p-6 flex flex-row flex-wrap gap-2">
            @forelse($cart as $isi)
            <div class="flex flex-col lg:flex-row space-y-4 lg:space-y-0 lg:space-x-6 my-4">
                <img src="{{ url( $isi['imgname'] )}}" alt="Product" class="w-6 h-full lg:w-1/3 rounded-lg">
                <div class="flex flex-col w-full">
                    <h1 class="text-2xl font-bold">{{ $isi['productname']}}</h1>
                    <p class="text-lg text-gray-600">Rp {{ number_format($isi['price'], 2, ',', '.') }}</p>
                    
                    <div class="mt-6">
                        <form action="{{route('checkout')}}" method="POST" class="flex space-x-4">
                            @csrf
                            <input type="hidden" name="cart_id" value="{{ $isi['id_keranjang'] }}">
                            <input type="number" name="quantity" min="1" max="{{ $isi['stock'] }}" value="{{ $isi['quantity'] }}" class="border rounded px-3 py-2 w-20">
                            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <h2 style='align-self:center;'>Keranjang kosong, Silahkan isi keranjang.</h2>
            @endforelse
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
    </div>


</body>

</html>