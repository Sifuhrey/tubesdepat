@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pesanan</h1>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status Transaksi</th>
                <th>Status Pengiriman</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $key => $order)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>
                    <img src="{{ asset('storage/' . $order->product->imgname) }}" alt="" width="100">
                </td>
                <td>{{ $order->product->productname }}</td>
                <td>{{ $order->quantity }}</td>
                <td>Rp {{ number_format($order->transaction->amount, 2, ',', '.') }}</td>
                <td>{{ $order->transaction->statusbayar ? 'Lunas' : 'Belum Lunas' }}</td>
                <td>{{ $order->shipping->status ? 'Pesanan ' . ucfirst($order->shipping->status) : '' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada pesanan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
