<!-- main-header opened -->
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="responsive-logo">
                            @php
                               $setting=App\Models\Setting::first();
                            @endphp
							<a href="{{ url('/') }}"><img src="{{URL::asset($setting->logo)}}" class="logo-1" alt="logo"></a>
							<a href="{{ url('/') }}"><img src="{{URL::asset($setting->logo)}}" class="dark-logo-1" alt="logo"></a>
							<a href="{{ url('/') }}"><img src="{{URL::asset($setting->logo)}}" class="logo-2" alt="logo"></a>
							<a href="{{ url('/') }}"><img src="{{URL::asset($setting->logo)}}" class="dark-logo-2" alt="logo"></a>
						</div>
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
					</div>
					<div class="main-header-right">
						<div class="nav nav-item  navbar-nav-right ml-auto">
							<div class="dropdown nav-item main-header-notification">
								<a class="new nav-link" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class=" pulse"></span></a>
								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">التنبهات</h6>
										</div>
										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">لديك {{auth()->user()->unreadnotifications->count()}} تنبهات لم تقراء</p>
									</div>
									<div class="main-notification-list Notification-scroll">
                                        @forelse (auth()->user()->notifications as $notification)
										<a class="d-flex p-3 border-bottom" href="#">
											<div class="notifyimg bg-pink">
												<i class="la la-file-alt text-white"></i>
											</div>
											<div class="mr-3">
												<h5 class="notification-label mb-1">{{$notification['data']['content']}}</h5>
												<div class="notification-subtext">{{$notification['created_at']->format('d-m  h:m A')}}</div>
											</div>
											<div class="mr-auto" >
												<i class="fa fa-markdown text-left text-muted"></i>
											</div>
                                        </a>
                                        @empty
                                        <a class=" p-3 border-bottom text-center">
                                            <div class=" text-center">
                                                لا يوجد تنبهات
                                            </div>
                                        </a>
                                        @endforelse
									</div>
									<div class="dropdown-footer">
										<a href="">عرض الكل</a>
									</div>
								</div>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset(auth()->user()->image)}}"></a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user"><img alt="" src="{{URL::asset(auth()->user()->image)}}" class=""></div>
											<div class="mr-3 my-auto">
												<h6>{{auth()->user()->name}}</h6>
											</div>
										</div>
									</div>
									<a class="dropdown-item" href="{{route('dashboard.index')}}"><i class="bx bx-user-circle"></i>الرئيسية</a>
									<a class="dropdown-item" href="{{route('change-password.index')}}"><i class="bx bx-cog"></i> تغير كلمة السر</a>
									<a class="dropdown-item" href="{{route('profile-setting.index')}}"><i class="bx bx-slider-alt"></i> الاعدادات</a>
									<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="bx bx-log-out"></i> تسجيل خروج
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- /main-header -->
