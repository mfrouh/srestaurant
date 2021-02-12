@extends('layouts.app')
@section('title')
كاشير
@endsection
@section('css')
  <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">كاشير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
        </div>
    </div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 col-xl-8">
         <div class="card">
           <div class="card-body">
               <form class="row" id="search">
                   <div class="form-group col-4">
                       <input type="text" name="product" id="searchvalue" class="form-control" placeholder="اسم المنتج">
                       <small class="text-muted"></small>
                   </div>
                   <div class="form-group col-3">
                        <select name="category_id[]" id="category_id" class="select2"  multiple="multiple">
                            @foreach ($categories as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <small class="text-muted"></small>
                   </div>
                   <div class="form-group col-3">
                        <select name="menu_id[]" id="menu_id" class="select2" multiple>
                            @foreach ($menus as $menu)
                               <option value="{{$menu->id}}">{{$menu->name}}</option>
                            @endforeach
                        </select>
                        <small class="text-muted"></small>
                   </div>
                   <div class="form-group col-2 text-center">
                        <input type='submit' id="searchnow" class="btn btn-primary-gradient" value="ابحث">
                   </div>
               </form>
           </div>
         </div>
        <div class="row products">

        </div>
    </div>
    <div class="col-md-12 col-xl-4">
        <div class="card ">
          <div class="card-header text-center bg-primary-gradient">الطلب</div>
          <div class="card-body order">
          </div>
        </div>
    </div>
</div>
@endsection
@section('js')
  <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
  <script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!--Internal Sumoselect js-->
<script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
  <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#search').submit(function (e) {
        e.preventDefault();
        var data=$(this).serialize();
        $.ajax({
            type: "get",
            url: "{{route('cashier')}}",
            data:data,
            dataType: "json",
            success: function (response) {
               products='';
               response.forEach(el => {product(el);});
               $('.products').html(products);
            }
        });
    });

    cashier();getorders();

    function cashier()
    {
        $.ajax({
            type: "get",
            url: "{{route('cashier')}}",
            dataType: "json",
            success: function (response) {
               products='';
               response.forEach(el => {product(el);});
               $('.products').html(products);
            }
        });
    }

    $(document).on('click','.addtocard',function(){
        createorder($(this).attr('data-id'));
    });

    $(document).on('click','.delete',function(){
        var el=$(this);
        $(this).addClass('disabled');
        deleteorder($(this).attr('data-id'));
    });

    $(document).on('click','.ordernow',function(){
        type='inrestaurant';
        payment_type='cash';
        created_by={{auth()->id()}};
        total_price=$('#totalprice').attr('data-id');
        var el=$(this);
        $(this).addClass('disabled');
        $.ajax({
            type: "post",
            url: "{{route('order.store')}}",
            data:{type:type,payment_type:payment_type,created_by:created_by,total_price:total_price},
            dataType: "json",
            success: function (response) {
                getorders();
                el.removeClass('disabled');
            }
        });
    });

    function getorders()
    {
        $.ajax({
            type: "get",
            url: "{{route('cashier.order')}}",
            dataType: "json",
            success: function (response) {
             orders='';
             if (response.content.length!=0) {
             orders+='<div class="row text-center"><div class="col-3">المنتج</div><div class="col-3">السعر</div><div class="col-3">الكمية</div><div class="col-3">#</div></div><hr>';
             response.content.forEach(element => {
                    order(element);
             });
             orders+='<hr><div class="row text-center"><div class="col-6">المجموع</div><div class="col-6" id="totalprice" data-id="'+response.total+'">'+response.total+' جنية </div></div>';
             orders+='<hr><div class="row text-center"><a href="javascript:void(0);" class="btn btn-info-gradient col-12 ordernow">اطلب الان</a></div>';
             }
             else
             {
                orders+='<div class="row text-center"><p class="col-12 text-center">لا يوجد منتجات في السالة</p></div>';
             }
             $('.order').html(orders);
            }
        });
    }

    function createorder(id)
    {
        $.ajax({
            type: "get",
            url: "{{route('cashier.createorder')}}",
            data:{id:id},
            dataType: "json",
            success: function (response) {
                getorders();
            }
        });
    }

    function deleteorder(id)
    {
        $.ajax({
            type: "delete",
            url: "{{route('cashier.order')}}/"+id,
            data:{id:id},
            dataType: "json",
            success: function (response) {
                getorders();
                el.removeClass('disabled');
            }
        });
    }

    function product(el)
    {
      products+=
      ' <div class="col-xl-3 col-md-4 col-sm-6">'+
      '<div class="card">'+
        '<img class="card-img-top" height="200px" src="'+el.image_path+'">'+
        '<div class="card-body">'+
         ' <h6 class="card-title text-right">'+el.name+'</h6>'+
         '<span>'+el.priceafteroffer+' جنية</span>'+
          '<a class="btn btn-pink-gradient btn-sm addtocard float-left" href="javascript:void(0)" data-id="'+el.id+'"><i class="fa fa-plus"></i></a>'+
        '</div>'+
     ' </div>'+
     '</div>';
    }

    function order(el)
    {
      orders+=
      '<div class="row">'+
         '<div class="col-3 p-2">'+
            '<img class="rounded-circle" src="'+el.image_path+'">'+
          '</div>'+
          '<div class="col-3 p-2 m-auto text-center">'+ el.price+'</div>'+
          '<div class="col-3 p-2 m-auto text-center">'+ el.quantity+'</div>'+
          '<div class="col-3 p-2 m-auto text-center">'+
            '<a class="btn btn-danger btn-sm delete" href="javascript:void(0)" data-id="'+el.id+'"><i class="fa fa-trash"></i></a>'+
          '</div>'+
      '</div>';
    }
 </script>
@endsection
