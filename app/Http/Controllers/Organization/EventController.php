<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('organization_id', Auth::guard('organization')->id())
            ->with('category')
            ->latest()
            ->paginate(10);

        return view('organization.events.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('organization.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable',
            'date' => 'required',
            'location' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $poster = null;

        if ($request->hasFile('poster')) {
            $poster = $request->file('poster')->store('posters', 'public');
        }

        Event::create([
            'organization_id' => Auth::guard('organization')->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            'price' => $request->price,
            'stock' => $request->stock,
            'poster_path' => $poster,
        ]);

        return redirect()
            ->route('organization.events.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $event = Event::where('organization_id', Auth::guard('organization')->id())
            ->findOrFail($id);

        $categories = Category::all();

        return view('organization.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable',
            'date' => 'required',
            'location' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $event = Event::where('organization_id', Auth::guard('organization')->id())
            ->findOrFail($id);

        $data = $request->except('poster');

        if ($request->hasFile('poster')) {

            if ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) {
                Storage::disk('public')->delete($event->poster_path);
            }

            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        $event->update($data);

        return redirect()
            ->route('organization.events.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $event = Event::where('organization_id', Auth::guard('organization')->id())
            ->findOrFail($id);

        if ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) {
            Storage::disk('public')->delete($event->poster_path);
        }

        $event->delete();

        return redirect()
            ->route('organization.events.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}