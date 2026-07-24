<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::with('jabatan')->paginate(10);
        return view('admin.pengurus.index', compact('pengurus'));
    }

    public function create()
    {
        $jabatans = Jabatan::all();
        return view('admin.pengurus.create', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan_id' => 'required|exists:jabatans,id',
            'name' => 'required|max:100',
            'description' => 'required|max:255',
            'salary' => 'required|numeric',
        ]);

        Pengurus::create([
            'jabatan_id' => $request->jabatan_id,
            'name' => $request->name,
            'description' => $request->description,
            'salary' => $request->salary,
            'created_by' => 'admin',
            'updated_by' => 'admin',
        ]);

        return redirect()->route('admin.pengurus.index')
            ->with('success', 'Data pengurus berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        $jabatans = Jabatan::all();

        return view('admin.pengurus.edit', compact('pengurus', 'jabatans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jabatan_id' => 'required|exists:jabatans,id',
            'name' => 'required|max:100',
            'description' => 'required|max:255',
            'salary' => 'required|numeric',
        ]);

        $pengurus = Pengurus::findOrFail($id);

        $pengurus->update([
            'jabatan_id' => $request->jabatan_id,
            'name' => $request->name,
            'description' => $request->description,
            'salary' => $request->salary,
            'updated_by' => 'admin',
        ]);

        return redirect()->route('admin.pengurus.index')
            ->with('success', 'Data pengurus berhasil diubah');
    }

    public function destroy($id)
    {
        Pengurus::findOrFail($id)->delete();

        return redirect()->route('admin.pengurus.index')
            ->with('success', 'Data pengurus berhasil dihapus');
    }
}