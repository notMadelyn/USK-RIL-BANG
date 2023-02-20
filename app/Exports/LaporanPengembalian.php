<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanPengembalian implements FromView
{
    private $tanggal_pengembalian;

    public function __construct($request)
    {
        $this->tanggal_pengembalian = $request->tanggal_pengembalian;
    }

    public function view(): View
    {
        if ($this->tanggal_pengembalian !== null) {
            $datas = Peminjaman::where(['done' => true, 'tanggal_pengembalian' => $this->tanggal_pengembalian])->get();
            $info = 'Laporan Pengembalian Tanggal : ' . $this->tanggal_pengembalian;
        } else {
            $datas = Peminjaman::where('done', true)->get();
            $info = 'Laporan Pengembalian';
        }
        return view('admin.excel_export', compact('datas', 'info'));
    }
}
