@extends('admin.layouts.layout')


@section('title')
    تعديل العقار
    {{$model->bu_name}}
@endsection


@section('content')

    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">

                <div class="text2">

                    <div class="col-md-11">
                       @if($user == '')
                            <p>
                                تمت اضافة العقار بواسطة زائر
                            </p>
                        @else
                            <p>
                                اسم المستخدم :
                                {{$user->name}}
                            </p>
                            <p>
                                البريد الالكتروني :
                                {{$user->email}}
                            </p>

                            <p>
                                صلاحيات العضو :
                                @if($user->admin == 0)
                                    زائر
                                @else
                                    مدير
                                @endif
                            </p>

                            <p>
                                للمزيد  :
                                <a href="{{route('user.edit', $user->id)}}">اضغط هنا</a>
                            </p>

                        @endif

                    </div>
                    <label class="col-md-1">
                        معلومات عن صاحب العقار
                    </label>
                </div>

                <div class="clearfix"></div>
                <br>

                @include('flash::message')
                {!! Form::model($model , [
                    'url' => route('aqar.update', $model->id),
                    'method' => 'put',
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
        $(document).ready(function() {

            $('.select2').select2({
                dir:'rtl'
            });
        });
    </script>

@endsection



