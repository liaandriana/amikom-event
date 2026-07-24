@extends('layouts.organization')

@section('title', 'Tambah Event')

@section('page_title', 'Tambah Event')

@section('page_subtitle', 'Buat event baru.')

@section('content')

<div class="bg-white p-8 rounded-3xl shadow max-w-3xl">

<form action="{{ route('organization.events.store') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf

<div class="mb-5">

<label class="font-semibold">Judul Event</label>

<input type="text"
       name="title"
       value="{{ old('title') }}"
       class="w-full border rounded-lg p-3 mt-2">

</div>

<div class="mb-5">

<label class="font-semibold">Kategori</label>

<select name="category_id"
        class="w-full border rounded-lg p-3 mt-2">

@foreach($categories as $category)

<option value="{{ $category->id }}">

{{ $category->name }}

</option>

@endforeach

</select>

</div>

<div class="mb-5">

<label class="font-semibold">Deskripsi</label>

<textarea name="description"
          class="w-full border rounded-lg p-3 mt-2"></textarea>

</div>

<div class="grid grid-cols-2 gap-4">

<div>

<label>Tanggal</label>

<input type="datetime-local"
       name="date"
       class="w-full border rounded-lg p-3 mt-2">

</div>

<div>

<label>Lokasi</label>

<input type="text"
       name="location"
       class="w-full border rounded-lg p-3 mt-2">

</div>

</div>

<div class="grid grid-cols-2 gap-4 mt-5">

<div>

<label>Harga</label>

<input type="number"
       name="price"
       class="w-full border rounded-lg p-3 mt-2">

</div>

<div>

<label>Stok</label>

<input type="number"
       name="stock"
       class="w-full border rounded-lg p-3 mt-2">

</div>

</div>

<div class="mt-5">

<label>Poster</label>

<input type="file"
       name="poster"
       class="w-full border rounded-lg p-3 mt-2">

</div>

<div class="mt-8 flex justify-end gap-3">

<a href="{{ route('organization.events.index') }}"
   class="px-5 py-3 rounded-lg border">

Batal

</a>

<button type="submit"
        class="px-6 py-3 bg-indigo-600 text-white rounded-lg">

Simpan Event

</button>

</div>

</form>

</div>

@endsection