<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Pemberitahuan as ModelsPemberitahuan;
use Illuminate\Http\Request;

class Pemberitahuan extends Controller
{
    public function pemberitahuan_user(){
        $pemberitahuans = ModelsPemberitahuan::where('status', 'aktif')->orWhere('status', 'user')->get();

        return view('user.pemberitahuan', compact('pemberitahuans'));
    }
    public function pemberitahuan_admin(){
        $pemberitahuans = ModelsPemberitahuan::get();

        return view('admin.pemberitahuan', compact('pemberitahuans'));
    }

    public function submit_pemberitahuan(Request $request) {
        $pemberitahuan = ModelsPemberitahuan::create($request->all());

        if ($pemberitahuan) {
            return redirect()->back()->with('status', 'success')
            ->with('message', "Berhasil membuat pemberitahuan");
        }
    }

    public function nonactive_notif(Request $request)
    {
        $status = ModelsPemberitahuan::find($request->id);
        $status->update([
            'status' => 'nonaktif'
        ]);
        return redirect()->back();
    }
    public function activate_notif(Request $request, $id)
    {
        $status = ModelsPemberitahuan::find($id);
        $status->update([
            'isi' => $request->isi,
            'status' => $request->status
        ]);
        return redirect()->back();
    }
    public function delete_notif(Request $request)
    {
        $notif = ModelsPemberitahuan::find($request->id);
        $notif->delete();
        return redirect()->back();
    }
}
