<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total pendapatan
        $totalRevenue = Transaction::whereIn('status', ['success', 'settlement'])
            ->sum('total_price');

        // Tiket terjual
       $ticketsSold = Transaction::whereIn('status', ['success', 'settlement'])
        ->count();

        // Event aktif
        $activeEvents = Event::count();

        // Pesanan pending
        $pendingOrders = Transaction::where('status', 'pending')->count();

        // Transaksi terbaru
        $recentTransactions = Transaction::with('event')
            ->latest()
            ->take(10)
            ->get();

        // Grafik pertumbuhan event
        $chart = Event::select(
                DB::raw('MONTH(date) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];

        foreach ($chart as $item) {
            $labels[] = date('M', mktime(0,0,0,$item->month,1));
            $data[] = $item->total;
        }

        return view('admin.dashboard', compact(
            'totalRevenue',
            'ticketsSold',
            'activeEvents',
            'pendingOrders',
            'recentTransactions',
            'labels',
            'data'
        ));
    }
}