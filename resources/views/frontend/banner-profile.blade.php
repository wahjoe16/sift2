<div class="card">

    @if (!empty($dataAlumni->banner_img))
        <img src="{{ asset('/user/banner/' . $dataAlumni->banner_img ?? '') }}" class="card-img-top" alt="" style="max-width: 100%; height: 320px; object-fit: cover; position:relative; bottom:18px;">
    @else
        <img src="{{ url('/media/scotland.jpg') }}" class="card-img-top" alt="..." style="max-width: 100%; height: 320px; position:relative; bottom:18px;">
    @endif

    <div class="element-foto-banner">
        <button onclick="bannerForm('{{ route('frontend.change-banner') }}')" class="btn btn-outline-light btn-sm ms-auto"><i class="bi bi-pencil"></i></button>
    </div>

    <div class="card-body profile-banner">
        @if (!empty(Auth::guard('alumni')->user()->foto))
            <img src="{{ asset('/user/foto/' . Auth::guard('alumni')->user()->foto ?? '') }}" class="rounded-circle" alt="">
        @else
            <img class="rounded-circle" src="{{ asset('user/foto/user.png') }}" alt="" style="width: 300px important;">
        @endif
        <div class="element-foto-profile">
            <button onclick="photoForm('{{ route('frontend.change-photo') }}')" type="button" class="btn btn-light btn-sm"><i class="bi bi-pencil"></i></button>
            {{-- <button class="btn btn-light btn-sm rounded-circle square"><i class="bi bi-pencil"></i></button> --}}
            {{-- <i class="bi bi-pencil"></i><span class="name">No file selected</span> --}}
            {{-- <input type="file" name="" id=""> --}}
        </div>
        {{-- <img src="{{ url('/media/wahyu.jpeg') }}" class="rounded-circle" alt=""> --}}
        <h5 class="card-title">{{ Auth::guard('alumni')->user()->nama }}</h5>
        <p class="card-text" style="color: grey; font-size: 14px; font-weight: 300;">{{ $dataAlumni->pekerjaan_sekarang }} di {{ $dataAlumni->perusahaan_sekarang }}</p> 
    </div>

</div>