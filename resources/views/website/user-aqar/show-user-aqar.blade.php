@extends('layouts.app')

@section('title')
     عقارات المستخدم {{auth()->user()->name}}
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
                    <li><a href="{{url('/showAllBuilding')}}">كل العقارات</a></li>
                    <li><a class="active" href="">عقارات المستخدم {{auth()->user()->name}}</a></li>
                </ol>
                <div class="profile-content" style="overflow: auto">
                    @include('website.aqar.shareFile', ['records', $records])
                </div>
                <div class="text-center">
                    {{$records->appends(request()->except('page'))->render()}}
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
