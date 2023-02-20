@extends('layouts.user-layout')

@section('content-user')
    <div>
        <div class="row">
            <div class="col-10">
                <h1>Pemberitahuan</h1>
            </div>
        </div>
        <div>
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Isi</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemberitahuans as $key => $pemberitahuan)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td style="max-width: 38rem">{{ $pemberitahuan->isi }}</td>
                            <td class="text-center">
                                @if ($pemberitahuan->status == 'aktif')
                                    <span class="badge bg-primary">General</span>
                                @else
                                    <span class="badge bg-info">Only User</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
