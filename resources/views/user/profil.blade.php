@extends('layouts.user-layout')

@section('content-user')
    <div class="col-8">
        @if (session('status'))
            <div class="alert alert-{{ session('status') }}" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <form action="{{ route('user.profil.update') }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h4>Update Profile</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped table bordered">
                        <tr>
                            <th>Foto</th>
                            <td>
                                @if (Auth::user()->photo)
                                    <img width="150px" height="150px" src="{{ asset(Auth::user()->photo) }}"
                                        alt="{{ asset(Auth::user()->photo) }}">
                                @endif
                                <input type="file" class="form-control mt-3" name="photo">
                            </td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>
                                <input class="form-control" type="text" name="fullname"
                                    value="{{ Auth::user()->fullname }}">
                            </td>
                        </tr>

                        <tr>
                            <th>Username</th>
                            <td>
                                <input class="form-control" type="text" name="username"
                                    value="{{ Auth::user()->username }}">
                            </td>
                        </tr>

                        <tr>
                            <th>NIS</th>
                            <td>
                                <input class="form-control" type="text" name="nis" value="{{ Auth::user()->nis }}">
                            </td>
                        </tr>

                        <tr>
                            <th>Alamat</th>
                            <td>
                                <textarea name="alamat" class="form-control">{{ Auth::user()->alamat }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>
                                <input class="form-control" type="password" name="password"
                                    placeholder="Sandi belum dirubah" required autocomplete="">
                            </td>
                        </tr>

                        <tr>
                            <th>Kelas</th>
                            <td>
                                <input class="form-control" type="text" name="kelas" value="{{ Auth::user()->kelas }}">
                            </td>
                        </tr>

                    </table>

                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
