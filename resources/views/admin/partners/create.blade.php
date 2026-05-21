@extends('layouts.admin')

@section('content')

<div class="max-w-2xl mx-auto">

    <!-- HEADER -->
    <div class="mb-8">

        <h1 class="text-3xl font-black">
            Tambah Partner
        </h1>

        <p class="text-slate-500 mt-2">
            Tambahkan partner atau sponsor event.
        </p>

    </div>

    <!-- CARD -->
    <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100">

        <form action="{{ route('admin.partners.store') }}"
              method="POST">

            @csrf

            <!-- NAMA -->
            <div class="mb-6">

                <label class="block mb-3 font-bold text-slate-700">
                    Nama Partner
                </label>

                <input type="text"
                       name="name"
                       placeholder="Masukkan nama partner"
                       class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">

            </div>

            <!-- LOGO URL -->
            <div class="mb-6">

                <label class="block mb-3 font-bold text-slate-700">
                    Logo URL
                </label>

                <input type="text"
                       name="logo_url"
                       placeholder="https://example.com/logo.png"
                       class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">

            </div>

            <!-- BUTTON -->
            <div class="flex gap-4">

                <button type="submit"
                        class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition">

                    Simpan

                </button>

                <a href="{{ route('admin.partners.index') }}"
                   class="px-6 py-3 bg-slate-100 text-slate-700 rounded-2xl font-bold hover:bg-slate-200 transition">

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection