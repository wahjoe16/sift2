@extends('layouts.portal.master')

@push('top_css')

    <style>

        .element-foto-profile {
            display: inline-flex;
            position: relative;
            bottom: 80px;
            right: 10px;
        }
        
        i.bi-pencil {
            margin: 10px;
            cursor: pointer;
            font-size: 15px;
        }

        i:hover {
            opacity: 0.6;
        }

        .element-foto-banner {
            display: inline-flex;
            position: relative;
            bottom: 60px;
            right: 15px;
        }

        .element-foto-banner > i.bi-pencil {
            margin: auto;
            cursor: pointer;
            font-size: 15px;
            background-color: #fff;
            color: #565656;
            width: 35px;
            height: 35px;
            align-content: center;
            border-radius: 50%;
            opacity: 0.6;
            content: "\f4cb";
            padding-left: 8px;
        }

        .element-foto-banner > i.bi-pencil:hover {
            opacity: 1;
        }

        i:hover {
            opacity: 0.6;
        }
        
    </style>
    
@endpush

@section('content')

    <div class="row">
        <div class="col-lg-12">
            @include('frontend.banner-profile')
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-3">
            @include('frontend.side-menu-profile')
        </div>
        <div class="col-lg-9">
            <h5><i class="bi bi-chat-left-text icon-menu-profile" style="color: #0317fc;"></i> Akun Media Sosial</h5>
            <hr>
            <form action="{{ route('frontend.medsos-update') }}" method="post" class="form-medsos" data-toggle="validator">
                @csrf
                <div class="mb-3">
                    <label for="link_linkedin" class="form-label"><i class="bi bi-linkedin"></i>&nbsp;&nbsp;Linked In</label>
                    <input type="text" name="link_linkedin" class="form-control" id="link_linkedin" placeholder="Link akun Linked In anda" @if(!empty($dataMedsos['link_linkedin'] )) value="{{ $dataMedsos['link_linkedin'] }}" @else value="{{ old('link_linkedin') }}" @endif>   
                </div>
                <div class="mb-3">
                    <label for="link_instagram" class="form-label"><i class="bi bi-instagram"></i>&nbsp;&nbsp;Instagram</label>
                    <input type="text" name="link_instagram" class="form-control" id="link_instagram" placeholder="Link akun Instagram anda" @if(!empty($dataMedsos['link_instagram'] )) value="{{ $dataMedsos['link_instagram'] }}" @else value="{{ old('link_instagram') }}" @endif>   
                </div>
                <div class="mb-3">
                    <label for="link_facebook" class="form-label"><i class="bi bi-facebook"></i>&nbsp;&nbsp;Facebook</label>
                    <input type="text" name="link_facebook" class="form-control" id="link_facebook" placeholder="Link akun Facebook anda" @if(!empty($dataMedsos['link_facebook'] )) value="{{ $dataMedsos['link_facebook'] }}" @else value="{{ old('link_facebook') }}" @endif>   
                </div>
                <div class="mb-3">
                    <label for="link_twitter" class="form-label"><i class="bi bi-twitter-x"></i>&nbsp;&nbsp;twitter-X</label>
                    <input type="text" name="link_twitter" class="form-control" id="link_twitter" placeholder="Link akun X anda" @if(!empty($dataMedsos['link_twitter'] )) value="{{ $dataMedsos['link_twitter'] }}" @else value="{{ old('link_twitter') }}" @endif>   
                </div>
                <div class="mb-3">
                    <label for="link_youtube" class="form-label"><i class="bi bi-youtube"></i>&nbsp;&nbsp;Youtube</label>
                    <input type="text" name="link_youtube" class="form-control" id="link_youtube" placeholder="Link akun Youtube anda" @if(!empty($dataMedsos['link_youtube'] )) value="{{ $dataMedsos['link_youtube'] }}" @else value="{{ old('link_youtube') }}" @endif>   
                </div>
                <div class="mb-3">
                    <label for="link_website" class="form-label"><i class="bi bi-globe"></i>&nbsp;&nbsp;Personal Website</label>
                    <input type="text" name="link_website" class="form-control" id="link_website" placeholder="Link akun personal website anda" @if(!empty($dataMedsos['link_website'] )) value="{{ $dataMedsos['link_website'] }}" @else value="{{ old('link_website') }}" @endif>   
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success btn-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>

@endsection