@extends('admin.layouts.layout')


@section('title')
    اضافة عقار جديد
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


                {!! Form::open([
                     'action' => 'AqarController@store',
                     'files'  => 'true'
                ]) !!}

                @include('admin.aqars.form')
                {!! Form::close() !!}
            </div>

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>



@endsection















@section('footer')

    <script>
        $(document).ready(function () {

            $('.select2').select2({
                dir: 'rtl'
            });
        });
    </script>

@endsection



