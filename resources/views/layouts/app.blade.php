<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! Html::style('website/css/bootstrap.min.css') !!}
    {!! Html::style('website/css/flexslider.css') !!}
    {!! Html::style('website/css/font-awesome.min.css') !!}
    {!! Html::script('website/js/jquery.min.js') !!}
    {!! Html::style('website/css/style.css') !!}
    {!! Html::style('Custom/select2/css/select2.min.css') !!}
    {!! Html::style('website/css/fonts.css') !!}
    <title>
        {{$settings->site_name}}
        |
        @yield('title') </title>
    <?php /* <ul class="dropdown-menu" role="menu">
        @foreach(aqar_type() as $key => $type)
            <li><a href=""></a>{{$type}}</li>
        @endforeach
    </ul>
*/?>
    @yield('header')


</head>
<body dir="rtl">

<div class="header">
    <div class="container"><a class="navbar-brand" href="{{url('/')}}"><i class="fa fa-paper-plane"></i> ONE</a>
        <ul class="menu pull-left"><a class="toggleMenu" href="#"><img src="{{asset('website/images/nav_icon.png')}}"
                                                                       alt=""/> </a>
            <ul class="nav" id="nav">
                <li class="{{setActive(['home', 'current'])}}"><a href="{{url('/home')}}"> الرئيسيه </a></li>
                <li class="{{setActive(['showAllBuilding', 'current'])}}"><a href="{{url('/showAllBuilding')}}"> كل
                        العقارات </a></li>
                <li><a href="#"> من نحن </a></li>
                <li class="nav-item dropdown {{setActive(['search', 'current'])}}">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ 'ايجار' }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            @foreach(aqar_type() as $key => $type)
                                <a style="text-indent: 4px"
                                   href="{{url('/search?bu_rent=1&bu_type='.$key)}}">{{$type}}</a>
                            @endforeach
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown {{setActive(['search', 'current'])}}">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ 'تمليك' }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            @foreach(aqar_type() as $key => $type)
                                <a style="text-indent: 4px"
                                   href="{{url('/search?bu_rent=0&bu_type='.$key)}}">{{$type}}</a>
                            @endforeach
                        </a>
                    </div>
                </li>
                <li class="{{setActive(['contact-us', 'current'])}}"><a href="{{url('contact-us')}}"> اتصل بنا </a></li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('تسجيل الدخول') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('تسجيل عضوية جديده') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>


                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            <li class="{{setActive(['user', 'edit-profile'])}}">
                                <a href="{{url('/user/edit-profile')}}">
                                    <i class="fa fa-edit"></i>
                                    تعديل المعلومات الشخصيه </a>
                            </li>
                            <li class="{{setActive(['user', 'building', 'show'])}}">
                                <a href="{{url('/user/building/show')}}">
                                    <i class="fa fa-check"></i>
                                    العقارات المفعله </a>
                            </li>

                            <li class="{{setActive(['user', 'building', 'waiting'])}}">
                                <a href="{{url('/user/building/waiting')}}">
                                    <i class="fa fa-clock-o"></i>
                                    عقارات في انتظار التفعيل </a>
                            </li>

                            <li class="{{setActive(['user', 'create', 'building'])}}">
                                <a href="{{url('/user/create/building')}}">
                                    <i class="fa fa-plus"></i>
                                    اضف عقار </a>
                            </li>


                            <li><a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>
                                    {{ __('تسجيل الخروج') }}
                                </a>
                            </li>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @endguest
                <div class="clear"></div>
            </ul>
        </ul>
    </div>
</div>

<main class="py-4">
    @include('layouts.flash_messages')
    @include('flash::message')
    @yield('content')

    <div class="footer">
        <div class="footer_bottom">
            <div class="follow-us">
                <a class="fa fa-facebook social-icon" target="_blank" href="{{$settings->facebook_link}}"></a>
                <a class="fa fa-twitter social-icon" target="_blank" href="{{$settings->twitter_link}}"></a>
                <a class="fa fa-github social-icon" target="_blank" href="{{$settings->github_link}}"></a>
            </div>
            <div class="copy">
                <p>{{$settings->copy_right}} &copy; {{date('Y')}} <a href="https://www.facebook.com/profile.php?id=100002010205743" rel="nofollow">Abdelzaher Muhammed</a>
                </p>
            </div>
        </div>
    </div>

    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>

    {!! Html::script('website/js/responsive-nav.js') !!}
    {!! Html::script('website/js/bootstrap.min.js') !!}
    {!! Html::script('website/js/jquery.flexslider.js') !!}
    {!! HTML::script('Custom/select2/js/select2.min.js') !!}


    @yield('footer')

</main>




</body>
</html>
@stack('select2')
