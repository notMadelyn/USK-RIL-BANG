<?php

namespace App\Exports;

use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanAnggota implements FromView
{
    protected $user_id;
    protected $done;

    public function __construct($request)
    {
        $this->user_id = $request->user_id;
        $this->done = $request->done;
    }

    public function view(): View
    {
        if ($this->done != null) {
            if ($this->done === "false") {
                $datas = Peminjaman::where(['user_id' => $this->user_id, 'done' => false])->get();
            } else {
                $datas = Peminjaman::where(['user_id' => $this->user_id, 'done' => true])->get();
            }

            $anggota = User::find($this->user_id);
        } else {
            $datas = Peminjaman::where('user_id', $this->user_id)->get();
            $anggota = User::find($this->user_id);
        }

        $info = 'Laporan Anggota : ' . $anggota->fullname;
        return view('admin.excel_export', compact('datas', 'info'));
    }
}
