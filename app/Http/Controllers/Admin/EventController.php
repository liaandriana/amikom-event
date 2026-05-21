<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // READ (Menampilkan data)
   public function index()
    {
        $events = Event::paginate(10);
        return view('admin.events.index', compact('events'));
    }

    // FORM CREATE
    public function create()
    {
        $categories = Category::all();
        return view('admin.events.create', compact('categories'));
    }

    // CREATE (Simpan data)
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'date' => 'required',
            'location' => 'required'
        ]);

        // Simpan ke database
        Event::create($request->all());

        return redirect()->route('admin.events.index')
            ->with('success', 'Data event berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();

        return view('admin.events.edit', compact('event', 'categories'));
    }

    // UPDATE data
    public function update(Request $request, $id)
    {
        // Validasi
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'date' => 'required',
            'location' => 'required'
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());

        return redirect()->route('admin.events.index')
            ->with('success', 'Data event berhasil diupdate');
    }

    // DELETE data
    public function destroy($id)
    {
        Event::destroy($id);

        return redirect()->route('admin.events.index')
            ->with('success', 'Data event berhasil dihapus');
    }
}