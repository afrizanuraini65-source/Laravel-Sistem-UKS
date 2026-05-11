<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $query = Medicine::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('nama_obat', 'like', "%{$search}%");
        }

        $medicines = $query->latest()->paginate(10);
        return view('medicines.index', compact('medicines'));
    }

    public function create()
    {
        return view('medicines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255|unique:medicines',
            'satuan' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
        ]);

        Medicine::create($request->all());

        return redirect()->route('medicines.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function edit(Medicine $medicine)
    {
        return view('medicines.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255|unique:medicines,nama_obat,' . $medicine->id,
            'satuan' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
        ]);

        $medicine->update($request->all());

        return redirect()->route('medicines.index')->with('success', 'Obat berhasil diperbarui.');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return redirect()->route('medicines.index')->with('success', 'Obat berhasil dihapus.');
    }
}
