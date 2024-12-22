<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>

    <div class="container mx-auto p-4">
        <!-- Header -->
        <header class="bg-custom-coklat sticky top-0 z-10 flex items-center py-4 shadow-md border-b bg-custom-coklat">
        <img src="{{ asset('storage/assets/Artboard 1.png') }}" alt="Logo" class="h-16 cursor-pointer" onclick="window.location='{{ route('admin.main') }}'">

            <p class="text-base ml-4">
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

            <div class="ml-auto flex space-x-4 mr-4">
                <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center shadow-md cursor-pointer hover:scale-110 transition" onclick="window.location='{{ route('datapengiriman') }}'">
                <img src="{{ asset('storage/assets/shipment.png') }}" alt="pengiriman">
            </div>
            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center shadow-md cursor-pointer hover:scale-110 transition" onclick="window.location='{{ route('datapengiriman') }}'">
                <img src="{{ asset('storage/assets/payment.png') }}" alt="Pembayaran">
            </div>
        </header>

        <!-- Main Content -->
        <main>
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse bg-white rounded-lg shadow-md mt-8">
                    <thead>
                        <tr class="bg-custom-coklat text-white">
                            <th class="px-4 py-2">ID Pengiriman</th>
                            <th class="px-4 py-2">Alamat</th>
                            <th class="px-4 py-2">Nama Customer</th>
                            <th class="px-4 py-2">Produk</th>
                            <th class="px-4 py-2">Waktu Pengiriman</th>
                            <th class="px-4 py-2">Waktu Sampai</th>
                            <th class="px-4 py-2">Status Pengiriman</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shipment as $shipments)
                        <tr class="border-b last:border-none hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $shipment->id_pengiriman }}</td>
                            <td class="px-4 py-2">{{ $shipment->id_pesanan }}</td>
                            <td class="px-4 py-2">{{ $shipment->waktukirim->format('d F Y G:i:s') }}</td>
                            <td class="px-4 py-2">
                                {{ $shipment->waktusampai && $shipment->waktusampai != '1970-01-01 07:00:00' 
                                ? $shipment->waktusampai->format('d F Y G:i:s') : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                @if ($shipment->status == 'sampai')
                                <span class="text-green-600">Barang Diterima</span>
                                @elseif ($shipment->status == 'batal')
                                <span class="text-red-600">Pesanan Batal</span>
                                @else
                                <form action="{{ route('changestatus', $shipment->id_pengiriman) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="border rounded px-2 py-1 text-sm" onchange="this.form.submit()">
                                        <option value="" disabled selected>Dalam Pengiriman</option>
                                        <option value="sampai">Sampai</option>
                                        <option value="batal">Batal</option>
                                    </select>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">Tidak ada data pengiriman.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>

</html>