@extends('layouts.organization')

@section('title', 'Edit Event')

@section('page_title', 'Edit Event')

@section('page_subtitle', 'Perbarui data event.')

@section('content')

<div class="bg-white p-8 rounded-3xl shadow max-w-3xl">

<form action="{{ route('organization.events.update',$event->id) }}"
      method="POST"
      enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="mb-5">

<label class="font-semibold">Judul Event</label>

<input type="text"
       name="title"
       value="{{ old('title',$event->title) }}"
       class="w-full border rounded-lg p-3 mt-2">

</div>

<div class="mb-5">

<label class="font-semibold">Kategori</label>

<select name="category_id"
        class="w-full border rounded-lg p-3 mt-2">

@foreach($categories as $category)

<option value="{{ $category->id }}"
{{ $event->category_id == $category->id ? 'selected' : '' }}>

{{ $category->name }}

</option>

@endforeach

</select>

</div>

<div class="mb-5">

<label class="font-semibold">Deskripsi</label>

<textarea name="description"
          class="w-full border rounded-lg p-3 mt-2">{{ old('description',$event->description) }}</textarea>

</div>

<div class="grid grid-cols-2 gap-4">

<div>

<label>Tanggal</label>

<input type="datetime-local"
       name="date"
       value="{{ old('date',$event->date->format('Y-m-d\TH:i')) }}"
       class="w-full border rounded-lg p-3 mt-2">

</div>

<div>

<label>Lokasi</label>

<input type="text"
       name="location"
       value="{{ old('location',$event->location) }}"
       class="w-full border rounded-lg p-3 mt-2">

</div>

</div>

<div class="grid grid-cols-2 gap-4 mt-5">

<div>

<label>Harga</label>

<input type="number"
       name="price"
       value="{{ old('price',$event->price) }}"
       class="w-full border rounded-lg p-3 mt-2">

</div>

<div>

<label>Stok</label>

<input type="number"
       name="stock"
       value="{{ old('stock',$event->stock) }}"
       class="w-full border rounded-lg p-3 mt-2">

</div>

</div>

@if($event->poster_path)

<div class="mt-5">

<p class="mb-2 font-semibold">Poster Saat Ini</p>

<img src="{{ asset('storage/'.$event->poster_path) }}"
     class="w-32 rounded-lg">

</div>

@endif

<div class="mt-5">

<label>Ganti Poster</label>

<input type="file"
       name="poster"
       class="w-full border rounded-lg p-3 mt-2">

</div>

<div class="mt-8 flex justify-end gap-3">

<a href="{{ route('organization.events.index') }}"
   class="px-5 py-3 border rounded-lg">

Batal

</a>

<button type="submit"
        class="px-6 py-3 bg-indigo-600 text-white rounded-lg">

Update Event

</button>

</div>

</form>

</div>

@endsection