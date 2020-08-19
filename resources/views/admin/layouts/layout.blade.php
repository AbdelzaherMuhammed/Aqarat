<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        لوحة تحكم
        {{$settings->site_name}}
        |
        @yield('title')
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
{!! Html::style('admin/plugins/bootstrap/dist/css/bootstrap.min.css') !!}

<!-- Font Awesome -->
{!! Html::style('admin/plugins/font-awesome/css/font-awesome.min.css') !!}

{!! Html::style('Custom/select2/css/select2.min.css') !!}

<!-- Ionicons -->
{!! Html::style('admin/plugins/Ionicons/css/ionicons.min.css') !!}
<!-- jvectormap -->
{!! Html::style('admin/dist/css/jquery-jvectormap.css') !!}


{!! Html::style('Custom/sweetalert2.css') !!}

<!-- Theme style -->


    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->


{!! Html::style('admin/dist/css/AdminLTE-rtl.css') !!}
{!! Html::style('admin/dist/css/skins/_all-skins-rtl.min.css') !!}





<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @yield('header')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{url('adminpanel')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b> لوحة تحكم الموقع</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">{{countWaitingAqars()->count()}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">يوجد عدد {{countWaitingAqars()->count()}} عقار في انتظار التفعيل</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    @foreach(countWaitingAqars()->get() as $aqarWaiting)
                                    <li>
                                        <a href="{{url('adminpanel/change-aqar-status',$aqarWaiting->id)}}" class="pull-left">
                                            <span>
                                                تفعيل العقار
                                            </span>
                                        </a>
                                        <a href="{{route('aqar.edit', $aqarWaiting->id)}}" class="pull-right">
                                            <span>
                                                 {{$aqarWaiting->bu_name}}
                                            </span>
                                        </a>
                                        <div class="clearfix"></div>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">{{countUnreadMessages()}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">لديك {{countUnreadMessages()}} رساله غير مقروءه</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="dropdown-menu">
                                    <li class="header">لديك {{countUnreadMessages()}} رساله غير مقروءه</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            @foreach(unReadMessage() as $valueMessage)
                                                <li><!-- Task item -->
                                                    <a href="{{route('contact.edit', $valueMessage->id)}}">
                                                        <h3>
                                                            {{$valueMessage->name}}
                                                            <small class="pull-right">{{$valueMessage->created_at}}</small>
                                                        </h3>
                                                        <p class="pull-right">
                                                            {{\Illuminate\Support\Str::limit($valueMessage->message, 10)}}
                                                        </p>

                                                    </a>
                                                </li>
                                                <!-- end task item -->
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="footer">
                                        <a href="{{route('contact.index')}}">اظهار كل الرسائل</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="{{route('contact.index')}}">اظهار كل الرسائل</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="user-image"
                                 alt="User Image">
                            <span class="hidden-xs">{{auth()->user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle"
                                     alt="User Image">

                                <p>
                                    {{auth()->user()->name}}
                                    <small>عضو منذ {{auth()->user()->created_at}}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{route('user.edit', auth()->user()->id)}}" class="btn btn-default btn-flat">الملف الشخصي</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{url('/logout')}}" class="btn btn-default btn-flat">تسجيل الخروج</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-right image">
                    <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{auth()->user()->name}}</p>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->

            @include('admin.layouts.nav')
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @yield('title')
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('adminpanel')}}"><i class="fa fa-home"></i> الرئيسيه</a></li>
                <li class="active">@yield('title')</li>
            </ol>
        </section>

        @yield('content')

    </div>
    <!-- Content Wrapper. Contains page content -->


    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.18
        </div>
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-user bg-yellow"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Other sets of options are available
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

{!! HTML::script('admin/plugins/jquery/dist/jquery.min.js') !!}
<!-- Bootstrap 3.3.7 -->
{!! HTML::script('admin/plugins/bootstrap/dist/js/bootstrap.min.js') !!}
<!-- FastClick -->
{!! HTML::script('admin/plugins/fastclick/lib/fastclick.js') !!}
<!-- AdminLTE App -->
{!! HTML::script('admin/dist/js/adminlte.min.js') !!}
<!-- Sparkline -->
{!! HTML::script('admin/plugins/jquery/dist/jquery.sparkline.min.js') !!}
<!-- jvectormap  -->
{!! HTML::script('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') !!}
{!! HTML::script('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') !!}
<!-- SlimScroll -->
{!! HTML::script('admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
<!-- ChartJS -->
{!! HTML::script('admin/plugins/chart.js/Chart.js') !!}
<!-- AdminLTE for demo purposes -->
{!! HTML::script('admin/dist/js/pages/dashboard2.js') !!}

{!! HTML::script('admin/dist/js/demo.js') !!}

{!! HTML::script('Custom/sweetalert2.min.js') !!}

{!! HTML::script('Custom/select2/js/select2.min.js') !!}

@include('admin.layouts.flash_messages')

<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    })
</script>
@yield('footer')
</body>
</html>
