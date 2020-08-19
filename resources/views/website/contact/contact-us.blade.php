@extends('layouts.app')

@section('title')
    اتصل بنا
@endsection

@section('header')
    <link rel="stylesheet" href="{{asset('Custom/about_us.css')}}"> <!-- Resource style -->
@endsection


@section('content')
    <section id="contact">
        <div class="section-content">
            <h1 class="section-header">سارع و<span class="content-header wow fadeIn " data-wow-delay="0.2s"
                data-wow-duration="2s"> اتصل بنا</span></h1>
            <h3>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى</h3>
        </div>
        <div class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        @include('admin.partials.validation_errors')
                        {!! Form::open([
                            'url' => url(route('contact-create'))
                        ]) !!}

                        <div class="col-md-6 pull-right">
                            <div class="form-group">
                                {!! Form::text('name', null, [
                                      'class'        => 'form-control input-lg',
                                      'placeholder' => 'ادخل اسمك'
                                ]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::text('email', null, [
                                    'class'        => 'form-control input-lg',
                                     'placeholder' => 'ادخل بريدك الالكتروني'
                              ]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::select('type',contactType(), null, [
                                  'class'        => 'form-control input-lg select-box',
                                   'placeholder' => 'اختر عنوان الرساله',
                                   'style'       => 'height:55px'
                            ]) !!}
                            </div>
                        </div>

                        <div class="col-md-6 form-line pull-left">
                            <div class="form-group">
                                {!! Form::textarea('message', null, [
                                    'class'        => 'form-control input-lg ',
                                    'placeholder' => 'ادخل رسالتك'
                                ]) !!}
                            </div>

                                <button type="submit" class="btn btn-default submit btn-lg btn-block text-center">
                                    ارسال الرساله  <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </button>


                        </div>
                    </div>

                    {!! Form::close() !!}
                    <div class="col-md-3">
                        <legend><i class="fa fa-outdent"></i> مكتبنا</legend>
                        <address>
                            <strong> العنوان : {{$settings->address}}</strong><br>

                            <br>
                            <abbr title="Phone">
                                الجوال :</abbr>
                            {{$settings->phone}}
                        </address>
                        <address>
                            <strong>{{$settings->site_name}}</strong><br>
                            <br>
                            <a target="_blank" href="{{$settings->facebook_link}}">Our Facebook</a>
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
