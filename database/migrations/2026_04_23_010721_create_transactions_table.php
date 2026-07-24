<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Transaction::whereIn('status', ['success', 'settlement'])
            ->sum('total_price');

        $ticketsSold = Transaction::whereIn('status', ['success', 'settlement'])
            ->count();

        $activeEvents = Event::count();

        $pendingOrders = Transaction::where('status', 'pending')
            ->count();

        $recentTransactions = Transaction::with('event')
            ->latest()
            ->take(5)
            ->get();

        $labels = [];
        $data = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);

            $labels[] = $month->format('M');

            $data[] = Event::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
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