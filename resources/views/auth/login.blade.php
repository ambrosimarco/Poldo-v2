@extends('layouts.app')
<!-- style="background: rgb(2,0,36);
            background: linear-gradient(135deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 0%, rgba(7,46,145,1) 5%, rgba(0,212,255,1) 77%);
            " -->
@section('content')

<div class="container-login100">
    <div class="wrap-login100">
        <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
            @csrf
            <span class="login100-form-title p-b-26">
                {{ __('Login') }}
            </span>
            <span class="login100-form-title p-b-48">
                <img src="./images/icons/icona_bar_poldo.png" />
                <!-- <i class="fa fa-user 2x"></i> -->
            </span>

            <div class="wrap-input100 validate-input">
                <input class="input100" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('Username') }}">
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Enter password">
                <!-- <span class="btn-show-pass">
                    <i class="zmdi zmdi-eye"></i>
                </span> -->
                <input class="input100" required autocomplete="current-password" type="password" name="password" placeholder="{{ __('Password') }}">
                <span class="focus-input100"></span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            @error('name')
            <div class="error text-danger mb-3 text-center">I dati inseriti non sono corretti.</div>
            @enderror

            <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                    <button class="login100-form-btn">
                        {{ __('Login') }}
                    </button>

                </div>

                <!-- @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    <br>
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif -->
            </div>
        </form>
    </div>
</div>
@endsection


<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> 

<div class="form-group row">
    <div class="col-md-6 offset-md-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Login') }}
        </button>

        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
        @endif
    </div>
</div>
</form>
</div>
</div>
</div>
</div>
</div> -->