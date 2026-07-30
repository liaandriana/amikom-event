<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $organization = Auth::guard('organization')->user();

        $transactions = Transaction::whereHas('event', function ($query) use ($organization) {
            $query->where('organization_id', $organization->id);
        })
        ->whereIn('status', ['settlement', 'success'])
        ->get();

        $totalRevenue = $transactions->sum('total_price');

        $totalTransaction = $transactions->count();

        // Menghitung jumlah event milik organisasi
        $totalEvent = Event::where('organization_id', $organization->id)->count();

        return view('Organization.dashboard', compact(
            'organization',
            'totalRevenue',
            'totalTransaction',
            'totalEvent'
        ));
    }
}