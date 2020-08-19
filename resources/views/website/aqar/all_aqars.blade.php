@extends('layouts.app')

@section('title')
    كل العقارات
@endsection

@section('header')
    <link rel="stylesheet" href="{{asset('Custom/all_aqar.css')}}">
    <link rel="stylesheet" href="{{asset('websit/fonts.css')}}">

    <style>
        .item-search
        {
            margin-bottom: 12px;
        }

        .breadcrumb
        {
            background: #FFF;
        }
        .width_auto
        {
            font-size: 92%;
        }
    </style>

@endsection


@section('content')

    <div class="container">
        <div class="row profile">
            <div class="col-md-9">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">الرئيسيه</a></li>
                    @if(isset($array))
                        @if(!empty($array))
                            @foreach($array as $key => $value)
                                <li><a href="{{url('/search?'.$key.'='.$value)}}">{{searchName()[$key]}} ->
                                       @if($key == 'bu_type')
                                            {{aqar_type()[$value]}}
                                        @elseif($key == 'bu_rent')
                                            {{aqar_rent()[$value]}}
                                        @elseif($key == 'bu_place')
                                           {{aqarPlace()[$value]}}
                                        @else
                                        {{$value}}
                                        @endif
                                    </a></li>
                            @endforeach
                        @endif
                    @endif
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
