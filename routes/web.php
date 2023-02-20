<?php

use App\Http\Controllers\View\Dashboard;
use App\Http\Controllers\View\Peminjaman;
use App\Http\Controllers\View\Profile;
use App\Http\Controllers\View\DataAnggota;
use App\Http\Controllers\View\DataBuku;
use App\Http\Controllers\View\Laporan;
use App\Http\Controllers\View\Pemberitahuan;
use App\Http\Controllers\View\Pengembalian;
use App\Http\Controllers\View\Pesan;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(
    ['middleware' => 'auth'],
    function () {
        // Admin Route
        Route::prefix('/admin')->group(
            function () {
                Route::group(
                    ['middleware' => 'role:admin'],
                    function () {
                        Route::controller(Dashboard::class)->group(
                            function () {
                                Route::get(
                                    '/dashboard',
                                    'admin'
                                )->name('admin.dashboard');
                                Route::post('/nonactive-notif', 'nonactive_notif')->name('admin.nonactive_notif');
                            }
                        );

                        // Pemberitahuan
                        Route::controller(Pemberitahuan::class)->group(
                            function () {
                                Route::get('pemberitahuan', 'pemberitahuan_admin')->name('admin.pemberitahuan_admin');
                                Route::delete('/delete-notif', 'delete_notif')->name('admin.delete_notif');
                                Route::post('/nonactive-notif', 'nonactive_notif')->name('admin.nonactive_notif');
                                Route::post('/submit_pemberitahuan', 'submit_pemberitahuan')->name('admin.submit_pemberitahuan');
                                Route::put('/activate-notif/{id}', 'activate_notif')->name('admin.activate_notif');
                            }
                        );

                        // Data Anggota
                        Route::controller(DataAnggota::class)->group(
                            function () {
                                // Admin
                                Route::get(
                                    '/data-admin',
                                    'data_admin'
                                )->name('admin.data-admin');
                                Route::post(
                                    'submit_admin',
                                    'submit_admin'
                                )->name('admin.submit_admin');
                                Route::put('/update-admin/{id}', 'update_profil')->name('admin.update_admin');
                                Route::delete('/hapus-admin/{id}', 'hapus_admin')->name('admin.hapus_admin');

                                // Anggota
                                Route::get(
                                    '/data-anggota',
                                    'data_anggota'
                                )->name('admin.data-anggota');
                                Route::post(
                                    'submit_anggota',
                                    'submit_anggota'
                                )->name('admin.submit_anggota');
                                Route::post('/verif-user', 'verif_user')->name('admin.verif_user');
                                Route::put('/update-anggota/{id}', 'update_profil')->name('admin.update_anggota');
                                Route::delete('/hapus-anggota/{id}', 'hapus_anggota')->name('admin.hapus_anggota');
                            }
                        );

                        // Data Buku
                        Route::controller(DataBuku::class)->group(
                            function () {
                                // Penerbit
                                Route::get(
                                    '/penerbit',
                                    'penerbit'
                                )->name('admin.penerbit');
                                Route::post(
                                    'submit_penerbit',
                                    'submit_penerbit'
                                )->name('admin.submit_penerbit');
                                Route::put('/update-penerbit/{id}', 'update_penerbit')->name('admin.update_penerbit');
                                Route::delete('/hapus-penerbit/{id}', 'hapus_penerbit')->name('admin.hapus_penerbit');

                                // Kategori
                                Route::get(
                                    '/kategori',
                                    'kategori'
                                )->name('admin.kategori');
                                Route::post(
                                    'submit_kategori',
                                    'submit_kategori'
                                )->name('admin.submit_kategori');
                                Route::put('/update-kategori/{id}', 'update_kategori')->name('admin.update_kategori');
                                Route::delete('/hapus-kategori/{id}', 'hapus_kategori')->name('admin.hapus_kategori');

                                // Buku
                                Route::get(
                                    '/buku',
                                    'buku'
                                )->name('admin.buku');
                                Route::post(
                                    'submit_buku',
                                    'submit_buku'
                                )->name('admin.submit_buku');
                                Route::put('/update-buku/{id}', 'update_buku')->name('admin.update_buku');
                                Route::delete('/hapus-buku/{id}', 'hapus_buku')->name('admin.hapus_buku');
                            }
                        );

                        // Pesan
                        Route::controller(Pesan::class)->group(
                            function () {
                                Route::get(
                                    '/pesan-masuk',
                                    'admin_pesan_masuk'
                                )->name('admin.pesan-masuk');
                                Route::get(
                                    '/pesan-terkirim',
                                    'admin_pesan_terkirim'
                                )->name('admin.pesan-terkirim');

                                Route::post('/ubah-status', 'ubah_status')->name('admin.ubah_status');
                                Route::post('/kirim-pesan', 'kirim_pesan')->name('admin.kirim_pesan');
                                Route::delete('/hapus-pesan/{id}', 'hapus_pesan')->name('admin.hapus_pesan');
                            }
                        );

                        // Laporan
                        Route::prefix('/laporan')->controller(Laporan::class)->group(
                            function () {
                                // Peminjaman
                                Route::get(
                                    '/peminjaman',
                                    'laporan_peminjaman'
                                )->name('admin.laporan_peminjaman');
                                Route::post('/peminjaman/cetak_pdf', 'peminjaman_pdf')->name('admin.peminjaman_pdf');
                                Route::post('/peminjaman/cetak_excel', 'peminjaman_excel')->name('admin.peminjaman_excel');

                                // Pengembalian
                                Route::get(
                                    '/pengembalian',
                                    'laporan_pengembalian'
                                )->name('admin.laporan_pengembalian');
                                Route::post('/pengembalian/cetak_pdf', 'pengembalian_pdf')->name('admin.pengembalian_pdf');
                                Route::post('/pengembalian/cetak_excel', 'pengembalian_excel')->name('admin.pengembalian_excel');

                                // Anggota
                                Route::get(
                                    '/anggota',
                                    'laporan_anggota'
                                )->name('admin.laporan_anggota');
                                Route::post('/anggota/cetak_pdf', 'anggota_pdf')->name('admin.anggota_pdf');
                                Route::post('/anggota/cetak_excel', 'anggota_excel')->name('admin.anggota_excel');
                            }
                        );

                        Route::controller(Profile::class)->group(
                            function () {
                                Route::get(
                                    '/profil',
                                    'admin_profil'
                                )->name('admin.profil');
                                Route::put(
                                    'profile',
                                    'update_profil'
                                )->name('admin.profil.update');

                                Route::get(
                                    '/identitas-aplikasi',
                                    'identitas_aplikasi'
                                )->name('admin.identitas_aplikasi');
                                Route::put(
                                    'update-identitas/{id}',
                                    'update_identitas'
                                )->name('admin.update_identitas');
                            }
                        );
                    }
                );
            }
        );

        // User Route
        Route::prefix('/user')->group(
            function () {
                Route::group(
                    ['middleware' => 'role:user'],
                    function () {
                        Route::get(
                            'dashboard',
                            [Dashboard::class, 'user']
                        )->name('user.dashboard');

                        Route::get(
                            'pemberitahuan',
                            [Pemberitahuan::class, 'pemberitahuan_user']
                        )->name('user.pemberitahuan_user');

                        Route::controller(Peminjaman::class)->group(
                            function () {
                                Route::get(
                                    'peminjaman',
                                    'show_peminjaman'
                                )->name('user.peminjaman');
                                Route::get(
                                    'peminjaman/form',
                                    'peminjaman_form'
                                )->name('user.form_peminjaman');
                                Route::post(
                                    'form_peminjaman',
                                    'peminjaman_dashboard'
                                )->name('user.form_peminjaman_dashboard');
                                Route::post(
                                    'submit_peminjaman',
                                    'submit_peminjaman'
                                )->name('user.submit_peminjaman');
                            }
                        );

                        Route::controller(Pengembalian::class)->group(
                            function () {
                                Route::get(
                                    'pengembalian',
                                    'show_pengembalian'
                                )->name('user.pengembalian');
                                Route::get('pengembalian/form', 'pengembalian_form')->name('user.form_pengembalian');
                                Route::post(
                                    'submit_pengembalian',
                                    'submit_pengembalian'
                                )->name('user.submit_pengembalian');
                            }
                        );

                        Route::controller(Pesan::class)->group(
                            function () {
                                Route::get('/pesan-masuk', 'pesan_masuk')->name('user.pesan_masuk');
                                Route::get('/pesan-terkirim', 'pesan_terkirim')->name('user.pesan_terkirim');
                                Route::post('/ubah-status', 'ubah_status')->name('user.ubah_status');
                                Route::post('/kirim-pesan', 'kirim_pesan')->name('user.kirim_pesan');
                                Route::delete('/hapus-pesan/{id}', 'hapus_pesan')->name('user.hapus_pesan');
                            }
                        );

                        Route::controller(Profile::class)->group(
                            function () {
                                Route::get(
                                    'profil',
                                    'user_profil'
                                )->name('user.profil');
                                Route::put(
                                    'profile',
                                    'update_profil'
                                )->name('user.profil.update');
                            }
                        );
                    }
                );
            }
        );
    }
);
