@extends('layouts.app')
@section('title')
    الرئيسية
@endsection
@section('page-header')
	<div class="breadcrumb-header justify-content-between">
		<div class="left-content">
			<div>
			  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> أهلا {{auth()->user()->name}}</h2>
			</div>
		</div>
	</div>
@endsection
@section('content')
<div class="row row-sm">
    @if (auth()->user()->HasRole('كاشير'))
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-warning">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الحالية</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$ccashierorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-success-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات اليوم</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$dcashierorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-danger-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الاسبوع</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$wcashierorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-primary-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الشهر</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$mcashierorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-info-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات السنة</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$ycashierorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
    @endif
    @if (auth()->user()->HasRole('مشرف في المطبخ'))
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-warning">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الحالية</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$csuperkitchenorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-success-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات اليوم</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$dsuperkitchenorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-danger-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الاسبوع</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$wsuperkitchenorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-primary-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الشهر</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$msuperkitchenorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-info-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات السنة</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$ysuperkitchenorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
    @endif
    @if (auth()->user()->HasRole('مشرف عمال التوصيل'))
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-warning">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الحالية</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$csuperdeliveryorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-success-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات اليوم</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$dsuperdeliveryorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-danger-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الاسبوع</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$wsuperdeliveryorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-primary-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الشهر</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$msuperdeliveryorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-info-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات السنة</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$ysuperdeliveryorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
    @endif
    @if (auth()->user()->HasRole('عامل توصيل'))
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-warning">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الحالية</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$cdeliveryorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-success-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات اليوم</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$ddeliveryorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-danger-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الاسبوع</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$wdeliveryorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-primary-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الشهر</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$mdeliveryorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-info-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات السنة</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$ydeliveryorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
      </div>
    @endif
    @if (auth()->user()->HasRole('طباخ'))
       <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-warning">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الحالية</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$ccheforders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
       </div>
       <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-success-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات اليوم</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$dcheforders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
       </div>
       <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-danger-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الاسبوع</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$wcheforders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
       </div>
       <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-primary-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الشهر</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$mcheforders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
       </div>
       <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-info-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات السنة</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$ycheforders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
       </div>
    @endif
    @can('الاقسام')
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-primary-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الاقسام</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 ml-5 text-white">{{$categories}}</h4>
                        </div>
                        <div class="">
							<h4 class="tx-20 font-weight-bold mb-1 mr-5 ml-5 text-dark">{{$actcategories}}</h4>
                        </div>
                        <div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-danger">{{$inactcategories}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    @endcan
    @can('المنتجات')
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-success-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد المنتجات</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 ml-5 text-white">{{$products}}</h4>
                        </div>
                        <div class="">
							<h4 class="tx-20 font-weight-bold mb-1 mr-5 ml-5 text-dark">{{$actproducts}}</h4>
						</div>
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-danger">{{$inactproducts}}</h4>
						</div>

					</div>
				</div>
			</div>
		</div>
    </div>
    @endcan
    @can('القوائم')
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-success">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد القوائم</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 ml-5 text-white">{{$menus}}</h4>
                        </div>
                        <div class="">
							<h4 class="tx-20 font-weight-bold mb-1 mr-5 ml-5 text-dark">{{$actmenus}}</h4>
						</div>
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-danger">{{$inactmenus}}</h4>
						</div>

					</div>
				</div>
			</div>
		</div>
    </div>
    @endcan
    @can('المستخدمين')
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-warning-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد المستخدمين</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$users}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    @endcan
    @can('الموظفين')
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-warning">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد موظفي الكاشير</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$cashiers}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-success">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد عمال التوصيل</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$deliveries}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-danger">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد العمال في المطبخ</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$chefs}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-secondary-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد المشرفين علي المطبخ</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$superchefs}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-warning-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد المشرفين علي عمال التوصيل</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$superdeliveries}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    @endcan
    @can('الأراء')
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-primary-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الأراء</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$reviews}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    @endcan
    @can('الصلاحيات')
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-purple-gradient ">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الصلاحيات</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$permissions}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    @endcan
    @can('الوظائف')
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-info-gradient ">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الوظائف</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$roles}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    @endcan
    @can('الطلبات')
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-success ">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الحالية</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$corders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-secondary ">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات الكلي</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$orders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-warning ">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white"> عدد الطلبات الكلي من المطعم</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$inrestorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-primary ">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white"> عدد الطلبات الكلي من التوصيل للمنازل</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$dlorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-success-gradient ">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white"> عدد الطلبات الكلي من الوجبات الجاهزة</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$tkorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-pink ">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white"> عدد الطلبات التي لم تطبخ بعد  </h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$pendingorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-primary-gradient ">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white"> عدد الطلبات التي تطبخ الان  </h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$processingorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-danger-gradient ">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white"> عدد الطلبات التي تحتاج الي التوصيل  </h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$endprocessingorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-purple-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">  عدد الطلبات التي في مرحلة التوصيل الان  </h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$deliveryorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-success ">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">  عدد الطلبات التي اكتملت  </h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$completedorders}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    @endcan
    @can('الخصومات')
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-info-gradient ">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white"> الخصومات</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$coupons}}</h4>
                        </div>
                        <div class="">
							<h4 class="tx-20 font-weight-bold mb-1 mr-5 ml-5 text-dark">{{$actcoupons}}</h4>
                        </div>
                        <div class="">
							<h4 class="tx-20 font-weight-bold mb-1  text-danger">{{$inactcoupons}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    @endcan
    @can('العروض')
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-pink-gradient ">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white"> العروض</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$offers}}</h4>
                        </div>
                        <div class="">
							<h4 class="tx-20 font-weight-bold mb-1 mr-5 ml-5 text-success">{{$actoffers}}</h4>
                        </div>
                        <div class="">
							<h4 class="tx-20 font-weight-bold mb-1  text-dark">{{$inactoffers}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    @endcan
</div>
<div class="row">
    @can('الاقسام')
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">({{$categories}}) الاقسام</div>
            <div class="card-body">
                <canvas id="categories"></canvas>
            </div>
        </div>
    </div>
    @endcan
    @can('المنتجات')
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">({{$products}}) المنتجات</div>
            <div class="card-body">
                <canvas id="products"></canvas>
            </div>
        </div>
    </div>
    @endcan
    @can('القوائم')
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">({{$menus}}) القوائم</div>
            <div class="card-body">
                <canvas id="menus"></canvas>
            </div>
        </div>
    </div>
    @endcan
    @can('العروض')
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">({{$offers}}) العروض</div>
            <div class="card-body">
                <canvas id="offers"></canvas>
            </div>
        </div>
    </div>
    @endcan
    @can('الخصومات')
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">({{$coupons}}) الخصومات</div>
            <div class="card-body">
                <canvas id="coupons"></canvas>
            </div>
        </div>
    </div>
    @endcan
    @can('الطلبات')
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">({{$orders}})  انواع الطلبات</div>
            <div class="card-body">
                <canvas id="typeorders"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">({{$orders}})  حالات الطلبات</div>
            <div class="card-body">
                <canvas id="statusorders"></canvas>
            </div>
        </div>
    </div>
    @endcan
</div>
  </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
@can('الاقسام')
var ctx1 = document.getElementById('categories').getContext('2d');
var chart1 = new Chart(ctx1, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: ['الاقسام المغلقة', 'الاقسام المتاحة'],
        datasets: [{
            label: 'الاقسام',
            backgroundColor:['red','green'],
            borderColor: 'rgb(255, 255, 255)',
            data: [{{$inactcategories}}, {{$actcategories}}]
        }]
    },

    // Configuration options go here
    options: {
        animation: {
            duration:2000// general animation time
        },
        legend: {
            labels: {
                // This more specific font property overrides the global property
                fontColor: 'black',
                fontFamily:"'Lalezar', 'cursive'",
                fontSize:15,
            }
        }
    }
});
@endcan

