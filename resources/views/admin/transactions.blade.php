@extends('layouts.admin')

@section('content')

<header class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-3xl font-black">Laporan Transaksi</h1>
        <p class="text-slate-500 font-medium">Pantau arus kas dan penjualan tiket Anda.</p>
    </div>
    <div class="flex gap-4">
        <button class="px-6 py-3 border rounded-2xl font-bold">
            Ekspor Excel
        </button>
        <button class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold">
            Unduh PDF
        </button>
    </div>
</header>

<div class="bg-white rounded-[2.5rem] border shadow-sm overflow-hidden">

    <!-- FILTER -->
    <div class="px-8 py-6 bg-slate-50/50 border-b flex gap-4">
        <input type="text" placeholder="Cari..."
            class="flex-1 px-5 py-3 rounded-xl border">
        <select class="px-5 py-3 rounded-xl border">
            <option>Semua Status</option>
        </select>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Pembeli</th>
                    <th>Event</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#TRX-001</td>
                    <td>Donni</td>
                    <td>Jazz Night</td>
                    <td>Success</td>
                    <td>Rp 150.000</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

@endsection