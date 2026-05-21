@extends('layouts.admin')

@section('content')

<header class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-3xl font-black">
            Kelola Partner
        </h1>

        <p class="text-slate-500">
            Atur partner dan sponsor event.
        </p>
    </div>

    <a href="{{ route('admin.partners.create') }}"
       class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold">

        + Tambah

    </a>

</header>

<div class="mb-6">

    <form action="{{ route('admin.partners.index') }}"
          method="GET"
          class="flex gap-4">

        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Cari partner..."
               class="flex-1 px-5 py-3 rounded-xl border border-slate-200">

        <button type="submit"
                class="px-5 py-3 bg-indigo-600 text-white rounded-xl font-bold">

            Cari

        </button>

    </form>

</div>

<div class="bg-white rounded-[2rem] shadow-sm overflow-hidden">

    <table class="w-full">

        <thead class="bg-slate-50">

            <tr>
                <th class="px-6 py-4">No</th>
                <th class="px-6 py-4">Logo</th>
                <th class="px-6 py-4">Nama</th>
                <th class="px-6 py-4 text-right">Aksi</th>
            </tr>

        </thead>

        <tbody>

            @forelse($partners as $index => $partner)

            <tr class="border-t">

                <td class="px-6 py-4">
                    <div class="flex justify-center items-center">
                    {{ $partners->firstItem() + $index }}
                    </div>
                </td>

                <td class="px-6 py-4">

                <div class="flex justify-center items-center">

                    <img src="{{ $partner->logo_url }}"
                        alt="Logo Partner"
                        class="w-20 h-20 object-contain bg-white border rounded-xl p-2">

                </div>

            </td>

                <td class="px-6 py-4 font-semibold">
                    <div class="flex justify-center items-center">
                    {{ $partner->name }}
                    </div>
                </td>

                <td class="px-6 py-4">

                    <div class="flex justify-end gap-2">

                        <!-- EDIT -->
                        <a href="{{ route('admin.partners.edit', $partner->id) }}"
                           class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl">

                            Edit

                        </a>

                        <!-- DELETE -->
                        <form action="{{ route('admin.partners.destroy', $partner->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus partner ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="px-4 py-2 bg-rose-50 text-rose-600 rounded-xl">

                                Hapus

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="4"
                    class="text-center py-10 text-slate-500">

                    Belum ada partner.

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

    <div class="p-6 border-t">
        {{ $partners->links() }}
    </div>

</div>

@endsection