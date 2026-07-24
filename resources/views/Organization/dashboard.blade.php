@extends('layouts.organization')

@section('title','Dashboard Organisasi')

@section('page_title','Dashboard')

@section('page_subtitle','Analitik organisasi')

@section('content')

<div class="grid grid-cols-3 gap-6">

    <div class="bg-white rounded-2xl shadow p-6">

        <h3 class="text-slate-500">
            Total Event
        </h3>

        <p class="text-4xl font-bold mt-2">

            {{ $totalEvent }}

        </p>

    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <h3 class="text-slate-500">
            Total Transaksi
        </h3>

        <p class="text-4xl font-bold mt-2">

            {{ $totalTransaction }}

        </p>

    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <h3 class="text-slate-500">
            Total Pendapatan
        </h3>

        <p class="text-3xl font-bold text-green-600 mt-2">

            Rp {{ number_format($totalRevenue,0,',','.') }}

        </p>

    </div>

</div>

@endsection