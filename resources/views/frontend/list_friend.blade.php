@extends('layouts.portal.master')

@section('content')

<div class="row">

    @include('frontend.side-menu-dashboard')

    <div class="col-lg-9">
        @include('frontend.post')
        <br>

        <div class="row mt-2 mb-3">
            @foreach ($alumniFriends as $f)
                <div class="col-lg-3 mb-4">
                    <div class="card">
                        <div class="card-body text-center">

                            @if (!empty($f['user_alumni']['foto']))
                                <img src="{{ url('/user/foto', $f['user_alumni']['foto']) }}" alt="" class="rounded-circle foto-friend">
                            @else
                                <img class="rounded-circle foto-friend" src="{{ asset('user/foto/user.png') }}" alt="">
                            @endif
                            
                            <a href="{{ route('frontend.view-friend-alumni', $f['user_id']) }}"><p class="card-text" style="font-size: 14px; font-weight: 500;">{{ $f['user_alumni']['nama'] }}</p></a>
                            <p class="card-text mb-3" style="color: grey; font-size: 14px; font-weight: 300;">{{ $f['pekerjaan_sekarang'] }} di {{ $f['perusahaan_sekarang'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            
            
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