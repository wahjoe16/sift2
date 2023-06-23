@extends('layouts.auth')

@section('login')

<div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('/login_form/images/bg_1.JPG');"></div>
    <div class="contents order-2 order-md-1">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7">
                    <h3>Login <strong>Sistem Informasi Fakultas Teknik</strong></h3>

                    <form method="post" action="{{ route('login') }}">@csrf
                        <div class="form-group first">
                            <label for="username">EMAIL/NIK/NPM</label>
                            <input type="text" class="form-control @error('auth') is-invalid @enderror" id="auth" name="auth" :value="old('auth'" required>
                            @error('auth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group last mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="d-flex mb-5 align-items-center">
                            <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                                <input type="checkbox" checked="checked" />
                                <div class="control__indicator"></div>
                            </label>
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Lupa Password?') }}
                            </a>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection