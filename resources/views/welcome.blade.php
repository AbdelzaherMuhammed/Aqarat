@inject('aqars','App\Aqar')
@extends('layouts.app')

@section('title')
    أهلا بك زائرنا الكريم
@endsection

@section('header')
    <link rel="stylesheet" href="{{asset('main/css/reset.css')}}"> <!-- CSS reset -->
    <link rel="stylesheet" href="{{asset('main/css/style.css')}}"> <!-- Resource style -->
    <script src="{{asset('main/js/modernizr.js')}}"></script> <!-- Modernizr -->
    {!! Html::style('website/css/fonts.css') !!}

    <style>
        .banner-info .form-control
        {
            margin-top: 0;
        }
    </style>

@endsection


@section('content')

    <div class="banner text-center" style="background: url('{{asset('images/slider/'.$settings->main_slider)}}') no-repeat center;background-size: cover;">
        <div class="container">
            <div class="banner-info">
                <h1 style="margin-top: 100px">
                    أهلا بك في
                    {{$settings->site_name}}
                </h1>
                <p>

                {!! Form::open(['url' => 'search', 'method' => 'get']) !!}
                <div class="row">
                    <div class="col-md-2">
                        {!! Form::text('bu_price_from' , null ,
                             ['class' => 'form-control', 'placeholder' => 'سعر العقار من']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::text('bu_price_to' , null ,
                             ['class' => 'form-control', 'placeholder' => 'سعر العقار الي']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('bu_place' , aqarPlace() ,null ,
                             ['class' => 'form-control select2', 'placeholder' => 'منطقة العقار']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::select('rooms' , roomNumber(), null,
                             ['class' => 'form-control select2', 'placeholder' => 'عدد الغرف']) !!}
                    </div>

                    <div class="col-md-2">
                        {!! Form::select('bu_type' , aqar_type(), null,
                             ['class' => 'form-control', 'placeholder' => 'نوع العقار']) !!}
                    </div>
                </div>
                <br>
                <div class="row">

                    <div class="col-md-2">
                        {!! Form::submit('ابحث',
                           ['class' => 'btn btn-block',
                           'style' => 'margin-top:0']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::text('bu_square', null,
                             ['class' => 'form-control', 'placeholder' => 'مساحة العقار']) !!}
                    </div>

                    <div class="col-md-4">
                        {!! Form::select('bu_rent' , aqar_rent(), null,
                             ['class' => 'form-control', 'placeholder' => 'نوع العملبة']) !!}
                    </div>
                </div>
                {!! Form::close() !!}

                </p>
                <a class="banner_btn" style="margin-top: 10px;padding-top: 10px" href="{{url('/user/create/building')}}">أضف عقار مجانا</a></div>
        </div>
    </div>
    <div class="main">
        <ul class="cd-items cd-container">
            @foreach($aqars->where('bu_status', 1)->get() as $aqar)
            <li class="cd-item effect8">
                <img src="{{$aqar->image != null ? asset('images/'.$aqar->image) :
                    asset('images/'.$settings->alternate_image)}}" alt="Item Preview">
                <a href="#0" data-id="{{$aqar->id}}" title="{{$aqar->bu_name}}" class="cd-trigger">نبذه سريعه</a>
            </li> <!-- cd-item -->
            @endforeach
        </ul> <!-- cd-items -->

        <div class="cd-quick-view">
            <div class="cd-slider-wrapper">
                <ul class="cd-slider">
                    <li class="selected"><img class="image-box text-center" src="{{asset('main/img/item-1.jpg')}}" style="margin-top: 25px;width: 165px" alt="Product 1"></li>
                </ul> <!-- cd-slider -->

            </div> <!-- cd-slider-wrapper -->

            <div class="cd-item-info" style="margin-left: 200px">
                <h2 class="title-box"></h2>
                <p class="disbox"></p>

                <ul class="cd-item-action">
                    <li><a href="" class="add-to-cart price-box"></a></li>
                    <li><a class="more-box" href="#0">قراءة المزيد</a></li>
                </ul> <!-- cd-item-action -->
            </div> <!-- cd-item-info -->
            <a href="#0" class="cd-close">Close</a>
        </div> <!-- cd-quick-view -->
    </div>


@endsection

@section('footer')
    <script src="{{asset('main/js/velocity.min.js')}}"></script>
    <script src="{{asset('main/js/main.js')}}"></script>
    <script>
        function urlHome() {
            return '{{request()->root()}}';
        }

        function noImageUrl() {
            return '{{$settings->alternate_image}}';
        }
    </script>

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

