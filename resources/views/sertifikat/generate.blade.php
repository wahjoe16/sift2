<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <title>Sertifikat SKKFT</title>
    <style>

        .page-break {
            page-break-after: always;
        }

        .page1 {
            background-image: url("{{ public_path('skkft-template/depan.png') }}");
            background-repeat: no-repeat;
            width: 100%;
            height: 100vh;
            background-size: cover;
        }

        .page2 {
            background-image: url("{{ public_path('skkft-template/belakang.png') }}");
            background-repeat: no-repeat;
            width: 100%;
            height: 100vh;
            background-size: cover;
        }

    </style>
</head>
<body>
    <div class="page1">
        <div style="position: fixed; top:10px; left:80px">
            <div style="margin-bottom: 10px">
                <table>
                    <tr>
                        <td><img src="{{ public_path('skkft-template/logo-fakultas.png') }}" width="80px"></td>
                        <td>
                            <span style="font-size:28pt;">FAKULTAS TEKNIK</span><br>
                            <span style="font-size:16pt;">UNIVERSITAS ISLAM BANDUNG</span>
                        </td>
                    </tr>
                </table>

            </div>
            <span style="font-size: 30pt;">SERTIFIKAT</span><br>
            <p style="font-size: 18pt;">
                SATUAN KEGIATAN KEMAHASISWAAN <br>
                FAKULTAS TEKNIK
            </p>
            <p style="font-size: 14pt;">
                DIBERIKAN KEPADA :
            </p>

            <div style="font-size: 32pt; width:650px; margin-top:10px; margin-bottom:20px;">
                {{ $nama }}
            </div>

            <p>NPM : {{ $npm }}</p>
            <p>
                Telah memenuhi scrore kegiatan kemahasiswaan sebagaimana <br>
                ditetapkan dalam panduan SKKFT
            </p>
            <br><br>
            <table border="0" width="120%">
                <tr>
                    <td width="30%"></td>
                    <td width="15%"><img src="{{ asset('/user/foto/' . auth()->user()->foto ?? '') }}" width="170px"></td>
                    <td align="right">
                        Bandung, {{ $tanggal }}
                        <br><br>
                        <img src="{{ public_path('skkft-template/ttd.png') }}" width="170px">
                        <br>
                        <b>{{ $wadek }}</b><br>
                        Wakil Dekan III Fakultas Teknik
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="page2">
        <div style="margin-top:0px;">
            <table width="70%" border="1" cellpading="0" cellspacing="0" style="margin-top:150px;"  align="center">
                <tr bgcolor="#000" style="color:#fff">
                    <th width="10%">NO</th>
                    <th>KATEGORI</th>
                    <th width="20%">POIN</th>
                </tr>
                <?php $total = 0; ?>
                @foreach($poin as $i=>$p)
                <tr>
                    <?php $total += $p->poin; ?>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $p->nama_kategori }}</td>
                    <td>{{ $p->poin }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2">Total</td>
                    <td>{{ $total }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>