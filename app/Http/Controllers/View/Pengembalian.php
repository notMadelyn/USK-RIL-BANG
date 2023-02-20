<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Pengembalian extends Controller
{
    public function show_pengembalian()
    {
        $datas = Peminjaman::where('user_id', Auth::user()->id)->where('done', true)->get();

        return view('user.pengembalian', compact('datas'));
    }

    public function pengembalian_form()
    {
        $pengembalian = Peminjaman::where('user_id', Auth::user()->id)->whereNotNull('tanggal_peminjaman')->where('done', false)->get();

        return view('user.form_pengembalian', compact('pengembalian'));
    }

    public function submit_pengembalian(Request $request)
    {
        $request->validate([
            'kondisi_buku_saat_dikembalikan' => 'required',
            'buku_id' => 'required',
            'tanggal_pengembalian' => 'required'
        ]);

        $cek = Peminjaman::where('user_id', Auth::user()->id)
            ->where('buku_id', $request->buku_id)
            ->where('done', false)
            ->first();

        $cek->update([
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'kondisi_buku_saat_dikembalikan' => $request->kondisi_buku_saat_dikembalikan,
            'done' => true
        ]);

        if ($request->kondisi_buku_saat_dikembalikan == 'baik' && $cek->kondisi_buku_saat_dipinjam == "baik" && $cek->denda == null) {
            $buku = Buku::where('id', $request->buku_id)->first();

            $buku->update([
                'j_buku_baik' => $buku->j_buku_baik + 1
            ]);

            $cek->update([
                'denda' => null
            ]);
        }

        if ($request->kondisi_buku_saat_dikembalikan == 'buruk' && $cek->kondisi_buku_saat_dipinjam == 'baik') {
            $buku = Buku::where('id', $request->buku_id)->first();

            $buku->update([
                'j_buku_buruk' => $buku->j_buku_buruk + 1
            ]);

            $cek->update([
                'denda' => 20000,
            ]);
        }

        if ($request->kondisi_buku_saat_dikembalikan == 'baik' && $cek->kondisi_buku_saat_dipinjam == 'buruk') {
            $buku = Buku::where('id', $request->buku_id)->first();

            $buku->update([
                'j_buku_rusak' => $buku->j_buku_rusak + 1
            ]);

            $cek->update([
                'denda' => null,
                'kondisi_buku_saat_dikembalikan' => 'buruk'
            ]);
        }

        if ($request->kondisi_buku_saat_dikembalikan == 'buruk' && $cek->kondisi_buku_saat_dipinjam == 'buruk') {
            $buku = Buku::where('id', $request->buku_id)->first();

            $buku->update([
                'j_buku_rusak' => $buku->j_buku_rusak + 1
            ]);

            $cek->update([
                'denda' => null
            ]);
        }

        if ($request->kondisi_buku_saat_dikembalikan == 'hilang') {

            $cek->update([
                'denda' => 50000
            ]);
        }

        if (!$cek) {
            return redirect()->back()->with('status_pengembalian', 'danger')->with('message', "Gagal Mengembalikan buku");
        }
        return redirect()->route('user.pengembalian')->with('status_pengembalian', 'success')->with('message', 'Berhasil Mengembalikan Buku');
    }
}
