@extends('layouts.app')

@section('title')
    صفحة تسجيل عضوية جديده
@endsection

@section('content')

<div class="container">

    <div class="contact_bottom">
        <hr>
        <h3>
            تسجيل عضوية جديده
        </h3>
        <hr>


        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="text2">
                <div class="col-md-12">
                    <input id="name" type="string" placeholder="اسم المستخدم" class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="clearfix"></div>
            <br>

            <div class="text2">

                <div class="col-md-12">
                    <input id="email" type="email" placeholder="البريد الالكتروني " class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="clearfix"></div>
            <br>

            <div class="text2">

                <div class="col-md-6">
                    <input id="password" type="password" placeholder="كلمة المرور" class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="text2">

                <div class="col-md-6">
                    <input id="password-confirm" type="password" placeholder="تاكيد كلمة المرور" class="form-control" name="password_confirmation"
                           required autocomplete="new-password">
                </div>
            </div>

            <div class="clearfix"></div>
            <br>

            <div class="text2">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-warning" >
                        <i class="fa fa-user" style="color:#FFFFFF"></i>
                        {{ __('تسجيل عضوية جديده ') }}
                    </button>
                </div>
            </div>
        </form>

    </div>
    <div class="clearfix"></div>
    <br>
</div>


@endsection
