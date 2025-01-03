@extends('layouts.portal.master')

@section('content')

    <div class="row">

        @include('frontend.side-menu-dashboard')

        <div class="col-lg-6">
            @include('frontend.post')
            <br>
            @foreach ($postingan as $p)
                <div class="card feeds-card">
                    <div class="card-header feed-header">
                        <img src="{{ url('/user/foto', $p['users']['foto']) }}" class="float-start" alt="">
                        <p><a href="{{ route('frontend.view-friend-alumni', $p['user_id']) }}">{{ $p['users']['nama'] }}</a></p>
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
                <div class="card-header text-center">
                    Alumni FT
                </div>
                <div class="card-body">
                    @foreach ($listAlumni as $la)
                        <div class="row member-card">
                            @if(!empty($la->foto))
                                <img src="{{ asset('/user/foto/' . $la->foto ?? '') }}" class="rounded-circle" alt="">
                            @else
                                <img class="rounded-circle" src="{{ asset('user/foto/user.png') }}" alt="">
                            @endif
                            <div class="member-caption mb-5">
                                <h6><a href="{{ route('frontend.view-friend-alumni', $la['id']) }}">{{ $la->nama }}</a></h6>
                                @if ($la->pekerjaan_sekarang != '')
                                    <p><small class="text-body-secondary">{{ $la->pekerjaan_sekarang }} di {{ $la->perusahaan_sekarang }}</small></p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    
                    <p class="text-center mt-3"><a class="link-offset-2 link-underline link-underline-opacity-0" href="{{ route('frontend.list-friend-alumni') }}">Lihat Semua</a></p>
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