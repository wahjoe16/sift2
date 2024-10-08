<nav class="navbar navbar-expand-lg fixed-top bg-body-tertiary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboardFrontend.index') }}">FT</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="cari ... ?" aria-label="Search">
                {{-- <button class="btn btn-outline-success" type="submit">Search</button> --}}
            </form>
            <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0 ml-lg-5">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Koneksi Saya</a>
                </li>
                <li class="nav-item dropdown">
                    <button class="btn nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-sun-fill theme-icon-active" data-theme-icon-active="bi-sun-fill"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <button class="dropdown-item d-flex align-items-center" type="button" data-bs-theme-value="light">
                                <i class="bi bi-sun-fill opacity-50" data-theme-icon="bi-sun-fill"></i>&nbsp;
                                Light
                            </button>
                        </li>
                        <li>
                            <button class="dropdown-item d-flex align-items-center" type="button" data-bs-theme-value="dark">
                                <i class="bi bi-moon-fill opacity-50" data-theme-icon="bi-moon-fill"></i>&nbsp;
                                Dark
                            </button>
                        </li>
                        <li>
                            <button class="dropdown-item d-flex align-items-center" type="button" data-bs-theme-value="auto">
                                <i class="bi bi-circle-half opacity-50" data-theme-icon="bi-circle-half"></i>&nbsp;
                                Auto
                            </button>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <button class="btn nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ url('/media/wahyu.jpeg') }}" class="rounded-circle" alt="" width="40px">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="{{ route('frontend.profile-update', 'personal') }}" class="btn btn-default btn-flat"><i class="bi bi-person-lines-fill"></i> Edit Profil</a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.logout') }}" class="btn btn-default btn-flat"><i class="bi bi-box-arrow-left"></i></i> Keluar</a>
                        </li>
                        
                    </ul>
                </li>
            </ul>
            
        </div>
    </div>
</nav>