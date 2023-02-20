<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DataAnggota extends Controller
{
    // Show View
    public function data_admin()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.data_admin', compact('admins'));
    }

    public function data_anggota()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.data_user', compact('users'));
    }

    // Store Data
    public function submit_anggota(Request $request)
    {
        $date = date("Y-m-d");

        $generate_code = 'USR' . substr(md5(random_int(1, 8605)), 0, 17);

        // Stored data validation
        $rules = [
            'fullname' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return redirect()->route('admin.data-anggota')->with('status', 'danger')->with('message', "Gagal Menambah Anggota, " . $errors);
        }

        if ($request->photo) {
            $imageName = time() . '.' . $request->photo->extension();

            $request->photo->move(public_path('img'), $imageName);
            try {
                User::create([
                    'kode' => $generate_code,
                    'nis' => $request->nis,
                    'fullname' => $request->fullname,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'kelas' => $request->kelas,
                    'alamat' => $request->alamat,
                    'photo' => "/img/" . $imageName,
                    'verif' => "verified",
                    'role' => 'user',
                    'join_date' => $date,
                    'terakhir_login' => null,
                ]);

                return redirect()->route('admin.data-anggota')->with(
                    'status',
                    'success'
                )->with('message', 'Berhasil Menambah Anggota');
            } catch (Exception $e) {
                return redirect()->route('admin.data-anggota')->with('status', 'danger')->with('message', "Gagal Menambah Anggota" . $e);
            }
        }
        $user = User::create([
            'kode' => $generate_code,
            'nis' => $request->nis,
            'fullname' => $request->fullname,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'verif' => "verified",
            'role' => 'user',
            'join_date' => $date,
            'terakhir_login' => null,
        ]);
        $user2 = User::where('username', $request->username)->update([
            "password" => Hash::make($request->password)
        ]);

        if ($user && $user2) {
            return redirect()->back()->with("status", "success")->with(
                'message',
                'Berhasil Menambah Anggota'
            );
        }
        return redirect()->route('admin.data-anggota')->with("status", "danger")->with('message', 'Gagal Menambah Anggota');
    }
    public function submit_admin(Request $request)
    {
        $date = date("Y-m-d");

        $generate_code = 'ADM' . substr(md5(random_int(1, 8605)), 0, 17);

        // Stored data validation
        $rules = [
            'fullname' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return redirect()->route('admin.data-admin')->with('status', 'danger')->with('message', "Gagal Menambah Admin, " . $errors);
        }

        if ($request->photo) {
            $imageName = time() . '.' . $request->photo->extension();

            $request->photo->move(public_path('img'), $imageName);
            try {
                User::create([
                    'kode' => $generate_code,
                    'nis' => $request->nis,
                    'fullname' => $request->fullname,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'kelas' => $request->kelas,
                    'alamat' => $request->alamat,
                    'photo' => "/img/" . $imageName,
                    'verif' => "verified",
                    'role' => 'admin',
                    'join_date' => $date,
                    'terakhir_login' => null,
                ]);

                return redirect()->route('admin.data-admin')->with(
                    'status',
                    'success'
                )->with('message', 'Berhasil Menambah Admin');
            } catch (Exception $e) {
                return redirect()->route('admin.data-admin')->with('status', 'danger')->with('message', "Gagal Menambah Admin");
            }
        }
        $user = User::create([
            'kode' => $generate_code,
            'nis' => $request->nis,
            'fullname' => $request->fullname,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'verif' => "verified",
            'role' => 'admin',
            'join_date' => $date,
            'terakhir_login' => null,
        ]);
        $user2 = User::where('username', $request->username)->update([
            "password" => Hash::make($request->password)
        ]);

        if ($user && $user2) {
            return redirect()->route('admin.data-admin')->with("status", "success")->with(
                'message',
                'Berhasil Menambah Admin'
            );
        }
        return redirect()->route('admin.data-admin')->with("status", "danger")->with('message', 'Gagal Menambah Admin');
    }

    // Update Data
    public function verif_user(Request $request)
    {
        $verif = User::where('id', $request->id)->first();
        $verif->update([
            'verif' => 'verified'
        ]);
        return redirect()->back();
    }
    public function update_profil(Request $request, $id)
    {
        if ($request->photo != null) {
            $imageName = time() . '.' . $request->photo->extension();

            $request->photo->move(public_path('img'), $imageName);
            $user = User::find($id)->update($request->all());

            $user2 = User::find($id)->update([
                // "password" => Hash::make($request->password),
                "photo" => "/img/" . $imageName
            ]);

            if ($user && $user2) {
                return redirect()->back()->with("status", "success")->with(
                    'message',
                    'Berhasil Mengubah Profil'
                );
            }
            return redirect()->back()->with("status", "danger")->with('message', 'Gagal Mengubah Profil');
        }
        $user = User::find($id)->update($request->all());
        // $user2 = User::find($id)->update([
        // "password" => Hash::make($request->password)
        // ]);

        if ($user) {
            return redirect()->back()->with("status", "success")->with(
                'message',
                'Berhasil Mengubah Profil'
            );
        }
        return redirect()->back()->with("status", "danger")->with('message', 'Gagal Mengubah Profil');
    }

    // Delete Data
    public function hapus_anggota($id)
    {
        $anggota = User::findOrFail($id);
        $anggota->delete();

        if ($anggota) {
            return redirect()->back()->with('status', 'success')->with('message', 'Anggota berhasil dihapus');
        }
        return redirect()->back()->with('status', 'danger')->with('message', 'Anggota gagal dihapus');
    }
    public function hapus_admin($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        if ($admin) {
            return redirect()->back()->with('status', 'success')->with('message', 'Admin berhasil dihapus');
        }
        return redirect()->back()->with('status', 'danger')->with('message', 'Admin gagal dihapus');
    }
}
