<div class="col-md-3">
        @if(auth()->user())
            <div class="profile-sidebar">
                <h2 style="margin-right: 10px">
                    خيارات العضو
                </h2>
                <div class="profile-usermenu">
                    <ul class="nav" style="padding-right: 0px">
                        <li class="{{setActive(['user', 'edit-profile'])}}">
                            <a href="{{url('/user/edit-profile')}}">
                                <i class="fa fa-edit"></i>
                                تعديل المعلومات الشخصيه </a>
                        </li>
                        <li class="{{setActive(['user', 'building', 'show'])}}">
                            <a href="{{url('/user/building/show')}}">
                                <i class="fa fa-check"></i>
                                العقارات المفعله
                                <label class="label label-default pull-left">{{aqarForUser(auth()->user()->id, 1)}}</label>
                            </a>

                        </li>

                        <li class="{{setActive(['user', 'building', 'waiting'])}}">
                            <a href="{{url('/user/building/waiting')}}">
                                <i class="fa fa-clock-o"></i>
                                 عقارات في انتظار التفعيل
                                <label class="label label-default pull-left">{{aqarForUser(auth()->user()->id, 0)}}</label>

                            </a>
                        </li>

                        <li class="{{setActive(['user', 'create', 'building'])}}">
                            <a href="{{url('/user/create/building')}}">
                                <i class="fa fa-plus"></i>
                                اضف عقار </a>
                        </li>
                    </ul>

                </div>
                <!-- END MENU -->
            </div>
    @endif

    <br>

    <div class="profile-sidebar">
        <h2 style="margin-right: 10px">
            خيارات العقارات
        </h2>
        <div class="profile-usermenu">
            <ul class="nav" style="padding-right: 0px">

                <li class="{{setActive(['showAllBuilding'])}}">
                    <a href="{{url('/showAllBuilding')}}">
                        <i class="fa fa-building"></i>
                        كل العقارات </a>
                </li>
                <li class="{{setActive(['forRent'])}}">
                    <a href="{{url('/forRent')}}">
                        <i class="fa fa-calendar-o"></i>
                        ايجار </a>
                </li>

                <li class="{{setActive(['forBuy'])}}">
                    <a href="{{url('/forBuy')}}">
                        <i class="fa fa-magic"></i>
                        تمليك </a>
                </li>

                <li class="{{setActive(['type' , '0'])}}">
                    <a href="{{url('/type/0')}}">
                        <i class="fa fa-heart"></i>
                        الشقق </a>
                </li>

                <li class="{{setActive(['type', '1'])}}">
                    <a href="{{url('/type/1')}}">
                        <i class="fa fa-home"></i>
                        الفلل </a>
                </li>

                <li class="{{setActive(['type' , '2'])}}">
                    <a href="{{url('/type/2')}}">
                        <i class="fa fa-institution"></i>
                        الشاليهات </a>
                </li>

            </ul>
        </div>
        <!-- END MENU -->
    </div>
    <br>
    <div class="profile-sidebar" style="padding: 10px">
        <h2 style="margin-right: 10px">
            خيارات البحث المتقدم
        </h2>
        <div class="profile-usermenu">
            {!! Form::open(['url' => 'search', 'method' => 'get']) !!}
            <ul class="nav" style="padding-right: 0px">
                <li class="item-search">
                    {!! Form::text('bu_price_from' , null ,
                         ['class' => 'form-control', 'placeholder' => 'سعر العقار من']) !!}
                </li>

                <li class="item-search">
                    {!! Form::text('bu_price_to' , null ,
                         ['class' => 'form-control', 'placeholder' => 'سعر العقار الي']) !!}
                </li>
                <li class="item-search">
                    {!! Form::select('bu_place' , aqarPlace() ,null ,
                         ['class' => 'form-control select2', 'placeholder' => 'منطقة العقار']) !!}
                </li>

                <li class="item-search">
                    {!! Form::select('rooms' , roomNumber(), null,
                         ['class' => 'form-control', 'placeholder' => 'عدد الغرف']) !!}
                </li>

                <li class="item-search">
                    {!! Form::select('bu_type' , aqar_type(), null,
                         ['class' => 'form-control', 'placeholder' => 'نوع العقار']) !!}
                </li>

                <li class="item-search">
                    {!! Form::select('bu_rent' , aqar_rent(), null,
                         ['class' => 'form-control', 'placeholder' => 'نوع العملبة']) !!}
                </li>

                <li class="item-search">
                    {!! Form::text('bu_square', null,
                         ['class' => 'form-control', 'placeholder' => 'مساحة العقار']) !!}
                </li>

                <li class="item-search">
                    {!! Form::submit('ابحث',
                         ['class' => 'banner_btn btn-block']) !!}
                </li>
            </ul>
            {!! Form::close() !!}
        </div>
        <!-- END MENU -->
    </div>



</div>
