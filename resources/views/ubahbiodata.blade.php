<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">
    <header class="bg-[#cdb77f] p-4 flex items-center shadow-md sticky top-0">
    <img src="{{ asset('storage/assets/Artboard 1.png') }}" alt="Logo" class="ml-4 h-16 cursor-pointer transition-transform transform hover:scale-110" onclick="location.href = '{{ route('user.index') }}';">
        <p class="ml-4 text-black font-semibold text-lg">
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
        <form class="flex-grow mx-8" method="GET" id="search-box" action="{{ route('user.index') }}">
            <div class="relative">
                <input type="search" name="search" placeholder="Search..." 
                       class="w-full py-2 px-4 rounded-lg bg-gray-100">
                <button class="absolute inset-y-0 left-2">
                <img src="{{ asset('storage/assets/search-interface-symbol.png') }}" alt="Search" class="w-6 h-6">
                </button>
            </div>
        </form>
        <div class="ml-auto flex space-x-4 mr-4">
            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center shadow-md hover:scale-105 transition-transform cursor-pointer" onclick="location.href = '{{ route('user.cart') }}'">
                <img src="{{ asset('storage/assets/shopping-cart.png') }}" alt="Cart" class="w-6 h-6">
            </div>
            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center shadow-md hover:scale-105 transition-transform cursor-pointer" onclick="location.href = '{{ route('wishlist.index') }}'">
                <img src="{{ asset('storage/assets/like.png') }}" alt="Wishlist" class="w-6 h-6">
            </div>
            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center shadow-md hover:scale-105 transition-transform cursor-pointer" onclick="location.href = '{{ route('user.profile') }}'">
                <img src="{{ asset('storage/assets/user.png') }}" alt="Profile" class="w-6 h-6">
            </div>
            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center shadow-md hover:scale-105 transition-transform cursor-pointer" onclick="location.href = '{{ route('orders.index') }}'">
                <img src="{{ asset('storage/assets/clipboard.png') }}" alt="Orders" class="w-6 h-6">
            </div>
    </header>

    <main class="py-10 flex flex-col items-center">
        <h1 class="text-3xl font-bold mb-6">Ubah Biodata</h1>
        <form action="{{ route('profile.update', $user->id_user)}}" method="POST" class="space-y-6 w-full max-w-lg bg-white shadow-md p-6 rounded-lg">
            @csrf
            @method('PUT')
            <input type="hidden" name="id_user" value="{{ $user->id_user }}">
            <div>
                <label for="username" class="block text-gray-700">Nama Pengguna</label>
                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                       class="block w-full border-gray-300 rounded-lg shadow-sm">
            </div>
            <div>
                <label for="sex" class="block text-gray-700">Gender</label>
                <select name="sex" id="sex" class="block w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="">{{ $user->sex === null ? 'Pilih Gender' : ($user->sex == '0' ? 'Pria' : 'Wanita') }}</option>
                    <option value="0" {{ $user->sex == '0' ? 'selected' : '' }}>Pria</option>
                    <option value="1" {{ $user->sex == '1' ? 'selected' : '' }}>Wanita</option>
                </select>
            </div>
            <div>
                <label for="birthdate" class="block text-gray-700">Tanggal Lahir</label>
                <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate', $user->birthdate) }}"
                       class="block w-full border-gray-300 rounded-lg shadow-sm">
            </div>
            <button type="submit" class="w-full py-3 bg-[#cdb77f] text-white rounded-lg shadow-md hover:bg-yellow-600">
                Simpan Perubahan
            </button>
        </form>
    </main>
</body>
</html>
