<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\InputAspirasi;
use App\Models\Aspirasi;
use App\Models\Kategori;

class SiswaController extends Controller
{
    // 1. Menampilkan Halaman Utama Siswa (Form + Histori)
    public function index()
    {
        // Ambil data siswa yang sedang login
        $siswa = Auth::guard('siswa')->user();

        // Ambil daftar kategori untuk pilihan di Form
        $kategori = Kategori::all();

        // Ambil histori pengaduan milik siswa ini beserta statusnya (Eager Loading)
        $histori = InputAspirasi::with('detailAspirasi')
            ->where('nis', $siswa->nis)
            ->orderBy('id_pelaporan', 'desc')
            ->get();

        // Nanti kita arahkan ke file view 'siswa.aspirasi'
        return view('siswa.aspirasi', compact('siswa', 'kategori', 'histori'));
    }

    // 2. Menyimpan Pengaduan Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'lokasi' => 'required|max:100',
            'keterangan' => 'required',
            'is_anonim' => 'nullable|boolean',
        ]);

        $siswa = Auth::guard('siswa')->user();

        $input = InputAspirasi::create([
            'nis' => $siswa->nis,
            'id_kategori' => $request->id_kategori,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'is_anonim' => $request->has('is_anonim') ? 1 : 0,
        ]);

        Aspirasi::create([
            'id_pelaporan' => $input->id_pelaporan,
            'status' => 'Menunggu',
        ]);

        return redirect()->back()->with('success', 'Aspirasi berhasil dikirim!');
    }
    // 3. Lihat Detail & Status Aspirasi
    public function show($id)
    {
        $siswa = Auth::guard('siswa')->user();

        // Pastikan siswa hanya bisa lihat aspirasi miliknya sendiri
        $aspirasi = InputAspirasi::with(['detailAspirasi', 'kategori'])
            ->where('id_pelaporan', $id)
            ->where('nis', $siswa->nis) // Security: cegah akses data orang lain
            ->firstOrFail();

        return view('siswa.detail', compact('aspirasi'));
    }
}