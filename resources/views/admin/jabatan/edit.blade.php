@extends('layouts.admin')

@section('title','Edit Jabatan')

@section('page_title','Edit Jabatan')

@section('content')

<form action="{{ route('admin.jabatan.update',$jabatan->id) }}"
method="POST">

@csrf
@method('PUT')

<div class="bg-white p-8 rounded-3xl">

<label>Nama Jabatan</label>

<input type="text"
name="name"
value="{{ $jabatan->name }}"
class="w-full border rounded-xl p-3 mt-2">

<div class="mt-6">

<button
class="px-6 py-3 bg-indigo-600 text-white rounded-xl">

Update

</button>

</div>

</div>

</form>

@endsection