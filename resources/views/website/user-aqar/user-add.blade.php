@extends('layouts.app')

@section('title')
    اضافة عقار جديد
@endsection

@section('header')
    <link rel="stylesheet" href="{{asset('Custom/all_aqar.css')}}">

    <style>
        .item-search
        {
            margin-bottom: 12px;
        }

        .breadcrumb
        {
            background: #FFF;
        }
    </style>
@endsection


@section('content')

    <div class="container">
        <div class="row profile">
            <div class="col-md-9">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">الرئيسيه</a></li>
                    <li><a href="{{url('/user/create/building')}}">اضافة عقار جديد</a></li>


                </ol>
                <div class="profile-content" style="overflow: auto">

                    @include('admin.partials.validation_errors')
                    {!! Form::open([
                        'url' => '/user/create/building',
                        'files'  => 'true'
                    ]) !!}

                    @include('admin.aqars.form', ['user' =>1])
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

