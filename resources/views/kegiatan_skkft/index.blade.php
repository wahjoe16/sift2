@extends('layouts.dashboard')

@section('content')

@include('layouts.alert')

<div class="row">
    <div class="col-md-12">
        <div class="card card-stats card-warning">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <div class="icon-big text-center">
                            <i class="fas fa-bell"></i>
                            <h4>Informasi Penting!</h4>
                        </div>
                    </div>
                    <div class="col-10 col-stats">
                        <div class="numbers">
                            <strong>Sebelum menggunakan Sistem Informasi ini, pengguna diharuskan memperhatikan informasi berikut.</strong>
                            <hr>
                            <ol>
                                <li>Untuk kepentingan keamanan data, bagi mahasiswa yang sudah bisa Login di Sistem Informasi ini diwajibkan untuk segera mengganti Password.</li>
                                <li>Bagi mahasiswa, lengkapi profil anda agar menu di sidebar ditampilkan seluruhnya.</li>
                                <li>Bagi mahasiswa pria, unggah foto menggunakan latar belakang biru, dan memakai pakaian resmi.</li>
                                <li>Bagi mahasiswa wanita, unggah foto menggunakan latar belakang biru, dan memakai pakaian resmi serta memakai hijab.</li>
                                <li>Silahkan download panduan SKKFT <a href="{{ url('/skkft-template/Panduan SKKFT 2020 A5 fix.pdf') }}" target="_blank">di sini.</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-stats card-danger">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <div class="icon-big text-center">
                            <i class="fas fa-bell"></i>
                            <h4 style="text-transform: uppercase;">Peringatan Keras!</h4>
                        </div>
                    </div>
                    <div class="col-10 col-stats">
                        <div class="numbers">
                            <strong style="text-transform: uppercase;">Dilarang keras memalsukan bukti Fisik. Jika terdeteksi memakai bukti fisik palsu akan ditindak tegas dan akan merugikan Anda!</strong>
                            <hr>
                            <p>"Dan sesungguhnya Kami telah menguji orang-orang yang sebelum mereka, maka sesungguhnya Allah mengetahui orang-orang yang benar dan sesungguhnya Dia mengetahui orang-orang yang dusta."<br> QS. Al-Ankabut ayat 3</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            @if (is_null($sertifikat))
                <div class="card-header">
                    <div class="btn-group">
                        <a href="{{ route('kegiatan.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-kegiatan_skkft">
                        <thead>
                            <th width="5%">No</th>
                            <th>Nama Kegiatan</th>
                            <th>Kategori</th>
                            <th>Subkategori</th>
                            <th>Poin</th>
                            <th>Status SKKFT</th>
                            <th><i class="fas fa-cogs"></i> Aksi</th>
                        </thead>
                        <tbody>
                            @foreach($kegiatan as $k)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{ $k->nama_kegiatan }}</td>
                                <td>{{$k->categories_skkft->category_name}}</td>
                                <td>{{$k->subcategories_skkft->subcategory_name}}</td>
                                @if ($k->point != '')
                                    <td>{{ $k->point }}</td>
                                    @else
                                    <td>-</td>
                                @endif
                                @if ($k->status_skkft == 0)
                                    <td><span class="badge badge-warning text-black">Menunggu</span></td>
                                    @elseif ($k->status_skkft == 1)
                                    <td><span class="badge badge-success">Diterima</span></td>
                                    @elseif ($k->status_skkft == 2)
                                    <td><span class="badge badge-danger">Ditolak</span></td>
                                @endif
                                <td>
                                    <a href="{{ route('kegiatan.show', $k->id) }}" class="btn btn-info btn-xs"><i class="fas fa-search"></i></a>
                                    <a href="{{ route('kegiatan.edit', $k->id) }}" class="btn btn-warning btn-xs"><i class="fas fa-pen"></i></a>
                                    <a href="{{ route('kegiatan-bukfis.edit', $k->id) }}" class="btn btn-secondary btn-xs"><i class="fas fa-file-pdf"></i></a>
                                    <form action="{{ route('kegiatan.destroy', $k->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="alert alert-warning alert-dismissible">
                        <h4><i class="icon fa fa-warning"></i> Perhatian!</h4>
                        Jika anda sebelumnya sudah mempunyai riwayat poin SKKFT silahkan isi form <a href="https://forms.gle/eYGd1edms3i7ixeD9" target="_blank">ini</a> untuk memulihkan data riwayat poin anda, selanjutnya anda diwajibkan untuk upload ulang bukti fisiknya.
                    </div>
                </div>
            @else
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="icon-close text-danger"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Errors 500! Halaman diblok!</p>
                                <h4 class="card-title">Anda sudah mengajukan sertifikat. Tunggu informasi selanjutnya!</h4>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
        </div>
    </div>
</div>


@endsection

@push('scripts_page')
<script>
    
</script>
@endpush