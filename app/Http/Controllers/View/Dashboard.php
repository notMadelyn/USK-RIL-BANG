<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Identitas;
use App\Models\Kategori;
use App\Models\Pemberitahuan;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $anggota = User::where('role', 'user')->get();
        $buku = Buku::get();
        $peminjaman = Peminjaman::where('done', false)->get();
        $pengembalian = Peminjaman::where('done', true)->get();
        $pemberitahuans = Pemberitahuan::where('status', 'aktif')->orWhere('status', 'admin')->get();
        $identitas = Identitas::find(1);

        return view('admin.dashboard', compact('anggota', 'buku', 'identitas', 'peminjaman', 'pengembalian', 'pemberitahuans'));
    }
    public function user()
    {
        $pemberitahuans = Pemberitahuan::where('status', 'aktif')->orWhere('status', 'user')->get();
        $data = Kategori::all();
        $kategoris = $data->sortByDesc('bukus');

        return view('user.dashboard', compact('pemberitahuans', 'kategoris'));
    }

    public function nonactive_notif(Request $request)
    {
        $status = Pemberitahuan::where('id', $request->id)->first();
        $status->update([
            'status' => 'nonaktif'
        ]);
        return redirect()->back();
    }
}
