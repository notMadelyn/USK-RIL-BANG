@extends('layouts.admin-layout')

@section('content-admin')
    <div class="col-8">
        @if (session('status'))
            <div class="alert alert-{{ session('status') }}" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <form action="{{ route('admin.update_identitas', $identitas->id) }}" enctype="multipart/form-data" method="post">
            @method('put')
            @csrf
            <div class="card">
                <div class="card-header">
                    <h4>Update Identitas Aplikasi</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped table bordered">
                        <tr>
                            <th>Foto</th>
                            <td>
                                @if ($identitas->photo)
                                    <img width="150px" height="150px" src="{{ asset($identitas->photo) }}"
                                        alt="{{ asset($identitas->photo) }}">
                                @endif
                                <input type="file" class="form-control mt-3" name="photo">
                            </td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>
                                <input class="form-control" type="text" name="nama_app"
                                    value="{{ $identitas->nama_app }}">
                            </td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>
                                <input class="form-control" type="email" name="email_app"
                                    value="{{ $identitas->email_app }}">
                            </td>
                        </tr>

                        <tr>
                            <th>Alamat</th>
                            <td>
                                <textarea name="alamat_app" class="form-control">{{ $identitas->alamat_app }}</textarea>
                            </td>
                        </tr>

                        <tr>
                            <th>Nomor Telpon</th>
                            <td>
                                <input class="form-control" type="text" name="nomor_hp"
                                    value="{{ $identitas->nomor_hp }}">
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="card-footer">
                    <button class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Update</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
