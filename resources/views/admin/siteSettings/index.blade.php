@extends('admin.layouts.layout')

@section('title')
    تعديل اعدادت الموقع
@endsection

@section('header')
@endsection

@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

                @include('flash::message')
                @include('admin.partials.validation_errors')
                {!! Form::open([
                    'url' => route('setting.update',$settings->first()),
                    'files' => true,
                    'method' => 'PUT'
                ]) !!}

                <div class="form-group">
                    <div class="col-md-12">
                        <label for="site_name">اسم الموقع</label>
                        {!! Form::text("site_name", $settings->site_name, [
                             'class' => 'form-control',
                        ]) !!}

                        <br>
                        <label for="phone">رقم الهاتف</label>
                        {!! Form::text("phone", $settings->phone, [
                             'class' => 'form-control',

                        ]) !!}

                        <br>
                        <label for="facebook_link">رابط الفيسبوك</label>
                        {!! Form::text("facebook_link", $settings->facebook_link, [
                             'class' => 'form-control',

                        ]) !!}

                        <br>
                        <label for="twitter_link">رابط تويتر</label>
                        {!! Form::text("twitter_link", $settings->twitter_link, [
                             'class' => 'form-control',

                        ]) !!}

                        <br>
                        <label for="github_link">رابط جيتهب</label>
                        {!! Form::text("github_link" , $settings->github_link, [
                             'class' => 'form-control',

                        ]) !!}

                        <br>
                        <label for="address">العنوان</label>
                        {!! Form::text("address", $settings->address, [
                             'class' => 'form-control',

                        ]) !!}

                        <br>
                        <label for="key_words">الكلمات الدلاليه</label>
                        {!! Form::text("key_words", $settings->key_words, [
                             'class' => 'form-control',

                        ]) !!}

                        <br>
                        <label for="description">وصف الموقع</label>
                        {!! Form::textarea("description" , $settings->description , [
                             'class' => 'form-control',

                        ]) !!}

                        <br>
                        <label for="alternate_image">الصوره البديله</label>
                        {!! Form::text("alternate_image" , $settings->alternate_image , [
                             'class' => 'form-control',
                        ]) !!}

                        <br>
                        <label for="main_slider">صورة السلايدر</label>
                        <br>
                        @if($settings->main_slider != null)
                            <img src="{{asset('images/slider/'. $settings->main_slider)}}" alt="main_slider" width="150">
                        @endif

                        <br>
                        <br>
                        {!! Form::file("main_slider" , null , [
                             'class' => 'form-control',
                        ]) !!}

                        <br>
                        <label for="copy_right">حقوق الموقع</label>
                        {!! Form::text("copy_right" , $settings->copy_right , [
                             'class' => 'form-control',
                        ]) !!}




                    </div>


                </div>




            </div>
            <button type="submit" class="btn btn-app">
                <i class="fa fa-save"></i>
                حفظ اعدادات الموقع
            </button>
        {!! Form::close() !!}

        <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>



@endsection















@section('footer')



@endsection



