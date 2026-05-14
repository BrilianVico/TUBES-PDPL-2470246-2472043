<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    public function index()
    {
        $beasiswa = Beasiswa::orderBy('id_beasiswa', 'desc')->get();
        return view('admin.beasiswa.index', compact('beasiswa'));
    }

    public function create()
    {
        return view('admin.beasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_beasiswa' => 'required',
            'nominal_potongan' => 'required|numeric',
            'kuota' => 'required|integer',
            'status' => 'required'
        ]);

        Beasiswa::create($request->all());

        return redirect()
            ->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        return view('admin.beasiswa.edit', compact('beasiswa'));
    }

    public function update(Request $request, $id)
    {
        $beasiswa = Beasiswa::findOrFail($id);

        $request->validate([
            'nama_beasiswa' => 'required',
            'nominal_potongan' => 'required|numeric',
            'kuota' => 'required|integer',
            'status' => 'required'
        ]);

        $beasiswa->update($request->all());

        return redirect()
            ->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Beasiswa::findOrFail($id)->delete();

        return redirect()
            ->route('admin.beasiswa.index')
            ->with('success', 'Program beasiswa berhasil dihapus.');
    }
}
