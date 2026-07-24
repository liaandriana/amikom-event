<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::paginate(10);

        return view('admin.jabatan.index', compact('jabatans'));
    }

    public function create()
    {
        return view('admin.jabatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);

        Jabatan::create([
            'name' => $request->name,
            'created_by' => Auth::user()?->name,
        ]);

        return redirect()->route('admin.jabatan.index')
            ->with('success', 'Data jabatan berhasil ditambahkan');
    }

    public function edit(int $id)
    {
        $jabatan = Jabatan::findOrFail($id);

        return view('admin.jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);

        $jabatan = Jabatan::findOrFail($id);

        $jabatan->update([
            'name' => $request->name,
            'updated_by' => Auth::user()?->name,
        ]);

        return redirect()->route('admin.jabatan.index')
            ->with('success', 'Data jabatan berhasil diupdate');
    }

    public function destroy(int $id)
    {
        Jabatan::findOrFail($id)->delete();

        return redirect()->route('admin.jabatan.index')
            ->with('success', 'Data jabatan berhasil dihapus');
    }
}