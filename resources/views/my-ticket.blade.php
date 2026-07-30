@extends('layouts.app')

@section('title','My Ticket')

@section('content')

<div class="max-w-5xl mx-auto py-6">

    <div class="bg-white rounded-2xl shadow border p-6">

        <h2 class="text-xl font-bold mb-5">
            My Ticket
        </h2>


        <div class="space-y-4">


        @foreach($transactions as $transaction)


            <div class="grid grid-cols-[1fr_120px_140px] gap-5 items-start border-b pb-4">


                <!-- Event -->
                <div>

                    <h3 class="font-semibold text-base">
                        {{ $transaction->event->title }}
                    </h3>


                    <p class="text-sm text-gray-500">
                        📅 {{ $transaction->event->date->format('d M Y') }}
                    </p>


                    <p class="text-sm text-gray-500">
                        📍 {{ $transaction->event->location }}
                    </p>

                </div>



                <!-- Status -->
<div class="flex justify-center pt-1">

    @if(in_array($transaction->status,['success','settlement']))

        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">
            Success
        </span>

    @elseif($transaction->status=='pending')

        <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs font-medium">
            Pending
        </span>

    @else

        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium">
            {{ ucfirst($transaction->status) }}
        </span>

    @endif

</div>



<!-- Action -->
<div class="text-right">

    @if(in_array($transaction->status,['success','settlement']))

        <a href="{{ route('checkout.success',$transaction->order_id) }}"
            class="inline-block bg-indigo-600 text-white text-xs px-4 py-2 rounded-lg">
            Lihat Tiket
        </a>

       @if(!$transaction->review)

<form action="{{ route('review.store',$transaction->id) }}"
      method="POST"
      class="mt-3">

    @csrf

    <input type="hidden"
           name="rating"
           id="rating-{{ $transaction->id }}"
           required>

    <div class="rating-stars flex gap-1 mb-2"
         data-id="{{ $transaction->id }}">

        @for($i=1;$i<=5;$i++)
            <span
                class="star text-xl text-gray-300 cursor-pointer"
                data-value="{{ $i }}">
                ★
            </span>
        @endfor

    </div>

    <textarea
        name="review"
        rows="2"
        class="w-full border rounded-lg p-2 text-xs"
        placeholder="Bagaimana pengalamanmu?"></textarea>

    <button
        class="mt-2 bg-indigo-600 text-white px-3 py-1 rounded-lg text-xs">
        Kirim Review
    </button>

</form>

@else

<div class="mt-2">

    <div class="text-yellow-400 text-xs">
        @for($i=1;$i<=5;$i++)
            @if($i <= $transaction->review->rating)
                ★
            @else
                ☆
            @endif
        @endfor
    </div>

    <p class="text-[11px] text-gray-500">
        {{ $transaction->review->review }}
    </p>

</div>

@endif
    @elseif($transaction->status=='pending')

        <a href="{{ route('checkout.payment',$transaction->order_id) }}"
            class="inline-block bg-orange-500 text-white text-xs px-4 py-2 rounded-lg">
            Bayar
        </a>

    @endif

</div>

            </div>


        @endforeach


        </div>

    </div>

</div>

<script>
document.querySelectorAll('.rating-stars').forEach(group => {

    const stars = group.querySelectorAll('.star');
    const input = document.getElementById('rating-' + group.dataset.id);

    stars.forEach((star, index) => {

        star.addEventListener('click', function () {

            input.value = index + 1;

            stars.forEach((s, i) => {
                s.classList.toggle('text-yellow-400', i <= index);
                s.classList.toggle('text-gray-300', i > index);
            });

        });

    });

});
</script>

@endsection