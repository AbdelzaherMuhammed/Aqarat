@extends('layouts.app')

@section('title')
    تم اضافة العقار بنجاح
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
                    <li><a href="{{url('/user/create/building')}}">اضافة عقار جديد</a></li>
                    <li><a class="active" href="{{url('/user/create/building')}}">تم اضافة العقار جديد</a></li>

                </ol>
                <div class="profile-content" style="overflow: auto">
                    <div class="alert alert-success">
                        <b>
                            تم اضافة
                        </b>
                        العقار بنجاح ...............
                    </div>
                </div>
            </div>


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

