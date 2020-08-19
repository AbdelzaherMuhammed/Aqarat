@extends('layouts.app')

@section('title')
    {{$messageTitle}}
@endsection

@section('header')
    <link rel="stylesheet" href="{{asset('Custom/all_aqar.css')}}">

    <style>
        .item-search {
            margin-bottom: 12px;
        }

        .breadcrumb {
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
                    <li><a href="{{url('/building-details', $record->id)}}"> {{$record->bu_name}} </a></li>
                </ol>
                <div class="profile-content" style="overflow: auto">
                    <div class="alert alert-danger">
                        <b>
                            تنبيه!
                        </b>
{{$messageBody}}
                    </div>
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
