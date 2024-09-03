@extends('layouts.master')

@section('content')

<section class="content">
    @includeIf('layouts.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3>Pengajuan SKPI</h3>
                </div>
                <div class="box-body table-responsive">
                        <table class="table table-striped table-bordered table-sertifikat_skkft">
                            <thead>
                                <th width="5%">No</th>
                                <th>Nama Mahasiswa</th>
                                <th>NPM</th>
                                <th>Program Studi</th>
                                <th>Tanggal Pengajuan</th>
                                <th width="12%"><i class="fa fa-cogs"></i> Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($data as $d)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $d->user_skkft->nama }}</td>
                                    <td>{{ $d->user_skkft->nik }}</td>
                                    <td>{{ $d->user_skkft->program_studi }}</td>
                                    <td>{{ tanggal_indonesia($d->tanggal) }}</td>
                                    <td>
                                        <a href="{{ route('skpi.show', $d->id) }}" class="btn btn-info btn-flat btn-sm"><i class="fa fa-search"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts_page')
<script>
    
</script>
@endpush