@can('المنتجات')
var ctx2 = document.getElementById('products').getContext('2d');
var chart2 = new Chart(ctx2, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: ['المنتجات المغلقة', 'المنتجات المتاحة'],
        datasets: [{
            label: 'المنتجات',
            backgroundColor:['red','green'],
            borderColor: 'rgb(255, 255, 255)',
            data: [{{$inactproducts}}, {{$actproducts}}]
        }]
    },

    // Configuration options go here
    options: {
        legend: {
            labels: {
                // This more specific font property overrides the global property
                fontColor: 'black',
                fontFamily:"'Lalezar', 'cursive'",
                fontSize:15,
            }
        }
    }
});
@endcan

@can('العروض')
var ctx3 = document.getElementById('offers').getContext('2d');
var chart3 = new Chart(ctx3, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: ['العروض المغلقة', 'العروض المتاحة'],
        datasets: [{
            label: 'العروض',
            backgroundColor:['red','green'],
            borderColor: 'rgb(255, 255, 255)',
            data: [{{$inactoffers}}, {{$actoffers}}]
        }]
    },

    // Configuration options go here
    options: {
        legend: {
            labels: {
                // This more specific font property overrides the global property
                fontColor: 'black',
                fontFamily:"'Lalezar', 'cursive'",
                fontSize:15,
            }
        }
    }
});
@endcan

