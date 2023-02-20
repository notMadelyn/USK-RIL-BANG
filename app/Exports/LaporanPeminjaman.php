<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanPeminjaman implements FromView
{
    private $tanggal_peminjaman;

    public function __construct($request)
    {
        $this->tanggal_peminjaman = $request->tanggal_peminjaman;
    }

    public function view(): View
    {
        if ($this->tanggal_peminjaman !== null) {
            $datas = Peminjaman::where(['done' => false, 'tanggal_peminjaman' => $this->tanggal_peminjaman])->get();
            $info = 'Laporan Peminjaman Tanggal : ' . $this->tanggal_peminjaman;
        } else {
            $datas = Peminjaman::where('done', false)->get();
            $info = 'Laporan Peminjaman';
        }
        return view('admin.excel_export', compact('datas', 'info'));
    }
}
