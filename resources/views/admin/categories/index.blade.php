@extends('layouts.admin')

@section('content')

<!-- HEADER -->
<header class="flex flex-col md:flex-row md:justify-between md:items-center gap-6 mb-10">
    <div>
        <h1 class="text-3xl font-black">Kelola Kategori</h1>
        <p class="text-slate-500 font-medium">
            Atur kategori seperti Seminar, Konser, Workshop.
        </p>
    </div>

    <div class="flex items-center gap-4">
        <span class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl text-sm font-bold">
            Total: {{ $categories->count() }} Kategori
        </span>

        <a href="{{ route('admin.categories.create') }}"
           class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">

            + Tambah

        </a>
    </div>
</header>

<!-- CARD -->
<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">

    <!-- SEARCH -->
    <div class="px-8 py-6 bg-slate-50/50 border-b flex gap-4 items-center">

       <form action="{{ route('admin.categories.index') }}"
      method="GET"
      class="flex gap-4 items-center w-full">

    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Cari kategori..."
           class="flex-1 px-5 py-3 rounded-xl border border-slate-200">

    <button type="submit"
            class="px-5 py-3 bg-indigo-600 text-white rounded-xl">

        Cari

    </button>

</form>

    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="w-full text-left border-collapse">

            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">

                <tr>
                    <th class="px-8 py-4 w-16">No</th>
                    <th class="px-8 py-4">Nama Kategori</th>
                    <th class="px-8 py-4 text-right">Aksi</th>
                </tr>

            </thead>

            <tbody class="divide-y">

                @forelse($categories as $index => $category)

                <tr class="hover:bg-slate-50 transition">

                    <td class="px-8 py-6 font-bold text-slate-400">
                        {{ $categories->firstItem() + $index }}
                    </td>

                    <td class="px-8 py-6">

                        <div class="flex items-center gap-3">

                            <div class="w-3 h-3 bg-indigo-500 rounded-full"></div>

                            <span class="font-semibold text-slate-800">
                                {{ $category->name }}
                            </span>

                        </div>

                    </td>

                    <td class="px-8 py-6 text-right">

                        <div class="flex justify-end gap-2">

                            <!-- EDIT -->
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                               class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl text-sm font-bold hover:bg-indigo-600 hover:text-white transition">

                                Edit

                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="px-4 py-2 bg-rose-50 text-rose-600 rounded-xl text-sm font-bold hover:bg-rose-600 hover:text-white transition">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="3"
                        class="px-8 py-10 text-center text-slate-500">

                        Belum ada kategori.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="px-8 py-6 border-t bg-slate-50/50">
        {{ $categories->links() }}
    </div>

</div>

@endsection