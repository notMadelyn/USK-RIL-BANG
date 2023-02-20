<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Pemberitahuan;
use App\Models\Peminjaman as ModelsPeminjaman;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Peminjaman extends Controller
{
    public function show_peminjaman()
    {
        $peminjamans = ModelsPeminjaman::where(['user_id' => Auth::user()->id, 'done' => 0])->get();

        return view('user.peminjaman', compact('peminjamans'));
    }

    public function peminjaman_form()
    {
        $peminjamans = ModelsPeminjaman::where(['user_id' => Auth::user()->id, 'done' => 0])->get();
        $bukus = Buku::all();

        return view('user.form_peminjaman', compact('peminjamans', 'bukus'));
    }

    public function peminjaman_dashboard(Request $request)
    {
        $buku_id = $request->buku_id;
        $bukus = Buku::all();

        return view('user.form_peminjaman', compact('buku_id', 'bukus'));
    }

    
    public function submit_peminjaman(Request $request)
    {
        $tanggal_peminjaman = $request->tanggal_peminjaman;
        // $y_return = explode("-", $tanggal_peminjaman)[0];
        // $m_return = explode("-", $tanggal_peminjaman)[1];
        // $d_return = explode("-", $tanggal_peminjaman)[2] + 7;
        // $tanggal_pengembalian = "$y_return" . "-" . "$m_return" . "-" . "$d_return";
        $buku_id = $request->buku_id;
        $kondisi_buku_saat_dipinjam = $request->kondisi_buku_saat_dipinjam;
        $user_id = $request->user_id;

        // dd($request);

        try {
            ModelsPeminjaman::create([
                "tanggal_peminjaman" => $tanggal_peminjaman,
                "tanggal_pengembalian" => null,
                "buku_id" => $buku_id,
                "kondisi_buku_saat_dipinjam" => $kondisi_buku_saat_dipinjam,
                "user_id" => $user_id
            ]);

            $anggota = User::find($user_id);

            $buku = Buku::find($buku_id);

            Pemberitahuan::create([
                'isi' => 'Buku ' . $buku->judul . ' pada kategori ' . $buku->kategori->nama . ' telah dipinjam oleh ' . $anggota->fullname,
                'buku_id' => $buku->id,
                'kategori_id' => $buku->kategori_id,
                'status' => 'aktif'
            ]);

            if ($buku->j_buku_baik >= 1 || $buku->j_buku_buruk >= 1) {
                if ($request->kondisi_buku_saat_dipinjam == 'baik') {

                    $buku = Buku::where('id', $request->buku_id)->first();

                    $buku->update([
                        'j_buku_baik' => $buku->j_buku_baik - 1

                    ]);
                }

                if ($request->kondisi_buku_saat_dipinjam == 'buruk') {
                    $buku = Buku::where('id', $request->buku_id)->first();

                    $buku->update([
                        'j_buku_buruk' => $buku->j_buku_buruk - 1
                    ]);
                }
                return redirect()->route('user.peminjaman')->with('status', 'success')->with('message', 'Berhasil Meminjam Buku');
            } else {
                return redirect()->route('user.peminjaman')->with('status', 'danger')->with('message', "Gagal Meminjam Buku Stock Habis");
            }
        } catch (Exception $e) {
            return redirect()->route('user.peminjaman')->with('status', 'danger')->with('message', "Gagal Meminjam Buku" . $e);
        }
    }
}
