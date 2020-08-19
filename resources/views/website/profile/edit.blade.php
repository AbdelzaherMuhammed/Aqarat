@extends('layouts.app')

@section('title')
    تعديل العلومات الشخصيه للعضو {{$user->name}}
@endsection

@section('header')
    <link rel="stylesheet" href="{{asset('Custom/all_aqar.css')}}">


@endsection


@section('content')

    <div class="container">
        <div class="row profile">
            <div class="col-md-9">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">الرئيسيه</a></li>
                    <li><a class="active" href="#"> تعديل العلومات الشخصيه للعضو {{$user->name}}</a></li>
                </ol>
                <div class="profile-content" style="overflow: auto">
                    <h2>
                        تعديل اسم المستخدم والبريد الالكتروني
                    </h2>
                    <hr>
                    {!! Form::model($user , [
                        'url' => route('user-edit-setting', $user->id),
                        'method' => 'put'
                    ]) !!}
                    @include('admin.user.form',['permission'])

                    {!! Form::close() !!}
                    <br>

                    {{-- Change Password--}}

                    <div class="clearfix"></div>
                    <br>
                    <h2>
                        تعديل كلمة المرور
                    </h2>
                    <hr>

                    {!! Form::open([
                        'url' => '/user/change-password' ,
                    ])!!}

                    {{Form::hidden('user_id' , $user->id  )}}


                    <div class="form-group">

                        <div class="col-md-12">
                            <input id="old_password" type="password" placeholder="ادخل كلمة المرور الحاليه"
                                   class="form-control @error('old_password') is-invalid @enderror"
                                   name="old_password" required autocomplete="old_password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="clearfix"></div>
                        <br>
                    </div>
                    <div class="form-group">

                        <div class="col-md-6">
                            <input id="new_password" type="password" placeholder="ادخل كلمة المرور الجديده"
                                   class="form-control @error('new_password') is-invalid @enderror"
                                   name="new_password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <input id="new_password_confirmation" type="password" placeholder="تاكيد كلمة المرور الجديده"
                                   class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                   name="new_password_confirmation" required autocomplete="new_password_confirmation">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="clearfix"></div>
                    <br>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-warning">
                                <i class="fa fa-user" style="color:#FFFFFF"></i>
                                {{ __('تغيير كلمة المرور ') }}
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>

            @include('website.aqar.pages')


        </div>
    </div>


@endsection

@push('select2')
    <script>
        $(document).ready(function () {

            $('.select2').select2({
                dir: 'rtl'
            });
        });
    </script>
@endpush
