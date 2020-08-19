@inject('users','App\User')
@inject('aqars','App\Aqar')
@inject('contacts','App\contactUs')

@extends('admin.layouts.layout')

@section('title')
    الرئيسيه
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            لوحة تحكم الموقع الرئيسيه
            <small>الاصدار 2.0</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">عدد الرسائل في الموقع</span>
                        <span class="info-box-number">{{$contacts->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-clock-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">عدد العقارات الغير مفعله</span>
                        <span class="info-box-number">{{$aqars->where('bu_status', 0)->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">عدد العقارات المفعله</span>
                        <span class="info-box-number">{{$aqars->where('bu_status', 1)->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">عدد أعضاء الموقع</span>
                        <span class="info-box-number">{{$users->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">العقارات خلال السنه الحاليه</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-wrench"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center">
                                    <strong>
                                        رسم بياني يوضح اضافة العقارات خلال السنه
                                    </strong>
                                </p>

                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="salesChart" style="height: 180px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->

                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
                <!-- MAP & BOX PANE -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">اماكن العقارات</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-md-9 col-sm-8">
                                <div class="pad">
                                    <!-- Map will be created here -->
                                    <div id="world-map-markers" style="height: 325px;"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3 col-sm-4">
                                <div class="pad box-pane-right bg-green" style="min-height: 280px">
                                    <div class="description-block margin-bottom">

                                        <h5 class="description-header">{{$aqars->where('bu_status', 1)->count()}}</h5>
                                        <span class="description-text">العقارات
                                            <br>
                                            المفعله</span>
                                    </div>
                                    <!-- /.description-block -->
                                    <div class="description-block margin-bottom">

                                        <h5 class="description-header">{{$aqars->where('bu_status', 0)->count()}}</h5>
                                        <span class="description-text">العقارات
                                            <br>
                                            الغير مفعله</span>
                                    </div>
                                    <!-- /.description-block -->
                                    <div class="description-block">

                                        <h5 class="description-header">{{$aqars->count()}}</h5>
                                        <span class="description-text">كل
                                            <br>
                                            العقارات</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <div class="row">

                    {{-- orders --}}
                        <div class="col-md-6">
                            <!-- TABLE: LATEST ORDERS -->
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">اخر الرسائل</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                            <tr>
                                                <th>الاي دي</th>
                                                <th>اسم المرسل</th>
                                                <th>البريد الالكتروني</th>
                                                <th>حالة الرساله</th>
                                                <th> نوع الرساله</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($contacts->take(8)->orderBy('id', 'desc')->get() as $contact)
                                            <tr>
                                                <td><a href="{{route('contact.edit', $contact->id)}}">{{$contact->id}}</a></td>
                                                <td><a href="{{route('contact.edit', $contact->id)}}">{{$contact->name}}</a></td>
                                                <td>{{$contact->email}}</td>
                                                <td>@if($contact->is_read == 1)
                                                        <span class="btn btn-warning">
                                                            مقروءه <i class="fa fa-check"></i> </span>
                                                    @else
                                                        <a href="{{url(route('change-status' , $record->id))}}" class="btn btn-danger">
                                                            غير مقروءه <i class="fa fa-times"></i> </a>
                                                    @endif
                                                </td>
                                                <td>{{contactType()[$contact->type]}}</td>
                                            </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <a href="{{route('contact.index')}}" class="btn btn-default btn-default btn-flat">كل الرسايل</a>
                                </div>
                                <!-- /.box-footer -->
                            </div>
                        </div>




                    <div class="col-md-6">
                        <!-- USERS LIST -->
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">احدث الاعضاء المسجلين</h3>

                                <div class="box-tools pull-right">
                                    <span class="label label-danger">8 أعضاء</span>
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <ul class="users-list clearfix">
                                    @foreach($users->take(8)->orderBy('id', 'desc')->get() as $user)
                                        <li>
                                            <img src="admin/dist/img/user1-128x128.jpg" alt="{{$user->name}}">
                                            <a class="users-list-name"
                                               href="{{route('user.edit', $user->id)}}">{{$user->name}}</a>
                                            <span class="users-list-date">{{$user->created_at}}</span>
                                        </li>
                                    @endforeach

                                </ul>
                                <!-- /.users-list -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-center">
                                <a href="{{route('user.index')}}" class="uppercase">اظهر كل الاعضاء</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                        <!--/.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->


                <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-4">
                <!-- Info Boxes Style 2 -->

                <!-- PRODUCT LIST -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">أحدث العقارات المضافه</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            @foreach($aqars->take(10)->orderBy('id', 'desc')->get() as $aqar)
                                <li class="item">
                                    <div class="product-img pull-left">
                                        <img src="{{$aqar->image != null ? asset('images/'.$aqar->image) :
                                            asset('images/'.$settings->alternate_image)}}" alt="Product Image">
                                    </div>
                                    <div class="product-info pull-right" style="margin-right: 0">
                                        <a href="{{route('aqar.edit', $aqar->id)}}" class="product-title">{{$aqar->bu_name}}
                                            <span class="label label-warning pull-right">${{$aqar->bu_price}}</span>
                                        </a>

                                        <span class="product-description" style="white-space: normal">
                                               {{Str::limit($aqar->bu_small_disc, 60)}}
                                        </span>
                                    </div>
                                </li>
                        @endforeach
                        <!-- /.item -->

                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="{{url('adminpanel/aqar')}}" class="uppercase">عرض كل العقارات</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->


@endsection

@section('footer')
    <script>
        /* ChartJS
           * -------
           * Here we will create a few charts using ChartJS
       */

        // -----------------------
        // - MONTHLY SALES CHART -
        // -----------------------

        // Get context with jQuery - using jQuery's .get() method.
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas);

        var salesChartData = {
            labels: ['يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يوليو', 'اغسطس', 'سبتمبر', 'اكتوبر', 'نوفمبر', 'ديسمبر'],
            datasets: [
                {
                    label: 'Digital Goods',
                    fillColor: 'rgba(60,141,188,0.9)',
                    strokeColor: 'rgba(60,141,188,0.8)',
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [

                        @foreach($new as $chart)
                        @if(is_array($chart))
                        {{$chart['counting']}},
                        @else
                        {{$chart}},
                        @endif
                        @endforeach

                    ]
                },
            ]
        };

        /* jVector Maps
        * ------------
        * Create a world map with markers
        */

        $('#world-map-markers').vectorMap({
            map: 'world_mill_en',
            normalizeFunction: 'polynomial',
            hoverOpacity: 0.7,
            hoverColor: false,
            backgroundColor: 'transparent',
            regionStyle: {
                initial: {
                    fill: 'rgba(210, 214, 222, 1)',
                    'fill-opacity': 1,
                    stroke: 'none',
                    'stroke-width': 0,
                    'stroke-opacity': 1
                },
                hover: {
                    'fill-opacity': 0.7,
                    cursor: 'pointer'
                },
                selected: {
                    fill: 'yellow'
                },
                selectedHover: {}
            },
            markerStyle: {
                initial: {
                    fill: '#00a65a',
                    stroke: '#111'
                }
            },
            markers: [
                    @foreach($aqars->all() as $aqar)
                {
                    latLng: [{{ $aqar->bu_latitude }}, {{ $aqar->bu_latitude }}], name: '{{$aqar->bu_name}}'
                },
                @endforeach

            ]
        });


    </script>
@endsection
