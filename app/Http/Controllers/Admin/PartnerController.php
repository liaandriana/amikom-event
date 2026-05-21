<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    // READ + SEARCH
    public function index(Request $request)
{
    $search = $request->search;

    $partners = Partner::where('name', 'LIKE', '%' . $search . '%')
                    ->paginate(10);

    return view('admin.partners.index', compact('partners'));
}

    // FORM CREATE
    public function create()
    {
        return view('admin.partners.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo_url' => 'required'
        ]);

        Partner::create($request->all());

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit($id)
    {
        $partner = Partner::findOrFail($id);

        return view('admin.partners.edit', compact('partner'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'logo_url' => 'required'
        ]);

        $partner = Partner::findOrFail($id);

        $partner->update($request->all());

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil diupdate');
    }

    // DELETE
    public function destroy($id)
    {
        Partner::destroy($id);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil dihapus');
    }
}