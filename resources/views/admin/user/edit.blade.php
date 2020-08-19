@extends('admin.layouts.layout')


@section('title')
    تعديل العضو
    {{$user->name}}
@endsection

@section('header')
    <style>
        .nav-tabs > li {
            float: right
        }
    </style>
@endsection

@section('content')

    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="#activity" data-toggle="tab">عقارات غير مفعله</a></li>
                        <li class="active"><a href="#timeline" data-toggle="tab">عقارات مفعله</a></li>
                        <li><a href="#settings" data-toggle="tab">تعديل المعلومات الشخصيه للعضو {{$user->name}}</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="activity">
                            <table class="table table-bordered">
                                <tr>
                                    <td>اسم العقار</td>
                                    <td>أضيف في</td>
                                    <td>نوع العقار</td>
                                    <td>سعر العقار</td>
                                    <td>مكان العقار</td>
                                    <td>مساحة العقار</td>
                                    <td>نوع العمليه</td>
                                    <td>تغيير حالة العقار</td>
                                </tr>
                                @foreach($aqarWaiting as $waiting)
                                    <tr>
                                        <td>
                                            <a href="{{route('aqar.edit', $waiting->id)}}">{{$waiting->bu_name}}

                                            </a>
                                        </td>

                                        <td>
                                            {{$waiting->created_at}}
                                        </td>

                                        <td>
                                            {{aqar_type()[$waiting->bu_type]}}
                                        </td>

                                        <td>
                                            ${{$waiting->bu_price}}
                                        </td>

                                        <td>
                                            {{aqarPlace()[$waiting->bu_place]}}
                                        </td>

                                        <td>
                                            {{$waiting->bu_square}}
                                        </td>

                                        <td>
                                            {{aqar_rent()[$waiting->bu_rent]}}
                                        </td>

                                        <td>
                                            <a class="btn btn-success"
                                               href="{{url('adminpanel/change-aqar-status',$waiting->id)}}">تفعيل العقار
                                                <i class="fa fa-key"></i></a>
                                        </td>


                                    </tr>
                                @endforeach
                            </table>

                            <div class="text-center">
                                {{$aqarWaiting->appends(request()->except('page'))->render()}}
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="active tab-pane" id="timeline">
                            <table class="table table-bordered">
                                <tr>
                                    <td>اسم العقار</td>
                                    <td>أضيف في</td>
                                    <td>نوع العقار</td>
                                    <td>سعر العقار</td>
                                    <td>مكان العقار</td>
                                    <td>مساحة العقار</td>
                                    <td>نوع العمليه</td>
                                    <td>تغيير حالة العقار</td>
                                </tr>
                                @foreach($aqarEnabled as $enabled)
                                    <tr>
                                        <td>
                                            <a href="{{route('aqar.edit', $enabled->id)}}">{{$enabled->bu_name}}

                                            </a>
                                        </td>

                                        <td>
                                            {{$enabled->created_at}}
                                        </td>

                                        <td>
                                            {{aqar_type()[$enabled->bu_type]}}
                                        </td>

                                        <td>
                                            ${{$enabled->bu_price}}
                                        </td>

                                        <td>
                                            {{aqarPlace()[$enabled->bu_place]}}
                                        </td>

                                        <td>
                                            {{$enabled->bu_square}}
                                        </td>

                                        <td>
                                            {{aqar_rent()[$enabled->bu_rent]}}
                                        </td>

                                        <td>
                                            <a class="btn btn-danger"
                                               href="{{url('adminpanel/change-aqar-status',$enabled->id)}}">الغاء
                                                التفعيل <i class="fa fa-key"></i></a>
                                        </td>

                                    </tr>
                                @endforeach
                            </table>

                            <div class="text-center">
                                {{$aqarEnabled->appends(request()->except('page'))->render()}}
                            </div>

                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            <section class="content">

                                <!-- Default box -->
                                <div class="box">

                                    <h3 class="box-title">
                                        تعديل العضو {{$user->name}}
                                    </h3>
                                    <hr>

                                    <div class="box-body">
                                        {!! Form::model($user , [
                                            'url' => route('user.update', $user->id),
                                            'method' => 'put'
                                        ]) !!}

                                        @include('admin.user.form')

                                        {!! Form::close() !!}

                                    </div>
                                    <!-- /.box-footer-->
                                </div>
                                <!-- /.box -->
                            </section>

                            <section class="content">

                                <!-- Default box -->
                                <div class="box">

                                    <div class="box-body">

                                        <h3 class="box-title">
                                            تعديل كلمة المرور
                                        </h3>
                                        <hr>

                                        @include('flash::message')

                                        {!! Form::open([
                                             'url' => 'adminpanel/user/updatePassword' ,
                                             'method' => 'post'
                                         ])!!}
                                        {{Form::hidden('user_id' , $user->id  )}}
                                        <div class="clearfix"></div>
                                        <br>

                                        <div class="form-group">

                                            <div class="col-md-12">
                                                <input id="password" type="password" placeholder="كلمة المرور"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password" required autocomplete="new-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <br>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input id="password" type="password" placeholder="تاكيد كلمة المرور"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password" required autocomplete="new-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="clearfix"></div>
                                        <br>

                                        <div class="text2">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fa fa-user" style="color:#FFFFFF"></i>
                                                    {{ __('تغيير كلمة المرور ') }}
                                                </button>
                                                @if($user->id != 1)
                                                    <a href="{{'adminpanel/user/' . $user->id . '/delete'}}"
                                                       class="btn btn-danger btn-circle"><i
                                                            class="fa fa-trash"></i>حذف العضو</a>
                                                @endif
                                            </div>
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                </div>


                                <!-- /.box-footer-->
                            </section>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>


            <!-- /.box -->
        </div>
    </section>

@endsection



@section('footer')



@endsection



