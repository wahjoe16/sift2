@extends('layouts.dashboard')

@section('content')


<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <h6 class="op-7 mb-2">Selamat Datang di Sistem Informasi Fakultas Teknik (SIFT) <strong>{{ auth()->user()->nama }}</strong></h6>
    </div>
</div>
<div class="row">
    {{-- Menu untuk semua user yang aktif --}}
    @if (auth()->user()->status_aktif == 1)
        @include('home_menu.user_aktif')
    @endif

    {{-- Menu untuk Dosen yang aktif  --}}
    @if (auth()->user()->level == 2 && auth()->user()->status_aktif == 1)
        @include('home_menu.dosen')
    @endif

    {{-- Menu untuk admin yang aktif --}}
    @if (auth()->user()->level == 1 && auth()->user()->status_aktif == 1)
        @include('home_menu.admin')
    @endif

    {{-- Menu untuk mahasiswa yang aktif --}}
    @if (auth()->user()->level == 3 && auth()->user()->status_aktif == 1)
        @include('home_menu.mahasiswa')
    @endif
    
    {{-- Menu untuk dosen dekanat --}}
    @if (auth()->user()->level == 2 && auth()->user()->status_aktif == 1 && auth()->user()->status_dekanat == 1)
        @include('home_menu.dekanat')
    @endif
    
    {{-- Menu untuk alumni --}}
    @if (auth()->user()->status_aktif == 0)
        @include('home_menu.alumni')
    @endif
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sertifikat SKKFT</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover table-sertifikat">
                        <thead>
                            <tr>
                                <th>Foto Profil</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th width="5%"><i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Foto Profil</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th width="5%"><i class="fas fa-cogs"></i></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts_page')
    <script>
        let table;

        $(function() {
            table = $('.table-sertifikat').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route("sertifikat-skkft.data") }}',
                },
                columns: [
                    {
                        data: 'foto'
                    },
                    {
                        data: 'nik'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'program_studi'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            })
        })
    </script>
@endpush