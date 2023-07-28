<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Kolokium Skripsi</title>

    <link rel="stylesheet" href="{{ asset('/AdminLTE-2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
</head>

<body>
    <h3 class="text-center">Rekap Kolokium Skripsi</h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>NPM</th>
                <th>Tahun Akademik</th>
                <th>Semester</th>
                <th>Pembimbing</th>
                <th>Co. Pembimbing</th>
                <th>Judul Skripsi</th>
                <th>Tanggal Pengajuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
            <tr>
                <td>$row->mahasiswa->nama</td>
                <td>$row->mahasiswa->nik</td>
                <td>$row->tahun_ajaran->tahun_ajaran</td>
                <td>$row->semester->semester</td>
                <td>$row->dosen_1->nama</td>
                <td>$row->dosen_2->nama</td>
                <td>$row->judul_skripsi</td>
                <td>tanggal_indonesia($row->created_at)</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>