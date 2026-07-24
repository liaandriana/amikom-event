@extends('layouts.admin')

@section('title','Tambah Jabatan')

@section('page_title','Tambah Jabatan')

@section('content')

<form action="{{ route('admin.jabatan.store') }}" method="POST">

@csrf

<div class="bg-white p-8 rounded-3xl">

<label>Nama Jabatan</label>

<input type="text"
name="name"
class="w-full border rounded-xl p-3 mt-2">

<div class="mt-6">

<button
class="px-6 py-3 bg-indigo-600 text-white rounded-xl">

Simpan

</button>

</div>

</div>

</form>

@endsection