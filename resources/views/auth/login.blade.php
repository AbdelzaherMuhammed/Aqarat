@extends('layouts.app')

@section('title')

    صفحة تسجيل الدخول
@endsection
@section('content')

    <div class="container">

        <div class="contact_bottom">
            <hr>
            <h3>
                تسجيل الدخول
            </h3>

            <hr>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="text2">


                    <div class="col-md-6">
                        <input id="password" type="password" placeholder="كلمة المرور"
                               class="form-control @error('password') is-invalid @enderror" name="password" required
                               autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="text2">

                    <div class="col-md-6">
                        <input id="email" type="email" placeholder="البريد الالكتروني" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="text2">
                    <div class="col-md-12 ">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('تذكرني') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="text2">
                    <div class="col-md-12 ">
                        <button type="submit" class="btn btn-warning">
                            <i class="fa fa-sign-in" style="color: #FFFFFF"></i>
                            {{ __('تسجيل الدخول') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="banner_btn" href="{{ route('password.request') }}">
                                {{ __('هل نسيت كلمة المرور؟') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
        <div class="clearfix"></div>
        <br>
    </div>


@endsection
