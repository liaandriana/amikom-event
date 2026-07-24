@extends('layouts.admin')

@section('title', 'Tambah Pengurus')

@section('page_title', 'Tambah Pengurus')
@section('page_subtitle', 'Tambahkan data pengurus baru.')

@section('content')

<div class="max-w-4xl mx-auto bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-10">

    <form action="{{ route('admin.pengurus.store') }}" method="POST">

        @csrf

        <div class="space-y-6">

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">
                    Nama Pengurus
                </label>

                <input type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full rounded-2xl border border-slate-300 px-5 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jabatan --}}
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">
                    Jabatan
                </label>

                <select name="jabatan_id"
                    class="w-full rounded-2xl border border-slate-300 px-5 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                    <option value="">-- Pilih Jabatan --</option>

                    @foreach($jabatans as $jabatan)
                        <option value="{{ $jabatan->id }}"
                            {{ old('jabatan_id') == $jabatan->id ? 'selected' : '' }}>
                            {{ $jabatan->name }}
                        </option>
                    @endforeach

                </select>

                @error('jabatan_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full rounded-2xl border border-slate-300 px-5 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Gaji --}}
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">
                    Gaji
                </label>

                <input type="number"
                    name="salary"
                    value="{{ old('salary') }}"
                    class="w-full rounded-2xl border border-slate-300 px-5 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                @error('salary')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="flex justify-end gap-3 mt-10">

            <a href="{{ route('admin.pengurus.index') }}"
                class="px-6 py-3 rounded-2xl bg-slate-200 hover:bg-slate-300 font-semibold transition">
                Batal
            </a>

            <button type="submit"
                class="px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold transition">
                Simpan
            </button>

        </div>

    </form>

</div>

@endsection