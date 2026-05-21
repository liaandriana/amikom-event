<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Partner;
// Jangan lupa import class Request di bawah ini
use Illuminate\Http\Request; 

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil input 'category' dari query string di URL
        $categorySlug = $request->input('category');

        // 2. Ambil data event dengan kondisi (kondisional filter)
        $events = Event::with('category')
            ->when($categorySlug, function ($query, $slug) {
                return $query->whereHas('category', function ($q) use ($slug) {
                    $q->where('slug', $slug);
                });
            })
            ->get();

        // 3. Ambil data categories dan partners seperti biasa
        $categories = Category::all();
        $partners = Partner::all();

        return view('welcome', compact(
            'events',
            'categories',
            'partners'
        ));
    }
}