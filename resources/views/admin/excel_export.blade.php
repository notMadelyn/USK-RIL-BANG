<!DOCTYPE html>
<html lang="en">

<body>
    <table class="table table-borderless align-middle mb-0">
        <thead>
            <tr></tr>
            <tr>
                <th></th>
                <th style="width: 300px; font-weight: 500; font-size: 16px">{{ $info }}</th>
            </tr>

            <tr></tr>
            <tr>
                <th></th>
                <th style="background-color: #42a6d4; width: 200px; text-align: center; border: 3px solid black">Nama
                </th>
                <th style="background-color: #42a6d4; width: 150px; text-align: center; border: 3px solid black">Judul
                    Buku</th>
                <th style="background-color: #42a6d4; width: 150px; text-align: center; border: 3px solid black">Tanggal
                    Peminjaman</th>
                <th style="background-color: #42a6d4; width: 150px; text-align: center; border: 3px solid black">Tanggal
                    Pengembalian</th>
                <th style="background-color: #42a6d4; width: 200px; text-align: center; border: 3px solid black">Kondisi
                    Buku Saat Dipinjam</th>
                <th style="background-color: #42a6d4; width: 200px; text-align: center; border: 3px solid black">Kondisi
                    Buku Saat Dikembalikan</th>
                <th style="background-color: #42a6d4; width: 100px; text-align: center; border: 3px solid black">Denda
                </th>
                <th style="background-color: #42a6d4; width: 150px; text-align: center; border: 3px solid black">Status
                </th>
            </tr>
        </thead>
        <tbody>
            @if (count($datas) < 1)
                <tr>
                    <td></td>
                    <td colspan="8" style="text-align: center; font-weight: 500; border: 3px solid black; font-size: 20px">Data
                        Undefined
                    </td>
                </tr>
            @else
                @foreach ($datas as $data)
                    <tr>
                        <td></td>
                        <td style="width: 200px; text-align: center; border: 3px solid black; font-weight: 500">
                            {{ $data->user->fullname }}
                        </td>
                        <td style="width: 150px; text-align: center; border: 3px solid black">{{ $data->buku->judul }}</td>
                        <td style="width: 150px; text-align: center; border: 3px solid black">
                            {{ $data->tanggal_peminjaman }}</td>

                        @if ($data->tanggal_pengembalian)
                            <td style="width: 150px; text-align: center; border: 3px solid black">
                                {{ $data->tanggal_pengembalian }}</td>
                        @else
                            <td style="width: 150px; text-align: center; border: 3px solid black">-</td>
                        @endif

                        <td style="width: 200px; text-align: center; border: 3px solid black;">
                            @if ($data->kondisi_buku_saat_dipinjam == 'buruk')
                                Rusak
                            @else
                                Baik
                            @endif
                        </td>
                        @if ($data->kondisi_buku_saat_dikembalikan)
                            <td style="width: 200px; text-align: center; border: 3px solid black;">
                                @if ($data->kondisi_buku_saat_dikembalikan == 'buruk')
                                    Rusak
                                @else
                                    Baik
                                @endif
                            </td>
                        @else
                            <td style="width: 200px; text-align: center; border: 3px solid black">-</td>
                        @endif
                        @if ($data->denda)
                            <td style="width: 100px; text-align: center; border: 3px solid black">{{ $data->denda }}</td>
                        @else
                            <td style="width: 100px; text-align: center; border: 3px solid black">-</td>
                        @endif
                        <td style="width: 150px; text-align: center; border: 3px solid black">
                            @if ($data->done === 1)
                                <span style="background-color: #3ad13a; color: black">Sudah Dikembalikan</span>
                            @else
                                <span style="background-color: #ebeb1b; color: black">Belum Dikembalikan</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>

</html>
