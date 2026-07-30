<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // Menampilkan semua event
    public function index()
    {
        $events = Event::with('category')->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    // Form tambah event
    public function create()
    {
        $categories = Category::all();
        $organizations = Organization::all();

        return view('admin.events.create', compact(
            'categories',
            'organizations'
        ));
    }

    // Simpan event
    public function store(Request $request)
    {
        $request->validate([
            'organization_id' => 'nullable|exists:organizations,id',
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable',
            'date' => 'required',
            'location' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $posterPath = null;

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        Event::create([
            'organization_id' => $request->organization_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            'price' => $request->price,
            'stock' => $request->stock,
            'poster_path' => $posterPath,
        ]);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Data event berhasil ditambahkan');
    }

    // Form edit
    public function edit(Event $event)
    {
        $categories = Category::all();
        $organizations = Organization::all();

        return view('admin.events.edit', compact(
            'event',
            'categories',
            'organizations'
        ));
    }

    // Update event
    public function update(Request $request, $id)
    {
        $request->validate([
            'organization_id' => 'required|exists:organizations,id',
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable',
            'date' => 'required',
            'location' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $event = Event::findOrFail($id);

        $data = $request->except('poster');

        if ($request->hasFile('poster')) {

            if ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) {
                Storage::disk('public')->delete($event->poster_path);
            }

            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        $event->update($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Data event berhasil diupdate');
    }

    // Hapus event
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->poster_path && Storage::disk('public')->exists($event->poster_path)) {
            Storage::disk('public')->delete($event->poster_path);
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Data event berhasil dihapus');
    }
}