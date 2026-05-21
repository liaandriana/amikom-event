@extends('layouts.admin')

@section('content')

<div class="p-8">

<h2 class="text-2xl font-bold mb-6">
    Tambah Kategori
</h2>

<form action="{{ route('admin.categories.store') }}"
      method="POST"
      class="bg-white p-6 rounded-3xl shadow">

    @csrf

    <label class="block mb-2 font-semibold">
        Nama Kategori
    </label>

    <input type="text"
           name="name"
           class="w-full border rounded-xl p-3 mb-4"
           placeholder="Masukkan nama kategori">

    <button type="submit"
            class="bg-indigo-600 text-white px-5 py-3 rounded-xl">

        Simpan

    </button>

</form>

</div>

@endsection