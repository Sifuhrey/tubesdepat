<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Oryva</title>
  @vite('resources/css/app.css')
  <link rel="icon" href="{{ asset('storage/assets/Artboard 1.png') }}" type="image/x-icon" />
</head>
<div class="min-h-screen bg-white">
    <!-- Header -->
    <header class="bg-custom-coklat sticky top-0 z-10 flex items-center gap-8 px-6 py-4 border-b border-yellow-400 shadow-md">
        <img src="{{ asset('storage/assets/Artboard 1.png') }}" alt="Logo" class="w-28 h-auto cursor-pointer transition-transform hover:scale-110" onclick="location.href='{{ route('user.index') }}';" />
        
        <p class="text-lg">
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

        <!-- Search Box -->
        <form method="GET" action="{{ route('user.index') }}" class="relative flex-1 max-w-sm">
            <input type="search" name="search" placeholder="Search Product..." class="w-full px-12 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
            <button type="submit" class="absolute top-1/2 left-3 transform -translate-y-1/2">
                <img src="{{ asset('storage/assets/search-interface-symbol.png') }}" alt="Search" class="w-6 h-6" />
            </button>
        </form>

        <!-- Navigation Buttons -->
        <div class="flex gap-4">
            <button class="w-12 h-12 p-2 bg-gray-300 rounded-full flex items-center justify-center shadow-md hover:scale-110 transition-transform" onclick="location.href='{{ route('user.cart') }}'">
                <img src="{{ asset('storage/assets/shopping-cart.png') }}" alt="Cart" />
            </button>
            <button class="w-12 h-12 p-2 bg-gray-300 rounded-full flex items-center justify-center shadow-md hover:scale-110 transition-transform" onclick="location.href='{{ route('user.index') }}'">
                <img src="{{ asset('storage/assets/like.png') }}" alt="Wishlist" />
            </button>
            <button class="w-12 h-12 p-2 bg-gray-300 rounded-full flex items-center justify-center shadow-md hover:scale-110 transition-transform" onclick="location.href='{{ route('orders.index') }}'">
                <img src="{{ asset('storage/assets/clipboard.png') }}" alt="Orders" />
            </button>
        </div>

        <!-- Logout -->
        <form method="get" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-gray-300 rounded-lg shadow-md hover:scale-110 transition-transform">Keluar Akun</button>
        </form>
    </header>

    <!-- Main Content -->
    <main class="flex justify-center py-10">
        <article class="bg-custom-coklat rounded-xl shadow-lg w-[80vw] lg:w-4/5 p-6">
            <!-- Profile Section -->
            <div class="flex flex-wrap justify-between ">
                @foreach ($userprofile as $data)
                <!-- Profile Picture -->
                <section class="w-full md:w-1/3 bg-white rounded-lg p-4 shadow-md text-center">
                    <img src="{{ asset('storage/profile/' . $data->profilepic) }}" alt="{{ auth()->user()->username }}" class="w-36 h-36 mx-auto rounded-md object-cover" />
                    <form action="{{ route('user.index') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <input type="file" name="upload" class="hidden" id="upload" accept="image/*" onchange="this.form.submit()" />
                        <label for="upload" class="bg-yellow-500 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-yellow-600">Pilih</label>
                    </form>
                </section>

                <!-- User Details -->
                <section class="w-24 md:w-2/3 mt-6 md:mt-0">
                    <h2 class="text-2xl font-bold mb-4">Profil Pengguna</h2>
                    <table class="table-auto w-full text-left">
                        <tr>
                            <td>Nama Pengguna</td>
                            <td>:</td>
                            <td>{{ ucwords(auth()->user()->username) }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td>{{ auth()->user()->birthdate ? date('d F Y', strtotime(auth()->user()->birthdate)) : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>{{ auth()->user()->sex == 0 ? 'Pria' : (auth()->user()->sex == 1 ? 'Wanita' : 'Belum Diisi') }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('profile.edit') }}" class="mt-4 block w-fit text-center bg-yellow-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-yellow-600">Ubah Biodata</a>
                </section>
            </div>
            @endforeach
            <!-- Address Section -->
            <h2 class="text-2xl font-bold mt-10 mb-4">Alamat</h2>
            @if ($addresses->isEmpty())
                <p class="text-gray-600">Anda belum mengisi alamat, silakan mengisi alamat.</p>
            @else
                @foreach ($addresses as $address)
                    <div class="bg-gray-300 rounded-lg shadow-md p-4 mb-4">
                        <h3 class="text-xl font-bold">{{ $address->label }}</h3>
                        <p>Alamat: {{ $address->address }}</p>
                        <p>Keterangan: {{ $address->courier_note }}</p>
                        <p>Kode Pos: {{ $address->postalcode }}</p>
                        <a href="{{ route('edit-address', $address->id_alamat) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Edit Alamat</a>
                        <form method="POST" action="{{ route('addresses.destroy', $address->id_alamat) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-300 px-4 py-2 rounded-md shadow-md hover:scale-110 transition">Hapus</button>
                    </form>
                    </div>
                @endforeach
            @endif
            <a href="{{route('addaddress')}}" class="mt-4 block w-fit text-center bg-yellow-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-yellow-600">Tambah Alamat</a>
        </article>
    </main>
</div>

