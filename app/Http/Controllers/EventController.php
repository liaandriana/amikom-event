<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

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
    $transactions = Transaction::with(['event', 'review'])
        ->where('customer_email', Auth::user()->email)
        ->latest()
        ->get();

    return view('my-ticket', compact('transactions'));
}

    
}