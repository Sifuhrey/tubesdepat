<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Oryva</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="{{ asset('storage/assets/Artboard 1.png') }}" type="image/x-icon" />
</head>

<body class="m-0 font-abeezee bg-white">

  <!-- Header -->
  <header class="bg-[#cdb77f] h-[90px] sticky top-0 z-10 border-b border-[#9e8d63] flex items-center gap-[2vw] px-[2vw]">
    <img id="logo" src="{{ asset('storage/assets/Artboard 1.png') }}" alt="Logo"
      class="h-4/5 w-[7vw] transition-transform duration-300 hover:scale-125 cursor-pointer" onclick="location.href='{{ route('user.index') }}';"  />
    
    <p id="usn" class="text-base">
      @php
        date_default_timezone_set("Asia/Jakarta");
        $hour = date('H');
        $greet = match (true) {
            $hour >= 5 && $hour <= 11 => "Selamat Pagi, ",
            $hour >= 12 && $hour <= 14 => "Selamat Siang, ",
            $hour >= 15 && $hour <= 17 => "Selamat Sore, ",
            default => "Selamat Malam, ",
        };
        echo $greet . strtok(ucwords(auth()->user()->username), " ") . '.';
      @endphp
    </p>

    <form method="GET" action="{{ route('login') }}" class="relative w-[20vw] hover:w-[25vw] transition-all duration-300">
      <input type="search" name="search" placeholder="Search Product here"
        class="w-full h-full rounded-[10px] shadow-md bg-[#f3f9fb] pl-11 py-2.5 font-inherit" />
      <button type="submit" class="absolute top-1/3 left-[10px] rounded-full bg-[#f3f9fb] p-1 transition-transform duration-300 hover:scale-125">
        <img src="{{ asset('storage/assets/search-interface-symbol.png') }}" alt="Search" class="w-[18px] h-[18px]" />
      </button>
    </form>

    <div class="button-box w-[48px] h-[48px] bg-gray-300 rounded-full shadow-md flex items-center justify-center transition-transform duration-[420ms] hover:scale-110 hover:invert">
      <img src="{{ asset('storage/assets/shopping-cart.png') }}" alt="Cart" class="cursor-pointer w-[30px]"
        onclick="location.href = '{{ route('login') }}';" />
    </div>

    <div class="button-box w-[48px] h-[48px] bg-gray-300 rounded-full shadow-md flex items-center justify-center transition-transform duration-[420ms] hover:scale-110 hover:invert">
      <img src="{{ asset('storage/assets/like.png') }}" alt="Wishlist" class="cursor-pointer w-[30px]"
        onclick="location.href = '{{ route('login') }}';" />
    </div>

    <div class="button-box w-[48px] h-[48px] bg-gray-300 rounded-full shadow-md flex items-center justify-center transition-transform duration-[420ms] hover:scale-110 hover:invert">
      <img src="{{ asset('storage/assets/user.png') }}" alt="Profile" class="cursor-pointer w-[30px]"
        onclick="location.href = '{{ route('login') }}';" />
    </div>
  </header>

  <!-- Main -->
  <main class="flex flex-col items-center justify-center">
    <h1 class="text-center text-xl font-bold">Daftar Pesanan</h1>

    <table class="w-[90%] mt-5 border-collapse bg-white shadow-md rounded-lg">
      <thead>
        <tr class="bg-[#cdb77f] text-white font-bold">
          <th class="py-3 px-2 rounded-tl-lg">Urutan Pesanan</th>
          <th class="py-3 px-2">Gambar</th>
          <th class="py-3 px-2">Nama Produk</th>
          <th class="py-3 px-2">Jumlah Pesanan</th>
          <th class="py-3 px-2">Total Harga</th>
          <th class="py-3 px-2">Status Transaksi</th>
          <th class="py-3 px-2 rounded-tr-lg">Status Pengiriman</th>
        </tr>
      </thead>
      <tbody>
        @forelse($orders as $order)
        <tr class="border-b border-gray-300">
          <td class="py-3 px-2">{{ $loop->iteration }}</td>
          <td class="py-3 px-2">
            <img src="web/{{ $order->product->image }}" alt="Product"
              class="w-[50px] cursor-pointer transition-transform duration-300 hover:scale-125"
              onclick="location.href = '{{ route('product.show', $order->product->name) }}';" />
          </td>
          <td class="py-3 px-2">{{ $order->product->name }}</td>
          <td class="py-3 px-2">{{ $order->quantity }}</td>
          <td class="py-3 px-2">Rp.{{ number_format($order->transaction->amount, 2, ',', '.') }}</td>
          <td class="py-3 px-2">{{ $order->transaction->status_bayar ? 'Lunas' : 'Belum Lunas' }}</td>
          <td class="py-3 px-2">{{ $order->delivery->status ?? '-' }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="py-3 text-center">Tidak ada pesanan.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </main>

  <!-- Footer -->
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
