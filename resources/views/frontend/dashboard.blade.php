@extends('layouts.portal.master')

@section('content')

    <div class="row">
        <div class="col-lg-3">
            <div class="card text-center">
                @if (!empty($alumni->banner_img))
                    <img src="{{ url('/user/banner/' . $alumni->banner_img) }}" class="card-img-top" alt="..." style="max-width: 100%; height: 80px; object-fit: cover;">
                @else
                    <img src="{{ url('/media/scotland.jpg') }}" class="card-img-top" alt="..." style="max-width: 100%; height: 80px;">
                @endif
                
                <div class="card-body body-profile">
                    @if(!empty($dataUser->foto))
                        <img src="{{ asset('/user/foto/' . $dataUser->foto ?? '') }}" class="rounded-circle" alt="">
                    @else
                        <img class="rounded-circle" src="{{ asset('user/foto/user.png') }}" alt="">
                    @endif
                    <h5 class="card-title">{{ $dataUser->nama }}</h5>
                    <p class="card-text" style="color: grey; font-size: 14px; font-weight: 300;">{{ $alumni->pekerjaan_sekarang }} di {{ $alumni->perusahaan_sekarang }}</p>
                    <hr>
                    @foreach ($dataAlumni as $da)
                        <h6 class="card-title text-start">{{ $da['program_studi'] }}</h6>
                        <p class="card-text text-start mt-3" style="color: grey; font-size: 14px; font-weight: 300;">{{ $da['angkatan'] }}</p>
                    @endforeach
                    
                    
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body body-activity">
                    <ul class="list-group">
                        <li class="list-group-item borderless"><i class="bi bi-newspaper" style="color: #3a9e66;"></i>&nbsp;&nbsp;Feed</li>
                        <li class="list-group-item borderless"><i class="bi bi-people-fill" style="color: #1a75d6;"></i>&nbsp;&nbsp;Koneksi</li>
                        <li class="list-group-item borderless"><i class="bi bi-file-earmark-arrow-up-fill" style="color: #e61049;"></i>&nbsp;&nbsp;Masukan</li>
                        <li class="list-group-item borderless"><i class="bi bi-image-fill" style="color: #87036f;"></i>&nbsp;&nbsp;Media</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row g-0 post-area">
                <div class="col-lg-12">
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            <button onclick="createPost('{{ route('frontend.create-post') }}')" type="button" class="btn btn-lg btn-outline-secondary rounded-pill">Klik disini untuk posting</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            @foreach ($postingan as $p)
                <div class="card feeds-card">
                    <div class="card-header feed-header">
                        <img src="{{ url('/user/foto', $p['users']['foto']) }}" class="float-start" alt="">
                        <p>{{ $p['users']['nama'] }}</p>
                        <p><small class="text-body-secondary">{{ tanggal_indonesia($p['created_at'], false) }}</small></p>
                    </div>
                    <div class="card-body feed-body">
                        <?php $paragraphs = explode(PHP_EOL, $p['deskripsi']); ?>

                        @foreach ($paragraphs as $paragraph)
                            <p>{{{ $paragraph }}}</p>
                        @endforeach
                        
                    </div>
                    @if (!is_null($p['media']))
                        <img src="{{ url('/alumni/postingan', $p['media']) }}" class="card-img-bottom img-card" alt="...">
                    @endif
                    
                </div>
            @endforeach
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    Para alumni FT
                </div>
                <div class="card-body">
                    @foreach ($listAlumni as $la)
                        <div class="row member-card">
                            @if(!empty($la->foto))
                                <img src="{{ asset('/user/foto/' . $la->foto ?? '') }}" class="rounded-circle" alt="">
                            @else
                                <img class="rounded-circle" src="{{ asset('user/foto/user.png') }}" alt="">
                            @endif
                            <div class="member-caption">
                                <h6>{{ $la->nama }}</h6>
                                <p><small class="text-body-secondary">Ikuti</small></p>
                            </div>
                        </div>
                    @endforeach
                    
                    
                </div>
            </div>
        </div>
    </div>

    @includeIf('frontend.modal-form.post')

@endsection

@push('bottom_scripts')
    <script>

        $('#post-form').validator().on('submit', function(d){
            if (!d.preventDefault()) {
                $.post($('#post-form form').attr('action'), $('#post-form form').serialize())
                    .done((response) => {
                        $('#post-form').modal('hide');
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            }
        });

        function createPost(url) {
            $('#post-form').modal('show');
            $('#post-form .post-profile-title').text('Posting Informasi Terbaru');

            $('#post-form form')[0].reset();
            $('#post-form form').attr('action', url);
            $('#post-form [name=_method]').val('post');
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imageResult').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush