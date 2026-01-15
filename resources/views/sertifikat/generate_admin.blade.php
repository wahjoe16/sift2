<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=SUSE:wght@100..800&display=swap" rel="stylesheet">
    <title>Sertifikat SKKFT</title>
    <style>

        body {
            font-family: "SUSE", sans-serif;
            line-height: 1.2rem;
        }

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
        <div style="margin-top:0px;">
            <div style="margin-left: 70px; margin-top: 23px;">
                <div style="margin-bottom: 10px">
                    <table>
                        <tr>
                            <td><img src="{{ public_path('skkft-template/logo-fakultas.png') }}" width="80px"></td>
                            <td style="padding-top: 15px;">
                                <span style="font-size:28pt; font-weight: 600;">FAKULTAS TEKNIK</span><br>
                                <span style="font-size:16pt; font-weight: 600;">UNIVERSITAS ISLAM BANDUNG</span>
                            </td>
                        </tr>
                    </table>

                </div>
                <div style="margin-top: 35px; margin-left: 30px;">
                    <span style="font-size: 25pt; font-weight: 600;">SERTIFIKAT</span><br>
                    <span style="font-size: 18pt;">
                        SATUAN KEGIATAN KEMAHASISWAAN <br>
                        FAKULTAS TEKNIK
                    </span>
                    <p style="font-size: 14pt;">
                        DIBERIKAN KEPADA :
                    </p>

                    <span style="font-size: 25pt; font-weight: 600;">{{ $nama }}</span><br>

                    <span>NPM : {{ $npm }}</span><br>
                    <p>
                        Telah memenuhi skor kegiatan kemahasiswaan sebagaimana <br>
                        ditetapkan dalam panduan SKKFT
                    </p>
                </div>
            </div>
            <br>
            <table border="0" width="120%">
                <tr>
                    <td width="20%"></td>
                    <td width="15%">
                        <img src="{{ $foto }}" width="170px">
                    </td>
                    <td width="5%"></td>
                    <td>
                        Bandung, {{ $tanggal }}
                        <br>
                        <img src="{{ public_path('skkft-template/ttd rahman.jpg') }}" width="240px">
                        <br>
                        <b>{{ $wadek }}</b><br>
                        Wakil Dekan III Fakultas Teknik
                    </td>
                </tr>
            </table>
        </div>
    </div>
    {{-- <div class="page-break"></div> --}}
    {{-- <div class="page2">
        <div style="margin-top:0px;">
            <table width="70%" border="1" cellpading="0" cellspacing="0" style="margin-top:150px;"  align="center">
                <tr bgcolor="#000" style="color:#fff">
                    <th width="10%">NO</th>
                    <th>KATEGORI</th>
                    <th width="20%">POIN</th>
                </tr>
                @php
                    $total = 0;
                @endphp
                
                @foreach($poin as $i => $p)
                <tr>
                    
                    @php
                        $total += $p->poin;
                    @endphp

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
    </div> --}}
</body>
</html>