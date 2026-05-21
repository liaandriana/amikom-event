@extends('layouts.admin')

@section('content')

<div class="max-w-2xl mx-auto">

    <!-- HEADER -->
    <div class="mb-8">

        <h1 class="text-3xl font-black">
            Edit Partner
        </h1>

        <p class="text-slate-500 mt-2">
            Ubah data partner atau sponsor event.
        </p>

    </div>

    <!-- CARD -->
    <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100">

        <form action="{{ route('admin.partners.update', $partner->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <!-- NAMA -->
            <div class="mb-6">

                <label class="block mb-3 font-bold text-slate-700">
                    Nama Partner
                </label>

                <input type="text"
                       name="name"
                       value="{{ $partner->name }}"
                       class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">

            </div>

            <!-- LOGO URL -->
            <div class="mb-6">

                <label class="block mb-3 font-bold text-slate-700">
                    Logo URL
                </label>

                <input type="text"
                       name="logo_url"
                       value="{{ $partner->logo_url }}"
                       class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">

            </div>

            <!-- PREVIEW LOGO -->
            <div class="mb-6">

                <p class="font-bold text-slate-700 mb-3">
                    Preview Logo
                </p>

                <img src="{{ $partner->logo_url }}"
                     alt="Logo Partner"
                     class="w-24 h-24 object-contain border rounded-2xl p-2 bg-white">

            </div>

            <!-- BUTTON -->
            <div class="flex gap-4">

                <button type="submit"
                        class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition">

                    Update

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