<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
</head>


@section('content')
    <div class="max-w-4xl mx-auto my-8 bg-custom-coklat p-6 rounded-lg shadow-lg">
        <h1 class="text-xl font-semibold text-center mb-6">Edit Alamat</h1>
        
        <form action="{{ route('addresses.update', $address->id_alamat) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="label" class="block text-sm font-medium text-gray-700">Label</label>
                <input type="text" name="label" id="label"  value="{{ old('label', $address->label ?? '') }}" placeholder="Label" class="w-full h-12 px-4 rounded-lg border bg-gray-100 focus:ring-2 focus:ring-yellow-500" required>
                @error('label-alamat')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                <input type="text" name="address" id="address" value="{{ old('address', $address->address ?? '') }}" placeholder="Alamat Lengkap" class="w-full h-12 px-4 rounded-lg border bg-gray-100 focus:ring-2 focus:ring-yellow-500" required>
                @error('alamat')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>

            <div>
                <label for="courier_note" class="block text-sm font-medium text-gray-700">Catatan Untuk Kurir</label>
                <input type="text" name="courier_note" id="courier_note" value="{{ old('courier_note', $address->courier_note ?? '') }}" placeholder="Catatan Untuk Kurir" class="w-full h-12 px-4 rounded-lg border bg-gray-100 focus:ring-2 focus:ring-yellow-500">
                @error('note')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>

            <div>
                <label for="postalcode" class="block text-sm font-medium text-gray-700">Kode Pos</label>
                <input type="text" name="postalcode" id="postalcode" value="{{ old('postalcode', $address->postalcode ?? '') }}" placeholder="Kode Pos" class="w-full h-12 px-4 rounded-lg border bg-gray-100 focus:ring-2 focus:ring-yellow-500" minlength="5" maxlength="5">
                @error('postalcode')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
            <input type="hidden" name="user_id" >

            <div>
                <button type="submit" class="w-full py-3 text-white bg-yellow-500 rounded-lg font-semibold hover:bg-yellow-400 focus:ring-2 focus:ring-yellow-500">
                    Update Alamat
                </button>
            </div>
        </form>
    </div>
@endsection

<body class="bg-gray-100">
<header class="bg-[#cdb77f]  sticky top-0 z-10 flex items-center border-b border-yellow-600 h-20">
        <img src="{{ asset('storage/assets/Artboard 1.png') }}" alt="Logo" class="ml-4 h-16 cursor-pointer transition-transform transform hover:scale-110" onclick="location.href = '{{ route('user.index') }}';">
        <p class="text-lg ml-4">
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
        <form method="GET" action="{{ route('orders.index') }}" class="relative ml-8 w-1/4">
            <input type="search" name="search" placeholder="Search product" required autocomplete="off"
                class="w-full rounded-md shadow-md px-4 py-2 outline-none focus:ring-2 focus:ring-yellow-500">
            <button type="submit" class="absolute top-2 right-2 text-gray-600">
                <img src="{{ asset('storage/assets/search-interface-symbol.png') }}" alt="Search" class="w-6 h-6">
            </button>
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
        </div>
    </header>

    <div class="container mx-auto py-8">
        @yield('content')
    </div>
</body>
</html>
