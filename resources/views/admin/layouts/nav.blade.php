<ul class="sidebar-menu" data-widget="tree">

    <li class="header">
        اخر زياره بتاريخ
        {{auth()->user()->updated_at}}
    </li>

    {{-- users --}}

    <li><a href="{{url('/adminpanel')}}"><i class="fa fa-home"></i> <span>رئيسية التحكم</span></a></li>

    <li><a href="{{url(route('setting.index'))}}"><i class="fa fa-cog"></i> <span>اعدادت رئيسيه</span></a></li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i> <span>التحكم في الاعضاء</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href={{url(route('user.create'))}}><i class="fa fa-plus-square"></i> أضف عضو جديد</a></li>
            <li><a href={{url(route('user.index'))}}> <i class="fa fa-list-ul"></i> كل الاعضاء</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-building-o"></i> <span>التحكم في العقارات</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href={{url(route('aqar.create'))}}><i class="fa fa-plus-square"></i> أضف عقار جديد</a></li>
            <li><a href={{url('adminpanel/aqar')}}> <i class="fa fa-list"></i> كل العقارات</a></li>
        </ul>
    </li>

            <li><a href="{{url(route('contact.index'))}}"><i class="fa fa-envelope"></i> <span>رسائل الموقع</span></a></li>



    <li><a href="{{url('adminpanel/status')}}"><i class="fa fa-bar-chart"></i> <span>احصائيات اضافة العقارات</span></a></li>

</ul>
