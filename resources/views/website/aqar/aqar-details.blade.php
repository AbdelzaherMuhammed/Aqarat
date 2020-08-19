@extends('layouts.app')

@section('title')
    {{$record->name}}العقار
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
                    <h1>
                        {{$record->bu_name}}
                    </h1>
                    <hr>
                    <div class="btn-group" role="group" aria-label="...">

                        <a href="{{url('/search?bu_price='.$record->bu_price)}}" class="btn btn-default">
                            السعر :
                            {{$record->bu_price}}$
                        </a>

                        <a href="{{url('/search?bu_square='.$record->bu_square)}}" class="btn btn-default">
                            المساحه :
                            {{$record->bu_square}}
                        </a>

                        <a href="{{url('/search?bu_place='.$record->bu_place)}}" class="btn btn-default">
                            المنطقه :
                            {{aqarPlace()[$record->bu_place]}}
                        </a>
                        <a href="{{url('/search?rooms='.$record->rooms)}}" class="btn btn-default">
                            عدد الغرف :
                            {{$record->rooms}}
                        </a>
                        <a href="{{url('/search?bu_rent='.$record->bu_rent)}}" class="btn btn-default">
                            نوع العمليه :
                            {{aqar_rent()[$record->bu_rent]}}
                        </a>

                        <a href="{{url('/search?bu_type='.$record->bu_type)}}" class="btn btn-default">
                            نوع العقار :
                            {{aqar_type()[$record->bu_type]}}
                        </a>

                    </div>
                    <hr>
                    <div class="pull-left">
                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <script async="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBd3PjUqq81lIOfBPYXrQGWwK5T4ystZjA"></script>

                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                    <div class="addthis_inline_share_toolbox_s5mo"></div><div class="clearfix"></div>
                    </div>
                    <div class="img-wrap"><img src= "{{$record->image != null ? asset('images/'.$record->image) :
                    asset('images/'.$settings->alternate_image)}}" class="img-responsive">
                    </div>
                    <hr>
                    <p>
                        {!!nl2br($record->bu_large_disc)!!}
                    </p><br>

                    <div id="map" style="width: 100%; height: 300px"></div>

                </div>

                    <hr>
                    <div class="profile-content" style="overflow: auto">
                        <h2>عقارات أخري قد تهمك</h2>
                        <hr>
                        @include('website.aqar.shareFile', ['records' => $sameArarsRent])
                        @include('website.aqar.shareFile', ['records' => $sameArarsType])
                    </div>
            </div>
            @include('website.aqar.pages')


        </div>
    </div>


@endsection

@section('footer')
{{--    <script--}}
{{--        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiWnvCHfnLI_Si4AWzXkfNg_aQ0ax-52Y&callback=initMap&libraries=&v=weekly"--}}
{{--        defer--}}
{{--    ></script>--}}
<script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" async defer></script>

    <script src="{{asset('Custom/custom')}}"></script>

@endsection


