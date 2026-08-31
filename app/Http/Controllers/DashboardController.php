<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $barangs = $this->filterBarang($request)->latest()->get();

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'barangs' => $barangs,
            'filters' => $request->only(['search', 'kondisi', 'lokasi', 'jenis']),
            'kondisiOptions' => Barang::select('kondisi')->distinct()->orderBy('kondisi')->pluck('kondisi'),
            'lokasiOptions' => Barang::select('lokasi')->distinct()->orderBy('lokasi')->pluck('lokasi'),
            'jenisOptions' => Barang::select('jenis')->distinct()->orderBy('jenis')->pluck('jenis'),
        ]);
    }

    public function print(Request $request)
    {
        return view('dashboard.print', [
            'title' => 'Print Data Barang',
            'barangs' => $this->filterBarang($request)->latest()->get(),
            'filters' => $request->only(['search', 'kondisi', 'lokasi', 'jenis']),
        ]);
    }

    private function filterBarang(Request $request)
    {
        return Barang::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($query) use ($search) {
                    $query->where('kode_barang', 'like', "%{$search}%")
                        ->orWhere('nama_barang', 'like', "%{$search}%")
                        ->orWhere('merk', 'like', "%{$search}%")
                        ->orWhere('type', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('kondisi'), function ($query) use ($request) {
                $query->where('kondisi', $request->kondisi);
            })
            ->when($request->filled('lokasi'), function ($query) use ($request) {
                $query->where('lokasi', $request->lokasi);
            })
            ->when($request->filled('jenis'), function ($query) use ($request) {
                $query->where('jenis', $request->jenis);
            });
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_barang' => 'required|unique:data_barang',
            'nama_barang' => 'required',
            'merk' => 'required',
            'type' => 'required',
            'spesifikasi' => 'required',
            'jenis' => 'required',
            'stok' => 'required|numeric',
            'satuan' => 'required',
            'lokasi' => 'required',
            'kondisi' => 'required',
            'keterangan' => 'nullable'
        ]);

        Barang::create($validatedData);

        return redirect('/dashboard')->with('success', 'Data barang berhasil ditambahkan!');
    }

    public function show($id)
    {
        return view('dashboard.show', [
            'title' => 'Detail Barang',
            'barang' => Barang::findOrFail($id)
        ]);
    }

    public function edit($id)
    {
        return view('dashboard.edit', [
            'title' => 'Edit Barang',
            'barang' => Barang::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $rules = [
            'nama_barang' => 'required',
            'merk' => 'required',
            'type' => 'required',
            'spesifikasi' => 'required',
            'jenis' => 'required',
            'stok' => 'required|numeric',
            'satuan' => 'required',
            'lokasi' => 'required',
            'kondisi' => 'required',
            'keterangan' => 'nullable'
        ];

        // Only validate kode_barang uniqueness if it's changed
        if ($request->kode_barang != $barang->kode_barang) {
            $rules['kode_barang'] = 'required|unique:data_barang';
        }

        $validatedData = $request->validate($rules);

        $barang->update($validatedData);

        return redirect('/dashboard')->with('success', 'Data barang berhasil diupdate!');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect('/dashboard')->with('success', 'Data barang berhasil dihapus!');
    }
}
