@extends('admin.layouts.layout')


@section('title')
    تعديل الرساله
    {{$model->name}}
@endsection


@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">
                {!! Form::model($model , [
                    'url' => route('contact.update', $model->id),
                    'method' => 'put'
                ]) !!}

                @include('admin.contacts.form')

                {!! Form::close() !!}

            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>

@endsection



@section('footer')



@endsection



