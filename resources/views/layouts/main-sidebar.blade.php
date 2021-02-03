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
					<li class="slide">
						<a class="side-menu__item" href="{{ route('dashboard.index') }}"><span class="side-menu__label">الرئيسية</a>
                    </li>
                   {{--  @can('الوظائف')  --}}
                    <li class="slide">
					     	<a class="side-menu__item" href="{{ route('roles.index') }}"><span class="side-menu__label">الوظائف</a>
                    </li>

                    {{--  @can('الصلاحيات')  --}}
                    <li class="slide">
					     	<a class="side-menu__item" href="{{ route('permissions.index') }}"><span class="side-menu__label">الصلاحيات</a>
                    </li>
                    {{--  @endcan  --}}
					<li class="slide">
                        <a class="side-menu__item" href="#" data-toggle="slide"><span class="side-menu__label">المستخدمين</span><i class="angle fe fe-chevron-down"></i></a>
                        <ul class="slide-menu">
                            {{-- @can('المستخدمين') --}}
					        <li>
                               <a class="side-menu__item"  href="{{ url('/users') }}"><span class="side-menu__label">المستخدمين</a>
					        </li>
                            {{-- @endcan
                            @can('الموظفين') --}}
					        <li>
                               <a class="side-menu__item"  href="{{ url('/employee') }}"><span class="side-menu__label">الموظفين</a>
					        </li>
                            {{-- @endcan
                            @can('انشاء موظف') --}}
					        <li>
                               <a class="side-menu__item"  href="{{ url('/employee/create') }}"><span class="side-menu__label">انشاء موظف</a>
					        </li>
					        {{-- @endcan --}}

                        </ul>
                    </li>
                    {{--  @can('الاقسام')  --}}
                    <li class="slide">
					       	<a class="side-menu__item" href="{{ route('category.index' ) }}"><span class="side-menu__label">الاقسام</a>
                    </li>
                    {{--  @endcan  --}}
                    <li class="slide">
						<a class="side-menu__item" href="{{ route('menu.index' ) }}"><span class="side-menu__label">القوائم</a>
					</li>
                     {{--  @can('المنتجات')  --}}
                    <li class="slide">
                        <a class="side-menu__item" href="{{ route('product.index' ) }}"><span class="side-menu__label">المنتجات</a>
                    </li>
                    <li class="slide">
					    <a class="side-menu__item" href="{{ route('coupon.index' ) }}"><span class="side-menu__label">الخصومات</a>
                    </li>
                    <li class="slide">
						<a class="side-menu__item" href="{{ route('offer.index' ) }}"><span class="side-menu__label">العروض</a>
                    </li>
                    <li class="slide">
						<a class="side-menu__item" href="{{ route('order.index' ) }}"><span class="side-menu__label">الطلبات</a>
                    </li>
                    <li class="slide">
						<a class="side-menu__item" href="{{ route('tag.index' ) }}"><span class="side-menu__label">كلمات لها علاقة</a>
                    </li>
                    <li class="slide">
						<a class="side-menu__item" href="{{ route('review.index' ) }}"><span class="side-menu__label">الأراء</a>
                    </li>
                    {{--  @endcan  --}}
					{{--  @can('تعديل الموقع')  --}}
					<li class="slide">
						<a class="side-menu__item" href="{{ route('setting.index' ) }}"><span class="side-menu__label">الاعدادات</a>
					</li>
					{{--  @endcan  --}}
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
