@extends('layouts.app')
@section('content')

<!-- Hero Section -->
<section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
    <div class="flex-1 space-y-8">
        <span
            class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">
            #1 Event Platform
        </span>

        <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
            Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
        </h1>

        <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
            Dari konser musik hingga workshop teknologi, semua ada di genggamanmu.
            Pesan aman & cepat dengan Midtrans.
        </p>

        <div class="flex gap-4 flex-wrap">

    <a href="#events"
        class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform">
        Mulai Jelajah
    </a>

    <a href="#"
        class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition">
        Cara Pesan
    </a>

    <a href="{{ route('organization.register') }}"
        class="px-8 py-4 bg-emerald-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-emerald-200 hover:bg-emerald-700 transition">
        Daftarkan Organisasi
    </a>

</div>
    </div>

    <div class="flex-1 relative">
        <div
            class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
        </div>

        <div
            class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
        </div>

        <img src="assets/concert.png" alt="Concert"
            class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">

        <div class="absolute -bottom-6 -left-6 glass p-6 rounded-2xl shadow-xl z-20 border border-white">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                </div>

                <div>
                    <p class="text-xs text-slate-500 font-bold uppercase">
                        Terverifikasi
                    </p>
                    <p class="font-bold">
                        Pembayaran Aman via Midtrans
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Events Grid -->
<section id="events" class="max-w-7xl mx-auto px-6 py-20">

    <!-- Heading -->
    <div class="mb-12 text-center">
        <h2 class="text-3xl font-extrabold mb-2">
            Kategori Event
        </h2>

        <p class="text-slate-500 font-medium">
            Jangan sampai ketinggalan acara seru minggu ini!
        </p>

      <!-- Filter Kategori -->
<div class="mt-10 flex justify-center">

    <div class="bg-slate-900 p-3 rounded-[2rem] shadow-2xl flex flex-wrap gap-3">

        <!-- Semua -->
        <a href="/"
           class="px-6 py-3 rounded-2xl font-semibold text-sm tracking-wide transition-all duration-300
           flex items-center gap-2
           {{ request('category') == null
                ? 'bg-gradient-to-r from-cyan-400 to-indigo-500 text-white shadow-lg shadow-cyan-500/30'
                : 'text-slate-300 hover:bg-slate-800 hover:text-white'
           }}">

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16">
                </path>

            </svg>

            Semua
        </a>

        @foreach($categories as $cat)

        <a href="/?category={{ $cat->slug }}"
           class="px-6 py-3 rounded-2xl font-semibold text-sm tracking-wide transition-all duration-300
           flex items-center gap-2
           {{ request('category') == $cat->slug
                ? 'bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 text-white shadow-lg shadow-purple-500/30 scale-105'
                : 'text-slate-300 hover:bg-slate-800 hover:text-white'
           }}">

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 12h6m-3-3v6">
                </path>

            </svg>

            {{ $cat->name }}
        </a>

        @endforeach

    </div>

</div>
    </div>

    <!-- Card Event -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach($events as $event)

        <div
            class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">

            <div class="relative overflow-hidden aspect-[3/4]">

                <img src="{{ $event->poster_path
                ? asset('storage/' . $event->poster_path)
                : 'https://placehold.co/600x800' }}"
                alt="{{ $event->title }}">

                <div
                    class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">
                    {{ $event->category->name }}
                </div>
            </div>

            <div class="p-6">

                <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">
                    {{ $event->title }}
                </h3>

                <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>

                    <span>
                        {{ \Carbon\Carbon::parse($event->date)->format('d-m-Y H:i') }}
                    </span>
                </div>

                <div class="pt-4 border-t">

            <div class="flex justify-between items-center mb-4">

                <span class="text-2xl font-black text-indigo-600">
                    Rp {{ number_format($event->price,0,',','.') }}
                </span>

                <a href="{{ route('events.show', $event->id) }}"
                    class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">
                    Lihat Detail
                </a>

            </div>

            @php
                $avgRating = round($event->reviews->avg('rating'),1);
                $totalReview = $event->reviews->count();
            @endphp

            @if($totalReview > 0)

                <div class="mb-3">

                    <div class="text-yellow-500 text-lg">
                        @for($i=1;$i<=5;$i++)
                            @if($i <= round($avgRating))
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>

                    <p class="text-sm text-slate-600">
                        <strong>{{ $avgRating }}/5</strong>
                        ({{ $totalReview }} Review)
                    </p>

                </div>

                <div class="border-t pt-3">

                    <h4 class="text-sm font-bold text-slate-700 mb-2">
                        Review Terbaru
                    </h4>

                    @foreach($event->reviews->take(2) as $review)

                        <div class="mb-3">

                            <div class="text-yellow-500">
                                @for($i=1;$i<=5;$i++)
                                    @if($i <= $review->rating)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>

                            <p class="text-sm text-slate-600 italic">
                                "{{ $review->review }}"
                            </p>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="mt-3">

                    <div class="text-yellow-500 text-lg">
                        ☆☆☆☆☆
                    </div>

                    <p class="text-sm text-slate-400">
                        Belum ada review
                    </p>

                </div>

            @endif

        </div>
                    </div>
                </div>

                @endforeach

            </div>
        </section>

        </section>

<!-- PARTNER SECTION -->
<section class="py-16 bg-slate-50">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-12">

            <h2 class="text-4xl font-black mb-4">
                Partner Kami
            </h2>

            <p class="text-slate-500">
                Didukung oleh berbagai perusahaan dan platform terpercaya.
            </p>

        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">

            @foreach($partners as $partner)

            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 flex flex-col items-center justify-center hover:shadow-lg transition">

                <img src="{{ $partner->logo_url }}"
                     alt="{{ $partner->name }}"
                     class="h-16 object-contain mb-4">

                <h3 class="font-bold text-slate-700">
                    {{ $partner->name }}
                </h3>

            </div>

            @endforeach

        </div>

    </div>

</section>

@endsection