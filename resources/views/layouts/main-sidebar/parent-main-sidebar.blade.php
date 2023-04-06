<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <li>
            <a href="{{ route('dashboard.parents') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>
        <li>
            <a href="{{route('sons.index')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">الابناء</span></a>
        </li>
        <li>
            <a href="{{route('sons.attendances')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">تقرير الحضور والغياب</span></a>
        </li>
        <li>
            <a href="{{route('sons.fees')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">تقرير المالية</span></a>
        </li>
        <li>
            <a href="{{route('profile.show.parent')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">الملف الشخصي</span></a>
        </li>
    </ul>
</div>