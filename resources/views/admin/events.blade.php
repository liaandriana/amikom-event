@extends('layouts.admin')

@section('content')

<header class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-3xl font-black">Kelola Kategori</h1>
        <p class="text-slate-500 font-medium">Atur kategori event seperti Seminar, Konser, Workshop.</p>
    </div>
    <button
        class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg hover:bg-indigo-700 transition">
        + Tambah Kategori
    </button>
</header>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    
    <!-- Search -->
    <div class="px-8 py-6 bg-slate-50/50 border-b">
        <input type="text" placeholder="Cari kategori..."
            class="w-full px-5 py-3 rounded-xl border-slate-200 border bg-white outline-none">
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black">
                <tr>
                    <th class="px-8 py-4">No</th>
                    <th class="px-8 py-4">Nama Kategori</th>
                    <th class="px-8 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                <tr>
                    <td class="px-8 py-6 font-bold text-slate-400">1</td>
                    <td class="px-8 py-6 font-semibold">Seminar</td>
                    <td class="px-8 py-6">
                        <div class="flex gap-2">
                            <button class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition">
                                Edit
                            </button>
                            <button class="px-3 py-1 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-600 hover:text-white transition">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="px-8 py-6 font-bold text-slate-400">2</td>
                    <td class="px-8 py-6 font-semibold">Konser</td>
                    <td class="px-8 py-6">
                        <div class="flex gap-2">
                            <button class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition">
                                Edit
                            </button>
                            <button class="px-3 py-1 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-600 hover:text-white transition">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="px-8 py-6 font-bold text-slate-400">3</td>
                    <td class="px-8 py-6 font-semibold">Workshop</td>
                    <td class="px-8 py-6">
                        <div class="flex gap-2">
                            <button class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition">
                                Edit
                            </button>
                            <button class="px-3 py-1 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-600 hover:text-white transition">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

@endsection