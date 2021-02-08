@extends('layouts.app')
@section('title')
 المنتجات
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.css')}}">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">{{$product->name}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
        </div>
    </div>
  </div>
  <div class="productactions">
      <a href="javascript:void(0);" class="btn btn-primary btn-sm editproduct" data-id="{{$product->id}}">تعديل منتج</a>
      @if(!$product->offer)
      <a href="javascript:void(0);" class="btn btn-success btn-sm createoffer" data-id="{{$product->id}}">انشاء عرض</a>
      @endif
      @if($product->offer)
      <a href="javascript:void(0);" class="btn btn-pink btn-sm editoffer" data-id="{{$product->offer->id}}">تعديل عرض</a>
      <a href="javascript:void(0);" class="btn btn-secondary btn-sm canceloffer" data-id="{{$product->offer->id}}">الغاء عرض</a>
      @endif
  </div>

  <!-- breadcrumb -->
@endsection
@section('content')
<div class="container text-center">
    <img class="m-auto bx-border-circle" width="200px" height="200px" src="{{$product->image_path}}" alt="">
</div>
<div class="card">
  <div class="card-body">
      <div class="row">
          <div class="col-md-6">اسم المنتج</div>
          <div class="col-md-6">{{$product->name}}</div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-2">وصف المنتج</div>
        <div class="col-md-10">{{$product->description}}</div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">سعر المنتج</div>
        <div class="col-md-6">{{$product->price}} جنية</div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6"> سعر المنتج بعد العرض</div>
        <div class="col-md-6">{{$product->priceafteroffer}} جنية</div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6"> القسم</div>
        <div class="col-md-6">{{$product->category_name}} </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6"> القائمة</div>
        <div class="col-md-6">{{$product->menu_name}} </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">الكمية</div>
        <div class="col-md-6">{{$product->quantity}} </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">فيديو للمنتج</div>
        <div class="col-md-6">{{$product->video_url?$product->video_url:'لا يوجد فيديو للمنتج'}} </div>
      </div>
  </div>
</div>
<hr>
<h3>الخصائص</h3>
<a href="javascript:void(0);" class="btn btn-pink btn-sm createattribute" data-id="{{$product->id}}">انشاء خاصية</a>
  <x-editproduct :categories="$categories" :menus="$menus" />
  <x-createoffer />
  <x-editoffer />
@endsection
@section('js')
  <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     $('.productactions').on('click','.editproduct',function()
     {
         $.ajax({
             type: "get",
             url: "{{route('product.index')}}/"+$(this).attr('data-id'),
             dataType: "json",
             success: function (response) {
              $('#ename').val(response.data.name);
              $('#eid').val(response.data.id);
              $('#ecategory_id').val(response.data.category_id);
              $('#emenu_id').val(response.data.menu_id);
              $('#edescription').val(response.data.description);
              $('#eprice').val(response.data.price);
              $('#equantity').val(response.data.quantity);
              $('#evideo_url').val(response.data.video_url);
              $('#editproduct').modal('toggle');

             }
         });
     });
     $('.productactions').on('click','.createoffer',function()
     {
        $('#product_id').val($(this).attr('data-id'));
        $('#createoffer').modal('toggle');
     });
     $('.productactions').on('click','.editoffer',function()
     {
         $.ajax({
             type: "get",
             url: "{{route('offer.index')}}/"+$(this).attr('data-id'),
             dataType: "json",
             success: function (response) {
              $('#eend_offer').val(response.data.eend_offer);
              $('#estart_offer').val(response.data.sstart_offer);
              $('#evalue').val(response.data.value);
              $('#emessage').val(response.data.message);
              $('#etype').val(response.data.type);
              $('#e_id').val(response.data.id);
              $('#eproduct_id').val(response.data.product_id);
              $('#editoffer').modal('toggle');

             }
         });
     });
     $('.productactions').on('click','.canceloffer',function(){
      var id=$(this).attr('data-id');
      $.ajax({
       type: "delete",
       url: "{{route('offer.index')}}/"+id,
       dataType: "json",
       success: function (response) {
       // $('.data-table').DataTable().ajax.reload();
       }
      });
     });
     $('#eproduct').submit(function (e) {
         e.preventDefault();
        var data=$('#eproduct').serialize();
        var id=$('#eid').val();
        $.ajax({
            type: "put",
            url: "{{route('product.index')}}/"+id,
            data: data,
            dataType: "json",
            success: function (response) {
              $('#editproduct').modal('toggle');
              $('.data-table').DataTable().ajax.reload();
            }
        });
     });
     $('#coffer').submit(function (e) {
         e.preventDefault();
         var data = $('#coffer').serialize();
        $.ajax({
            type: "post",
            url: "{{route('offer.store')}}",
            data: data,
            dataType: "json",
            success: function (response) {
              $('#createoffer').modal('toggle');
              $('.data-table').DataTable().ajax.reload();
            }
          });
     });
     $('#eoffer').submit(function (e) {
         e.preventDefault();
        var data=$('#eoffer').serialize();
        var id=$('#e_id').val();
        $.ajax({
            type: "put",
            url: "{{route('offer.index')}}/"+id,
            data: data,
            dataType: "json",
            success: function (response) {
              $('#editoffer').modal('toggle');
              $('.data-table').DataTable().ajax.reload();
            }
        });
     });
 </script>
@endsection
