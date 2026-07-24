@extends('layouts.organization')

@section('title', 'Event Saya')

@section('page_title', 'Kelola Event')

@section('page_subtitle', 'Kelola event milik organisasi Anda.')

@section('content')

<div class="mb-4 text-right">
    <a href="{{ route('organization.events.create') }}"
       class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700">
        + Tambah Event
    </a>
</div>

<div class="bg-white rounded-3xl shadow overflow-hidden">

    <table class="min-w-full table-auto border-collapse">

        <thead class="bg-gray-50">

            <tr>

                <th class="px-6 py-4 text-left font-bold">Poster</th>
                <th class="px-6 py-4 text-left font-bold">Event</th>
                <th class="px-6 py-4 text-left font-bold">Harga</th>
                <th class="px-6 py-4 text-left font-bold">Stok</th>
                <th class="px-6 py-4 text-left font-bold">Aksi</th>

            </tr>

        </thead>

       <tbody>

@forelse($events as $event)

<tr class="border-t">

    {{-- Poster --}}
    <td class="px-6 py-4 align-middle">

        @if($event->poster_path)

            <img src="{{ asset('storage/'.$event->poster_path) }}"
                class="w-16 h-20 rounded-xl object-cover">

        @else

            <img src="https://placehold.co/100x120"
                class="w-16 h-20 rounded-xl object-cover">

        @endif

    </td>

    {{-- Event --}}
    <td class="px-6 py-4 align-middle">

        <h4 class="font-bold">
            {{ $event->title }}
        </h4>

        <p class="text-sm text-gray-500">
            {{ $event->category->name }}
        </p>

    </td>

    {{-- Harga --}}
    <td class="px-6 py-4 align-middle">

        Rp {{ number_format($event->price,0,',','.') }}

    </td>

    {{-- Stok --}}
    <td class="px-6 py-4 align-middle">

        {{ $event->stock }}

    </td>

    {{-- Aksi --}}
    <td class="px-6 py-4 align-middle">

        <div class="flex gap-2">

            <a href="{{ route('organization.events.edit',$event->id) }}"
                class="bg-blue-500 text-white px-4 py-2 rounded">
                Edit
            </a>

            <form
                action="{{ route('organization.events.destroy',$event->id) }}"
                method="POST">

                @csrf
                @method('DELETE')

                <button
                    class="bg-red-500 text-white px-4 py-2 rounded">

                    Hapus

                </button>

            </form>

        </div>

    </td>

</tr>

@empty

<tr>

<td colspan="5" class="text-center py-10">

Belum ada event.

</td>

</tr>

@endforelse

</tbody>
    </table>

</div>

<div class="mt-5">

    {{ $events->links() }}

</div>

@endsection