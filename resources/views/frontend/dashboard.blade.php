@extends('layouts.portal.master')

@section('content')

    <div class="row">
        <div class="col-lg-3">
            <div class="card text-center">
                <img src="{{ url('/media/scotland.jpg') }}" class="card-img-top" alt="..." style="max-width: 100%; height: 80px;">
                <div class="card-body body-profile">
                    <img src="{{ url('/media/wahyu.jpeg') }}" class="rounded-circle" alt="">
                    <h5 class="card-title">Wahyu Hidayat</h5>
                    <p class="card-text" style="color: grey; font-size: 14px; font-weight: 300;">Laboran di Universitas Islam Bandung.</p>
                    <hr>
                    <h6 class="card-title text-start">Teknik Pertambangan</h6>
                    <p class="card-text text-start" style="color: grey; font-size: 14px; font-weight: 300;">2011</p>
                    
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
            <div class="card mb-3">
                <div class="row g-0 post-area">
                    <div class="col-md-3">
                        <img src="{{ url('/media/wahyu.jpeg') }}" class="rounded-circle" alt="">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <div class="d-grid gap-3">
                                <button type="button" class="btn btn-lg btn-outline-secondary rounded-pill">Klik disini untuk posting</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card feeds-card">
                <div class="card-header feed-header">
                    <img src="{{ url('/media/wahyu.jpeg') }}" class="float-start" alt="">
                    <p>Wahyu Hidayat</p>
                    <p><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
                <div class="card-body feed-body">
                    <p>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <img src="{{ url('/media/scotland.jpg') }}" class="card-img-bottom img-card" alt="...">
            </div>
            <div class="card feeds-card">
                <div class="card-header feed-header">
                    <img src="{{ url('/media/wahyu.jpeg') }}" class="float-start" alt="">
                    <p>Wahyu Hidayat</p>
                    <p><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
                <div class="card-body feed-body">
                    <p>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                <img src="{{ url('/media/scotland.jpg') }}" class="card-img-bottom img-card" alt="...">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    Para alumni FT
                </div>
                <div class="card-body">
                    <div class="row member-card">
                        <img src="{{ url('/media/wahyu.jpeg') }}" class="rounded-circle  float-start" alt="">
                        <div class="member-caption">
                            <h6>Wahyu Hidayat</h6>
                            <p><small class="text-body-secondary">Ikuti</small></p>
                        </div>
                    </div>
                    <div class="row member-card">
                        <img src="{{ url('/media/wahyu.jpeg') }}" class="rounded-circle  float-start" alt="">
                        <div class="member-caption">
                            <h6>Wahyu Hidayat</h6>
                            <p><small class="text-body-secondary">Ikuti</small></p>
                        </div>
                    </div>
                    <div class="row member-card">
                        <img src="{{ url('/media/wahyu.jpeg') }}" class="rounded-circle  float-start" alt="">
                        <div class="member-caption">
                            <h6>Wahyu Hidayat</h6>
                            <p><small class="text-body-secondary">Ikuti</small></p>
                        </div>
                    </div>
                    <div class="row member-card">
                        <img src="{{ url('/media/wahyu.jpeg') }}" class="rounded-circle  float-start" alt="">
                        <div class="member-caption">
                            <h6>Wahyu Hidayat</h6>
                            <p><small class="text-body-secondary">Ikuti</small></p>
                        </div>
                    </div>
                    <div class="row member-card">
                        <img src="{{ url('/media/wahyu.jpeg') }}" class="rounded-circle  float-start" alt="">
                        <div class="member-caption">
                            <h6>Wahyu Hidayat</h6>
                            <p><small class="text-body-secondary">Ikuti</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection