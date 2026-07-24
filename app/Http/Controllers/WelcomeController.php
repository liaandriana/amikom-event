<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Partner;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kategori dari URL
        $categorySlug = $request->input('category');

        // Ambil event beserta category dan reviews
        $events = Event::with([
                'category',
                'reviews'
            ])
            ->when($categorySlug, function ($query, $slug) {
                return $query->whereHas('category', function ($q) use ($slug) {
                    $q->where('slug', $slug);
                });
            })
            ->get();

        // Data kategori & partner
        $categories = Category::all();
        $partners = Partner::all();

        return view('welcome', compact(
            'events',
            'categories',
            'partners'
        ));
    }
}