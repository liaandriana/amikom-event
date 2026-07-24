@extends('layouts.app')

@section('title', 'Checkout - ' . $event->title)

@section('content')

<main class="max-w-3xl mx-auto px-6 py-20">

    <div class="mb-12">

        <a href="{{ route('events.show', $event->id) }}"
            class="text-indigo-600 font-bold flex items-center gap-2 mb-6">

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7">
                </path>
            </svg>

            Kembali ke Event

        </a>

        <h1 class="text-4xl font-extrabold">
            Checkout
        </h1>

        <p class="text-slate-500 mt-2">
            Lengkapi data Anda untuk mendapatkan tiket.
        </p>

    </div>

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-xl font-bold">
            {{ session('error') }}
        </div>
    @endif


    <div class="grid grid-cols-1 gap-8">

        <!-- Ringkasan Pesanan -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">

            <h3 class="text-xl font-bold mb-6 border-b pb-4">
                Pesanan Anda
            </h3>

            <div class="flex gap-6 items-start">

                <img
                    src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path))
                    ? asset('storage/'.$event->poster_path)
                    : 'https://placehold.co/200x200' }}"
                    class="w-24 h-24 rounded-2xl object-cover">

                <div>

                    <h4 class="font-extrabold text-lg">
                        {{ $event->title }}
                    </h4>

                    <p class="text-slate-500">
                        {{ $event->date->format('d M Y') }}
                        •
                        {{ $event->location }}
                    </p>

                    <p class="text-indigo-600 font-bold mt-2">
                        1 x Rp {{ number_format($event->price,0,',','.') }}
                    </p>

                </div>

            </div>

            <div class="mt-8 pt-6 border-t space-y-3">

                <div class="flex justify-between">

                    <span>Harga Tiket</span>

                    <p class="text-indigo-600 font-bold mt-2">
                    @if($event->price == 0)
                        GRATIS
                    @else
                        1 x Rp {{ number_format($event->price,0,',','.') }}
                    @endif
                    </p>

                </div>

                @if($event->price > 0)
                <div class="flex justify-between">
                    <span>Biaya Layanan</span>
                    <span>Rp 5.000</span>
                </div>
                @endif

                <div class="flex justify-between text-2xl font-black border-t pt-4">

                    <span>Total</span>

                    <span class="text-indigo-600">
                    Rp {{ number_format($event->price > 0 ? $event->price + 5000 : 0, 0, ',', '.') }}
                </span>

                </div>

            </div>

        </div>


        <!-- Card Checkout -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">

            @if(!auth()->check())

                <div class="text-center">

                    <img src="https://www.svgrepo.com/show/475656/google-color.svg"
                        class="w-16 mx-auto mb-5">

                    <h3 class="text-2xl font-bold mb-3">

                        Login untuk Melanjutkan

                    </h3>

                    <p class="text-slate-500 mb-8">

                        Untuk memesan tiket, silakan login menggunakan akun Google.

                    </p>

                    <a href="{{ route('google.login',['event'=>$event->id]) }}"
                        class="inline-flex items-center gap-3 bg-red-500 hover:bg-red-600 text-white px-8 py-4 rounded-2xl font-bold transition">

                        <img src="https://www.svgrepo.com/show/475656/google-color.svg"
                            class="w-6 h-6 bg-white rounded-full p-1">

                        Continue with Google

                    </a>

                </div>

            @else

                <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4">

                    <p class="font-semibold text-green-700">

                        Login berhasil sebagai
                        <strong>{{ auth()->user()->name }}</strong>

                    </p>

                </div>

                <h3 class="text-xl font-bold mb-6">

                    📦 Data Pemesan

                </h3>

                <form action="{{ route('checkout.store',$event->id) }}"
                    method="POST"
                    class="space-y-6">

                    @csrf

                    <div>

                        <label class="block text-sm font-bold mb-2">

                            Nama Lengkap

                        </label>

                        <input
                            type="text"
                            name="customer_name"
                            value="{{ auth()->user()->name }}"
                            readonly
                            class="w-full px-5 py-4 rounded-2xl border-2 border-slate-200 bg-slate-100">

                    </div>


                    <div class="grid md:grid-cols-2 gap-6">

                        <div>

                            <label class="block text-sm font-bold mb-2">

                                Email

                            </label>

                            <input
                                type="email"
                                name="customer_email"
                                value="{{ auth()->user()->email }}"
                                readonly
                                class="w-full px-5 py-4 rounded-2xl border-2 border-slate-200 bg-slate-100">

                        </div>

                        <div>

                            <label class="block text-sm font-bold mb-2">

                                No WhatsApp

                            </label>

                            <input
                                type="tel"
                                name="customer_phone"
                                required
                                maxlength="15"
                                value="{{ old('customer_phone') }}"
                                placeholder="08xxxxxxxxxx"
                                class="w-full px-5 py-4 rounded-2xl border-2 border-slate-200">

                        </div>

                    </div>

                    <button
                        type="submit"
                        class="w-full py-5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-black text-xl">

                        Lanjut Pembayaran

                    </button>

                </form>

            @endif

        </div>

    </div>

</main>

@endsection