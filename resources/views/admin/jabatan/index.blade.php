@extends('layouts.admin')

@section('title','Kelola Jabatan')

@section('page_title','Kelola Jabatan')

@section('page_subtitle','Kelola data jabatan.')

@section('content')

<div class="mb-4 text-right">

<a href="{{ route('admin.jabatan.create') }}"
class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold">

+ Tambah Jabatan

</a>

</div>

<div class="bg-white rounded-3xl shadow overflow-hidden">

<table class="w-full">

<thead class="bg-slate-100">

<tr>

<th class="p-4">No</th>

<th class="p-4">Nama Jabatan</th>

<th class="p-4">Aksi</th>

</tr>

</thead>

<tbody>

@forelse($jabatans as $index=>$jabatan)

<tr class="border-t">

<td class="p-4">{{ $jabatans->firstItem()+$index }}</td>

<td class="p-4">{{ $jabatan->name }}</td>

<td class="p-4 flex gap-2">

<a href="{{ route('admin.jabatan.edit',$jabatan->id) }}"
class="px-3 py-2 bg-indigo-500 text-white rounded">

Edit

</a>

<form action="{{ route('admin.jabatan.destroy',$jabatan->id) }}"
method="POST">

@csrf
@method('DELETE')

<button
onclick="return confirm('Hapus data?')"
class="px-3 py-2 bg-red-500 text-white rounded">

Hapus

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="3" class="text-center p-6">

Belum ada data.

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="p-5">

{{ $jabatans->links() }}

</div>

</div>

@endsection