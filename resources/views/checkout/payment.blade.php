@extends('layouts.app')

@section('title', 'Pembayaran Tiket')

@section('content')
<main class="max-w-4xl mx-auto px-6 py-16">

    <div class="text-center mb-10">
        <h1 class="text-4xl font-extrabold text-slate-800">
            Selesaikan Pembayaran
        </h1>
        <p class="text-slate-500 mt-3">
            Pesanan Anda berhasil dibuat. Silakan lanjutkan pembayaran melalui Midtrans.
        </p>
    </div>

    <div class="bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">

        <div class="bg-indigo-600 text-white p-6">
            <h2 class="text-2xl font-bold">
                Detail Pesanan
            </h2>
        </div>

        <div class="p-8">

            <div class="space-y-4">

                <div class="flex justify-between border-b pb-3">
                    <span class="font-semibold text-slate-600">
                        Order ID
                    </span>
                    <span class="font-bold">
                        {{ $transaction->order_id }}
                    </span>
                </div>

                <div class="flex justify-between border-b pb-3">
                    <span class="font-semibold text-slate-600">
                        Nama Pemesan
                    </span>
                    <span>
                        {{ $transaction->customer_name }}
                    </span>
                </div>

                <div class="flex justify-between border-b pb-3">
                    <span class="font-semibold text-slate-600">
                        Event
                    </span>
                    <span>
                        {{ $transaction->event->title }}
                    </span>
                </div>

                <div class="flex justify-between border-b pb-3">
                    <span class="font-semibold text-slate-600">
                        Status
                    </span>

                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-bold">
                        {{ $transaction->status }}
                    </span>
                </div>

                <div class="flex justify-between pt-4">
                    <span class="text-xl font-bold">
                        Total Pembayaran
                    </span>

                    <span class="text-2xl font-black text-indigo-600">
                        Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                    </span>
                </div>

            </div>

            <div class="mt-10">

                <button id="pay-button"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black text-lg py-4 rounded-2xl shadow-lg transition">

                    Munculkan Jendela Pembayaran

                </button>

            </div>

            <div class="mt-6 text-center text-sm text-slate-500">
                Pilih metode pembayaran yang tersedia pada popup Midtrans
                (BCA Virtual Account, GoPay, dan lainnya).
            </div>

        </div>

    </div>

</main>

<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
</script>

<script>
    document.getElementById('pay-button').onclick = function () {

        snap.pay('{{ $transaction->snap_token }}', {

           onSuccess: function(result) {

            window.location.href = "{{ route('my-ticket') }}";

            },

            onPending: function(result) {
                alert('Menunggu Pembayaran');
                console.log(result);
            },

            onError: function(result) {
                alert('Pembayaran Gagal');
                console.log(result);
            },

            onClose: function() {
                alert('Popup pembayaran ditutup.');
            }

        });

    };
</script>

@endsection