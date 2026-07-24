@extends('layouts.app')

@section('title', 'E-Ticket Saya')

@section('content')

@if(!$transaction)

<div class="max-w-3xl mx-auto py-24 text-center">
    <h1 class="text-3xl font-bold text-slate-800">
        Belum Ada Tiket
    </h1>

    <p class="text-slate-500 mt-3">
        Kamu belum memiliki tiket yang berhasil dibayar.
    </p>

    <a href="{{ route('welcome') }}"
        class="inline-block mt-8 bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700">
        Kembali ke Beranda
    </a>
</div>

@else

<div class="bg-indigo-600 min-h-screen flex items-center justify-center py-12 px-4">

    <div class="max-w-md w-full">

        <div class="text-center mb-8">

            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-white">

                <svg class="w-10 h-10 text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="3"
                        d="M5 13l4 4L19 7">
                    </path>

                </svg>

            </div>

            <h1 class="text-3xl font-black text-white">
                Pembayaran Berhasil!
            </h1>

            <p class="text-indigo-100 mt-2">
                Tiket Anda telah terbit dan siap digunakan.
            </p>

        </div>


        <div class="bg-white rounded-3xl overflow-hidden shadow-2xl">

            <div class="bg-indigo-50 p-8 border-b border-dashed">

                <p class="text-center text-indigo-600 uppercase text-xs font-bold tracking-widest">
                    E-Ticket Resmi
                </p>

                <h2 class="text-center text-2xl font-black text-slate-800 mt-2">
                    {{ $transaction->event->title }}
                </h2>

            </div>

            <div class="p-8 space-y-6">

                <div class="grid grid-cols-2 gap-6">

                    <div>
                        <p class="text-xs uppercase text-slate-400 font-bold">
                            Nama Pembeli
                        </p>

                        <p class="font-bold text-slate-800">
                            {{ $transaction->customer_name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-slate-400 font-bold">
                            Tanggal
                        </p>

                        <p class="font-bold text-slate-800">
                            {{ \Carbon\Carbon::parse($transaction->event->date)->format('d M Y H:i') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-slate-400 font-bold">
                            Order ID
                        </p>

                        <p class="font-bold text-slate-800">
                            {{ $transaction->order_id }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-slate-400 font-bold">
                            Lokasi
                        </p>

                        <p class="font-bold text-slate-800">
                            {{ $transaction->event->location }}
                        </p>
                    </div>

                </div>

                <div class="bg-slate-100 rounded-2xl p-6 text-center">

                    <p class="text-xs uppercase font-bold text-slate-500 mb-4">
                        Scan QR untuk Check-in
                    </p>

                    <img
                        class="mx-auto rounded-lg"
                        src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ urlencode($transaction->order_id) }}"
                        alt="QR Code">

                    <p class="font-mono font-bold mt-4">
                        {{ $transaction->order_id }}
                    </p>

                </div>

                <div class="flex justify-between">

                    <span class="font-semibold text-slate-600">
                        Status
                    </span>

                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold">
                        {{ strtoupper($transaction->status) }}
                    </span>

                </div>

            </div>

            <div class="px-8 pb-8">

                <button
                    onclick="window.print()"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-2xl font-bold">

                    Cetak / Simpan PDF

                </button>

                {{-- Pesan --}}
                @if(session('success'))
                    <div class="mt-4 bg-green-100 text-green-700 p-3 rounded-xl">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mt-4 bg-red-100 text-red-700 p-3 rounded-xl">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Form Review --}}
                @if(!$transaction->review)

                <form action="{{ route('review.store',$transaction->id) }}" method="POST" class="mt-6">
                    @csrf

                    <label class="block font-bold mb-2">
                        Rating
                    </label>

                    <select
                        name="rating"
                        class="w-full border rounded-xl p-3"
                        required>

                        <option value="">Pilih Rating</option>
                        <option value="5">⭐⭐⭐⭐⭐</option>
                        <option value="4">⭐⭐⭐⭐</option>
                        <option value="3">⭐⭐⭐</option>
                        <option value="2">⭐⭐</option>
                        <option value="1">⭐</option>

                    </select>

                    <label class="block font-bold mt-5 mb-2">
                        Review
                    </label>

                    <textarea
                        name="review"
                        rows="4"
                        class="w-full border rounded-xl p-3"
                        placeholder="Bagikan pengalaman mengikuti event ini..."></textarea>

                    <button
                        type="submit"
                        class="w-full mt-5 bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-xl font-bold">

                        Kirim Review

                    </button>

                </form>

                @else

                <div class="mt-6 bg-green-50 border border-green-200 rounded-xl p-5">

                    <h3 class="font-bold text-lg mb-2">
                        Review Anda
                    </h3>

                    <div class="text-yellow-500 text-2xl">
                        {{ str_repeat('⭐', $transaction->review->rating) }}
                    </div>

                    <p class="mt-3 text-slate-700">
                        {{ $transaction->review->review }}
                    </p>

                </div>

                @endif

                <a href="{{ route('welcome') }}"
                    class="block text-center mt-5 text-slate-500 font-semibold hover:text-indigo-600">

                    Kembali ke Beranda

                </a>

            </div>

        </div>

    </div>

</div>

@endif

@endsection