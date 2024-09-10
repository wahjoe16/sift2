@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                @if (is_null($sertifikat))
                    <div class="box-header with-border">
                        <div class="btn-group">
                            <a href="{{ route('kegiatan.create') }}" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus-circle"></i> Tambah</a>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-striped table-bordered table-kegiatan_skkft">
                            <thead>
                                <th width="5%">No</th>
                                <th>Nama Kegiatan</th>
                                <th>Kategori</th>
                                <th>Subkategori</th>
                                <th>Tingkat</th>
                                <th>Prestasi</th>
                                <th>Jabatan</th>
                                <th>Poin</th>
                                <th>Status SKKFT</th>
                                <th width="12%"><i class="fa fa-cogs"></i> Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($kegiatan as $k)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{ $k->nama_kegiatan }}</td>
                                    <td>{{$k->categories_skkft->category_name}}</td>
                                    <td>{{$k->subcategories_skkft->subcategory_name}}</td>
                                    @if ($k->tingkat_id != '')
                                        <td>{{$k->tingkat_skkft->tingkat}}</td>
                                        @else
                                        <td>-</td>
                                    @endif
                                    @if ($k->prestasi_id != '')
                                        <td>{{$k->prestasi_skkft->prestasi}}</td>
                                        @else
                                        <td>-</td>
                                    @endif
                                    @if ($k->jabatan_id != '')
                                        <td>{{$k->jabatan_skkft->jabatan}}</td>
                                        @else
                                        <td>-</td>
                                    @endif
                                    @if ($k->point != '')
                                        <td>{{ $k->point }}</td>
                                        @else
                                        <td>-</td>
                                    @endif
                                    @if ($k->status_skkft == 0)
                                        <td><span class="label bg-yellow text-black">Menunggu</span></td>
                                        @elseif ($k->status_skkft == 1)
                                        <td><span class="label bg-green">Diterima</span></td>
                                        @elseif ($k->status_skkft == 2)
                                        <td><span class="label bg-red">Ditolak</span></td>
                                    @endif
                                    <td>
                                        <a href="{{ route('kegiatan.show', $k->id) }}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-search"></i></a>
                                        <a href="{{ route('kegiatan.edit', $k->id) }}" class="btn btn-warning btn-sm btn-flat"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('kegiatan.destroy', $k->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                @else
                    <!-- Main content -->
                    <section class="content">

                        <div class="error-page">
                            <h2 class="headline text-red">500</h2>

                            <div class="error-content">
                                <h3><i class="fa fa-warning text-red"></i> Halaman di Block.</h3>

                                <p>
                                    Anda sudah mengajukan sertifikat.
                                    Tunggu informasi selanjutnya!</a>.
                                </p>

                            </div>
                        </div>
                        <!-- /.error-page -->

                    </section>
                    <!-- /.content -->
                @endif
                
            </div>
        </div>
    </div> 
</section>

@endsection

@push('scripts_page')
<script>
    
</script>
@endpush