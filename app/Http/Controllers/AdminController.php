<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InputAspirasi;
use App\Models\Aspirasi;

class AdminController extends Controller
{
    // 1. Lihat Semua Laporan
    public function index()
    {
        $laporan = InputAspirasi::with(['siswa', 'kategori', 'detailAspirasi'])
            ->orderBy('id_pelaporan', 'desc')
            ->get();

        return view('admin.dashboard', compact('laporan'));
    }

    // 2. Ubah Status & Beri Feedback
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status'   => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'nullable|string',
        ]);

        $aspirasi = Aspirasi::where('id_pelaporan', $id)->firstOrFail();

        $aspirasi->status   = $request->status;
        $aspirasi->feedback = $request->feedback;
        $aspirasi->save();

        return redirect()->back()->with('success', 'Status berhasil diupdate!');
    }
}