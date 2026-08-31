<?php

namespace App\Http\Controllers;

use App\Models\Worksheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WorksheetController extends Controller
{
    public function index(Request $request)
    {
        $query = Worksheet::where('user_id', Auth::id());

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $worksheets = $query->latest('tanggal')->paginate(20);

        return view('worksheet.index', [
            'title' => 'Worksheet',
            'worksheets' => $worksheets,
            'tanggal_dari' => $request->tanggal_dari,
            'tanggal_sampai' => $request->tanggal_sampai,
            'status_filter' => $request->status,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jenis_pekerjaan' => 'required|string|max:255',
            'keterangan_pekerjaan' => 'required|string',
            'perkiraan_pekerjaan' => 'required|string|max:255',
            'status' => 'required|in:Proses,Selesai,Batal',
        ]);

        $validated['user_id'] = Auth::id();
        Worksheet::create($validated);

        return redirect()
            ->route('worksheet.index')
            ->with('success', 'Worksheet berhasil ditambahkan!');
    }

    public function show(Worksheet $worksheet)
    {
        return view('worksheet.show', [
            'title' => 'Detail Worksheet',
            'worksheet' => $worksheet,
        ]);
    }

    public function update(Request $request, Worksheet $worksheet)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jenis_pekerjaan' => 'required|string|max:255',
            'keterangan_pekerjaan' => 'required|string',
            'perkiraan_pekerjaan' => 'required|string|max:255',
            'status' => 'required|in:Proses,Selesai,Batal',
        ]);

        $worksheet->update($validated);

        return redirect()
            ->route('worksheet.index')
            ->with('success', 'Worksheet berhasil diupdate!');
    }

    public function destroy(Worksheet $worksheet)
    {
        $worksheet->delete();

        return redirect()->route('worksheet.index')->with('success', 'Worksheet berhasil dihapus!');
    }

    public function print(Request $request)
    {
        $query = Worksheet::where('user_id', Auth::id());

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $worksheets = $query->latest('tanggal')->get();

        return view('worksheet.print', [
            'worksheets' => $worksheets,
            'tanggal_dari' => $request->tanggal_dari,
            'tanggal_sampai' => $request->tanggal_sampai,
            'status_filter' => $request->status,
        ]);
    }
}
