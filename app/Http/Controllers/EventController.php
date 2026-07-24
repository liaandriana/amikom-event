<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function show($id)
    {
        $event = Event::with(['category', 'reviews.user'])->findOrFail($id);

        return view('event-detail', compact('event'));
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function ticket()
    {
       $transaction = Transaction::with(['event', 'review'])
        ->where('customer_email', Auth::user()->email)
        ->whereIn('status', ['settlement', 'success'])
        ->latest()
        ->first();

        return view('my-ticket', compact('transaction'));
    }
}