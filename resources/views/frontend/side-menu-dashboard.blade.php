<div class="col-lg-3 mb-3 mt-3">
    <div class="card text-center">
        {{-- @if (empty($dataAlumni))
            <img src="{{ url('/media/scotland.jpg') }}" class="card-img-top" alt="..." style="max-width: 100%; height: 80px;">   
        @elseif ($dataAlumni->jenjang == 'S1' && $dataAlumni->program_studi == 'Teknik Pertambangan')
            <img src="{{ url('/media/mining.jpg') }}" class="card-img-top" alt="..." style="max-width: 100%; height: 80px;">
        @elseif ($dataAlumni->jenjang == 'S1' && $dataAlumni->program_studi == 'Teknik Industri')
            <img src="{{ url('/media/industry.jpg') }}" class="card-img-top" alt="..." style="max-width: 100%; height: 80px;">
        @elseif ($dataAlumni->jenjang == 'S1' && $dataAlumni->program_studi == 'Perencanaan Wilayah dan Kota')
            <img src="{{ url('/media/pwk.jpg') }}" class="card-img-top" alt="..." style="max-width: 100%; height: 80px;">
        @endif --}}

        @if (!empty($alumni->banner_img))
            <img src="{{ url('/user/banner/', $alumni->banner_img) }}" class="card-img-top" alt="..." style="max-width: 100%; height: 80px; object-fit: cover; position:relative; bottom:18px;">  
        @else
            <img src="{{ url('/media/banneralumni.jpg') }}" class="card-img-top" alt="..." style="max-width: 100%; height: 80px; object-fit: cover; position:relative; bottom:18px;">  
        @endif
        
        <div class="card-body body-profile">
            @if(!empty($dataUser->foto))
                <img src="{{ asset('/user/foto/' . $dataUser->foto ?? '') }}" class="rounded-circle" alt="">
            @else
                <img class="rounded-circle" src="{{ asset('user/foto/user.png') }}" alt="">
            @endif
            <h5 class="card-title">{{ $dataUser->nama }}</h5>

            @if (!empty($alumni->pekerjaan_sekarang) && empty($alumni->perusahaan_sekarang))
                <p class="card-text" style="color: grey; font-size: 14px; font-weight: 300;">{{ $alumni->pekerjaan_sekarang }}</p>
            @elseif (!empty($alumni->pekerjaan_sekarang && $alumni->perusahaan_sekarang))
                <p class="card-text" style="color: grey; font-size: 14px; font-weight: 300;">{{ $alumni->pekerjaan_sekarang }} di {{ $alumni->perusahaan_sekarang }}</p>
                <hr>
            @endif
            
            @foreach ($profilLulusan as $pl)
                <h6 class="card-title text-start">{{ $pl['program_studi'] }}</h6>
                <p class="card-text text-start mt-3" style="color: grey; font-size: 14px; font-weight: 300;">{{ $pl['angkatan'] }}</p>
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