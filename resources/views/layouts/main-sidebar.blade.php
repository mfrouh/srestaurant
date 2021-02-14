<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
                @php
                    $setting=App\Models\Setting::first();
                @endphp
				<a class="desktop-logo logo-light active" href="{{ url('/') }}"><img src="{{URL::asset($setting->logo)}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img class="avatar avatar-xl brround" src="{{URL::asset(auth()->user()->image)}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{auth()->user()->name}}</h4>
						</div>
					</div>
				</div>
				<ul class="side-menu">
                    @can('الرئيسية')
					<li class="slide">
						<a class="side-menu__item" href="{{ route('dashboard.index') }}"><span class="side-menu__label">الرئيسية</a>
                    </li>
                    @endcan
                    @can('الوظائف')
                    <li class="slide">
					    <a class="side-menu__item" href="{{ route('roles.index') }}"><span class="side-menu__label">الوظائف</a>
                    </li>
                    @endcan
                    @can('الصلاحيات')
                    <li class="slide">
					    <a class="side-menu__item" href="{{ route('permissions.index') }}"><span class="side-menu__label">الصلاحيات</a>
                    </li>
                    @endcan
                    @can('الاقسام')
                    <li class="slide">
					    <a class="side-menu__item" href="{{ route('category.index' ) }}"><span class="side-menu__label">الاقسام</a>
                    </li>
                    @endcan
                    @can('القوائم')
                    <li class="slide">
						<a class="side-menu__item" href="{{ route('menu.index' ) }}"><span class="side-menu__label">القوائم</a>
					</li>
                    @endcan
                    @can('كاشير')
                    <li class="slide">
						<a class="side-menu__item" href="{{ route('cashier' ) }}"><span class="side-menu__label">كاشير</a>
					</li>
                    @endcan
                    @can('المطبخ')
                    <li class="slide">
						<a class="side-menu__item" href="{{ route('kitchen' ) }}"><span class="side-menu__label">المطبخ</a>
					</li>
                    @endcan
                    @can('المنتجات')
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('product.index' ) }}"><span class="side-menu__label">المنتجات</a>
                    </li>
                    @endcan
                    @can('الخصومات')
                    <li class="slide">
					    <a class="side-menu__item" href="{{ route('coupon.index' ) }}"><span class="side-menu__label">الخصومات</a>
                    </li>
                    @endcan
                    @can('العروض')
                    <li class="slide">
						<a class="side-menu__item" href="{{ route('offer.index' ) }}"><span class="side-menu__label">العروض</a>
                    </li>
                    @endcan
                    @can('الطلبات')
                    <li class="slide">
						<a class="side-menu__item" href="{{ route('order.index' ) }}"><span class="side-menu__label">الطلبات</a>
                    </li>
                    @endcan
                    @can('كلمات لها علاقة')
                    <li class="slide">
						<a class="side-menu__item" href="{{ route('tag.index' ) }}"><span class="side-menu__label">كلمات لها علاقة</a>
                    </li>
                    @endcan
                    @can('الأراء')
                    <li class="slide">
						<a class="side-menu__item" href="{{ route('review.index' ) }}"><span class="side-menu__label">الأراء</a>
                    </li>
                    @endcan
					@can('اعدادات الموقع')
					<li class="slide">
						<a class="side-menu__item" href="{{ route('setting.index' ) }}"><span class="side-menu__label">الاعدادات</a>
					</li>
					@endcan
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
