@extends('layouts.app')
@section('title')
    الرئيسية
@endsection
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="left-content">
			<div>
			  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> أهلا {{auth()->user()->name}}</h2>
			</div>
		</div>
	</div>
	<!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->
<div class="row row-sm">
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
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-secondary ">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">عدد الطلبات</h6>
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
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">({{$categories}}) الاقسام</div>
            <div class="card-body">
                <canvas id="categories"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">({{$products}}) المنتجات</div>
            <div class="card-body">
                <canvas id="products"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">({{$menus}}) القوائم</div>
            <div class="card-body">
                <canvas id="menus"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">({{$offers}}) العروض</div>
            <div class="card-body">
                <canvas id="offers"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">({{$coupons}}) الخصومات</div>
            <div class="card-body">
                <canvas id="coupons"></canvas>
            </div>
        </div>
    </div>
</div>
  </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
var ctx1 = document.getElementById('categories').getContext('2d');
var ctx2 = document.getElementById('products').getContext('2d');
var ctx3 = document.getElementById('offers').getContext('2d');
var ctx4 = document.getElementById('coupons').getContext('2d');
var ctx5 = document.getElementById('menus').getContext('2d');

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
</script>
@endsection
