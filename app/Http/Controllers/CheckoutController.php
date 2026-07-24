<?php

namespace App\Http\Controllers;

use App\Mail\EventTicketMail;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
   public function create(Event $event)
{
    $categories = \App\Models\Category::all();

    return view('checkout.create', compact('event', 'categories'));
}

    public function store(Request $request, Event $event)
    {
        // Validasi input
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
        ]);

        // Cek stok
        if ($event->stock <= 0) {
            return back()->with(
                'error',
                'Mohon maaf, tiket untuk acara ini sudah habis.'
            );
        }

        // Generate Order ID
        $orderId = 'TRX-' . time() . '-' . Str::random(5);

        // Cek apakah event gratis
        $isFreeEvent = ($event->price == 0);

        // Hitung total harga
        if ($isFreeEvent) {
            $totalPrice = 0;
        } else {
            $totalPrice = $event->price + 5000;
        }

        // Simpan transaksi
        $transaction = Transaction::create([
            'event_id' => $event->id,
            'order_id' => $orderId,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'total_price' => $totalPrice,
            'status' => 'Pending',
        ]);

        // Jika event gratis, langsung selesaikan transaksi
        if ($event->price == 0) {

            $transaction->update([
                'status' => 'success',
            ]);

            // Kurangi stok
            $event->decrement('stock');

            // Kirim E-Ticket
            try {
                Mail::to($transaction->customer_email)
                    ->send(new EventTicketMail($transaction));
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }

            return redirect()->route(
                'checkout.success',
                $transaction->order_id
            );
        }

        // Jika event gratis, lewati Midtrans
        if ($isFreeEvent) {

            // Kurangi stok
            $event->decrement('stock');

            // Update status transaksi
            $transaction->update([
                'status' => 'success'
            ]);

            // Kirim E-Ticket
            try {
                Mail::to($transaction->customer_email)
                    ->send(new EventTicketMail($transaction));
            } catch (\Exception $e) {
                Log::error('Gagal mengirim E-Ticket: ' . $e->getMessage());
            }

            // Langsung ke halaman sukses
            return redirect()->route(
                'checkout.success',
                $transaction->order_id
            );
        }

        // Jika event gratis, tidak perlu cek Midtrans
        if ($transaction->total_price == 0) {

            return view(
                'checkout.success',
                compact('transaction', 'categories')
            );

        }
        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $request->customer_name,
                'email' => $request->customer_email,
                'phone' => $request->customer_phone,
            ],
        ];

        try {

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $transaction->update([
                'snap_token' => $snapToken
            ]);

            return redirect()->route(
                'checkout.payment',
                $transaction->order_id
            );

        } catch (\Exception $e) {

            return back()->with(
                'error',
                'Gagal memproses pembayaran jaringan: ' .
                $e->getMessage()
            );

        }
    }

    public function payment($order_id)
    {
        $categories = \App\Models\Category::all();

        $transaction = Transaction::with('event')
            ->where('order_id', $order_id)
            ->firstOrFail();

        return view(
            'checkout.payment',
            compact('transaction', 'categories')
        );
    }

    public function success($order_id)
    {
        $categories = \App\Models\Category::all();

        $transaction = Transaction::with('event')
            ->where('order_id', $order_id)
            ->firstOrFail();

            // Jika transaksi gratis, tidak perlu cek Midtrans
            if ($transaction->total_price == 0) {

                return view(
                    'checkout.success',
                    compact('transaction', 'categories')
                );

            }

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        try {

            // Ambil status transaksi dari Midtrans
            $status = \Midtrans\Transaction::status($order_id);

            if ($status) {

                $trxStatus = is_array($status)
                    ? ($status['transaction_status'] ?? '')
                    : ($status->transaction_status ?? '');

                if (in_array($trxStatus, ['settlement', 'capture'])) {

                    if (strtolower($transaction->status) === 'pending') {

                        $transaction->update([
                            'status' => 'success'
                        ]);

                        if ($transaction->event && $transaction->event->stock > 0) {

                            $transaction->event->decrement('stock');

                            try {

                                Mail::to($transaction->customer_email)
                                    ->send(new EventTicketMail($transaction));

                            } catch (\Exception $e) {

                                Log::error(
                                    'Gagal mengirim email E-Ticket secara manual (Bypass): '
                                    . $e->getMessage()
                                );

                            }
                        }
                    }
                }
            }

        } catch (\Exception $e) {

            return redirect()
                ->route('home')
                ->with(
                    'error',
                    'Transaksi tidak ditemukan atau gagal diproses oleh sistem pembayaran.'
                );

        }

        return view(
            'checkout.success',
            compact('transaction', 'categories')
        );
    }
}
