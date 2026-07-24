<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{
    /**
     * Menyimpan review dari user.
     */
    public function store(Request $request, Transaction $transaction)
    {
        // Harus login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Validasi input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        // Pastikan transaksi milik user yang login
        if ($transaction->customer_email != Auth::user()->email) {
            abort(403);
        }

        // Pastikan pembayaran berhasil
        if (!in_array(strtolower($transaction->status), ['success', 'settlement'])) {
            return back()->with(
                'error',
                'Review hanya dapat diberikan setelah pembayaran berhasil.'
            );
        }

        // Pastikan event sudah selesai + 1 hari
        $reviewDate = Carbon::parse($transaction->event->date)->addDay();

        if (now()->lt($reviewDate)) {
            return back()->with(
                'error',
                'Review baru bisa diberikan sehari setelah acara selesai.'
            );
        }

        // Cek apakah sudah pernah review
        if ($transaction->review) {
            return back()->with(
                'error',
                'Anda sudah memberikan review untuk tiket ini.'
            );
        }

        // Simpan review
        Review::create([
            'transaction_id' => $transaction->id,
            'event_id'       => $transaction->event_id,
            'user_id'        => Auth::id(),
            'rating'         => $request->rating,
            'review'         => $request->review,
        ]);

        return back()->with(
            'success',
            'Terima kasih! Review berhasil dikirim.'
        );
    }
}