@can('الخصومات')
var ctx4 = document.getElementById('coupons').getContext('2d');
var chart4 = new Chart(ctx4, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: ['الخصومات المغلقة', 'الخصومات المتاحة'],
        datasets: [{
            label: 'الخصومات',
            backgroundColor:['red','green'],
            borderColor: 'rgb(255, 255, 255)',
            data: [{{$inactcoupons}}, {{$actcoupons}}]
        }]
    },

    // Configuration options go here
    options: {
        legend: {
            labels: {
                // This more specific font property overrides the global property
                fontColor: 'black',
                fontFamily:"'Lalezar', 'cursive'",
                fontSize:15,
            }
        }
    }
});
@endcan

@can('القوائم')
var ctx5 = document.getElementById('menus').getContext('2d');
var chart5 = new Chart(ctx5, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: ['القوائم المغلقة', 'القوائم المتاحة'],
        datasets: [{
            label: 'القوائم',
            backgroundColor:['red','green'],
            borderColor: 'rgb(255, 255, 255)',
            data: [{{$inactmenus}}, {{$actmenus}}]
        }]
    },

    // Configuration options go here
    options: {
        legend: {
            labels: {
                // This more specific font property overrides the global property
                fontColor: 'black',
                fontFamily:"'Lalezar', 'cursive'",
                fontSize:15,
            }
        }
    }
});
@endcan
@can('الطلبات')
var ctx6 = document.getElementById('typeorders').getContext('2d');
var chart6 = new Chart(ctx6, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: ['من المطعم', 'التوصيل للمنازل','الوجبات الجاهزة'],
        datasets: [{
            label: 'الطلبات',
            backgroundColor:['pink','blue','yellow'],
            borderColor: 'rgb(255, 255, 255)',
            data: [{{$inrestorders}}, {{$dlorders}},{{$tkorders}}]
        }]
    },

    // Configuration options go here
    options: {
        legend: {
            labels: {
                // This more specific font property overrides the global property
                fontColor: 'black',
                fontFamily:"'Lalezar', 'cursive'",
                fontSize:15,
            }
        }
    }
});
var ctx7 = document.getElementById('statusorders').getContext('2d');
var chart7 = new Chart(ctx7, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: ['لم تطبخ بعد','يطبخ الان','اكتمال الطبخ','في الطريق','اكتمال الطلب'],
        datasets: [{
            label: 'الطلبات',
            backgroundColor:['yellow','red','pink','green','blue'],
            borderColor: 'rgb(255, 255, 255)',
            data: [{{$pendingorders}}, {{$processingorders}},{{$endprocessingorders}},{{$deliveryorders}},{{$completedorders}}]
        }]
    },

    // Configuration options go here
    options: {
        legend: {
            labels: {
                // This more specific font property overrides the global property
                fontColor: 'black',
                fontFamily:"'Lalezar', 'cursive'",
                fontSize:15,
            }
        }
    }
});
@endcan

</script>
@endsection
