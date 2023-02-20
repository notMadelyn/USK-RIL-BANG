<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Anggota</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

@php
    use App\Models\Identitas;
    $identitas = Identitas::first();
@endphp

<body>
    <div class="main mb-5">
        <div class="heading text-center">
            <img src="{{ public_path('img/perpus.png') }}" alt="image" width="150px" height="150px">
            <h3>Laporan Anggota {{ $identitas->nama_app }}</h3>
            <h5>Email: {{ $identitas->email_app }} | Nomor Telepon: {{ $identitas->nomor_hp }}</h6>
        </div>
    </div>
    <div class="content">
        <div class="row justify-content-center" id="table-borderless">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $anggota->fullname }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Judul Buku</th>
                                        <th class="text-center">Tanggal Peminjaman</th>
                                        <th class="text-center">Tanggal Pengembalian</th>
                                        <th class="text-center">Kondisi Buku Saat Dipinjam</th>
                                        <th class="text-center">Kondisi Buku Saat Dikembalikan</th>
                                        <th class="text-center">Denda</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($datas) < 1)
                                        <tr>
                                            <td colspan="8" class="text-center text-bold-500 fs-2">Data
                                                Undefined
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($datas as $data)
                                            <tr>
                                                <td class="text-center">{{ $data->buku->judul }}</td>
                                                <td class="text-center">{{ $data->tanggal_peminjaman }}</td>

                                                @if ($data->tanggal_pengembalian)
                                                    <td class="text-center">{{ $data->tanggal_pengembalian }}</td>
                                                @else
                                                    <td class="text-center">-</td>
                                                @endif

                                                <td class="text-center text-capitalize">
                                                    {{ $data->kondisi_buku_saat_dipinjam }}</td>
                                                @if ($data->kondisi_buku_saat_dikembalikan)
                                                    <td class="text-center text-capitalize">
                                                        @if ($data->kondisi_buku_saat_dikembalikan == 'buruk')
                                                            rusak
                                                        @else
                                                            {{ $data->kondisi_buku_saat_dikembalikan }}
                                                        @endif
                                                    </td>
                                                @else
                                                    <td class="text-center">-</td>
                                                @endif
                                                @if ($data->denda)
                                                    <td class="text-center">{{ $data->denda }}</td>
                                                @else
                                                    <td class="text-center">-</td>
                                                @endif
                                                <td class="text-center">
                                                    @if ($data->done === 1)
                                                        <span class="badge bg-success">Sudah Dikembalikan</span>
                                                    @else
                                                        <span class="badge bg-warning text-black">Belum
                                                            Dikembalikan</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
