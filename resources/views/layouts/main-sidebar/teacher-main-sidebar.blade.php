<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <li>
            <a href="{{ url('/teacher/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>
        <li>
            <a href="{{url('sections')}}"><i class="fas fa-chalkboard"></i><span
                    class="right-nav-text">الاقسام</span></a>
        </li>
        <li>
            <a href="{{url('student')}}"><i class="fas fa-user-graduate"></i><span
                    class="right-nav-text">الطلاب</span></a>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">الاختبارات</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{url('quiz')}}">قائمة الاختبارات</a></li>
                {{-- <li><a href="#">قائمة الاسئلة</a></li> --}}
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                <div class="pull-left"><i class="fas fa-video"></i><span class="right-nav-text">{{trans('main_trans.Onlineclasses')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{url('online_zoom_classes')}}">حصص اونلاين مع زوم</a> </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu1">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">التقارير</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu1" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('attendance.report')}}">تقرير الحضور والغياب</a></li>
                {{-- <li><a href="#">تقرير الامتحانات</a></li> --}}
            </ul>
        </li>
        <li>
            <a href="{{route('profile.show')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">الملف الشخصي</span></a>
        </li>
    </ul>
</div>
