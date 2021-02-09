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
<a href="javascript:void(0);" class="btn btn-pink btn-sm createattribute m-2" data-id="{{$product->id}}">انشاء خاصية</a>
<div class="row attributes"></div>
<h3>الانواع</h3>
<a href="javascript:void(0);" class="btn btn-secondary btn-sm createvariant m-2" data-id="{{$product->id}}">انشاء نوع</a>
<div class="row variants"></div>
  <x-editproduct :categories="$categories" :menus="$menus" />
  <x-createoffer />
  <x-editoffer />
  <x-createattribute />
  <x-editattribute />
  <x-createvalue />
  <x-editvalue />
  <x-createvariant :attribute="$product->attributes" />
  <x-editvariant />
@endsection
@section('js')
  <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    getvariants();
    getattributes();
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
     $(document).on('click','.createattribute',function()
     {
        $('#aproduct_id').val($(this).attr('data-id'));
        $('#createattribute').modal('toggle');
     });
     $(document).on('click','.editattribute',function()
     {
         $.ajax({
             type: "get",
             url: "{{route('attribute.index')}}/"+$(this).attr('data-id'),
             dataType: "json",
             success: function (response) {
              $('#eaname').val(response.data.name);
              $('#eaid').val(response.data.id);
              $('#eaproduct_id').val(response.data.product_id);
              $('#editattribute').modal('toggle');

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
       }
      });
     });
     $(document).on('click','.createvalue',function()
     {
        $('#vattribute_id').val($(this).attr('data-id'));
        $('#createvalue').modal('toggle');
     });
     $(document).on('click','.editvalue',function()
     {
         $.ajax({
             type: "get",
             url: "{{route('value.index')}}/"+$(this).attr('data-id'),
             dataType: "json",
             success: function (response) {
              $('#evvalue').val(response.data.value);
              $('#evid').val(response.data.id);
              $('#evattribute_id').val(response.data.attribute_id);
              $('#editvalue').modal('toggle');

             }
         });
     });
     $('.productactions').on('click','.deletevalue',function(){
      var id=$(this).attr('data-id');
      $.ajax({
       type: "delete",
       url: "{{route('value.index')}}/"+id,
       dataType: "json",
       success: function (response) {
       }
      });
     });
     $(document).on('click','.createvariant',function()
     {
        $('#vproduct_id').val($(this).attr('data-id'));
        $('#createvariant').modal('toggle');
     });
     $(document).on('click','.editvariant',function()
     {
         $.ajax({
             type: "get",
             url: "{{route('variant.index')}}/"+$(this).attr('data-id'),
             dataType: "json",
             success: function (response) {
              $('#evvariant').val(response.data.variant);
              $('#evid').val(response.data.id);
              $('#evattribute_id').val(response.data.attribute_id);
              $('#editvariant').modal('toggle');

             }
         });
     });
     $('.productactions').on('click','.deletevariant',function(){
      var id=$(this).attr('data-id');
      $.ajax({
       type: "delete",
       url: "{{route('variant.index')}}/"+id,
       dataType: "json",
       success: function (response) {
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
            }
        });
     });
     $('#cattribute').submit(function (e) {
         e.preventDefault();
         var data = $('#cattribute').serialize();
        $.ajax({
            type: "post",
            url: "{{route('attribute.store')}}",
            data: data,
            dataType: "json",
            success: function (response) {
                getattributes();
                getvariants();
              $('#createattribute').modal('toggle');
            }
          });
     });
     $('#eattribute').submit(function (e) {
         e.preventDefault();
        var data=$('#eattribute').serialize();
        var id=$('#eaid').val();
        $.ajax({
            type: "put",
            url: "{{route('attribute.index')}}/"+id,
            data: data,
            dataType: "json",
            success: function (response) {
                getattributes();
                getvariants();
              $('#editattribute').modal('toggle');

            }
        });
     });
     $(document).on('click','.deleteattribute',function(){
      var id=$(this).attr('data-id');
      $.ajax({
       type: "delete",
       url: "{{route('attribute.index')}}/"+id,
       dataType: "json",
       success: function (response) {
        getattributes();
       }
      });
     });
     $('#cvalue').submit(function (e) {
         e.preventDefault();
         var data = $('#cvalue').serialize();
        $.ajax({
            type: "post",
            url: "{{route('value.store')}}",
            data: data,
            dataType: "json",
            success: function (response) {
                getattributes();
                getvariants();
              $('#createvalue').modal('toggle');
            }
          });
     });
     $('#edvalue').submit(function (e) {
         e.preventDefault();
        var data=$('#edvalue').serialize();
        var id=$('#evid').val();
        $.ajax({
            type: "put",
            url: "{{route('value.index')}}/"+id,
            data: data,
            dataType: "json",
            success: function (response) {
                getattributes();
                getvariants();
              $('#editvalue').modal('toggle');

            }
        });
     });
     $(document).on('click','.deletevalue',function(){
      var id=$(this).attr('data-id');
      $.ajax({
       type: "delete",
       url: "{{route('value.index')}}/"+id,
       dataType: "json",
       success: function (response) {
        getattributes();
        getvariants();
       }
      });
     });
     $('#cvariant').submit(function (e) {
         e.preventDefault();
         var data = $('#cvariant').serialize();
        $.ajax({
            type: "post",
            url: "{{route('variant.store')}}",
            data: data,
            dataType: "json",
            success: function (response) {
                getattributes();
                getvariants();
              $('#createvariant').modal('toggle');
            }
          });
     });
     $('#edvariant').submit(function (e) {
         e.preventDefault();
        var data=$('#edvariant').serialize();
        var id=$('#evid').val();
        $.ajax({
            type: "put",
            url: "{{route('variant.index')}}/"+id,
            data: data,
            dataType: "json",
            success: function (response) {
                getattributes();
                getvariants();
              $('#editvariant').modal('toggle');

            }
        });
     });
     $(document).on('click','.deletevariant',function(){
      var id=$(this).attr('data-id');
      $.ajax({
       type: "delete",
       url: "{{route('variant.index')}}/"+id,
       dataType: "json",
       success: function (response) {
        getvariants();
       }
      });
     });
    function getattributes()
    {
          var product_id =$('.editproduct').attr('data-id');
        $.ajax({
            type: "get",
            url: "{{route('attribute.index')}}",
            data:{product_id,product_id},
            dataType: "json",
            success: function (response) {
               attributes='';
               response.forEach(el => {
                   values='';
                   el.values.forEach(element => {value(element)});
                   attribute(el);
                   });
               $('.attributes').html(attributes);
            }
        });
    }
    function getvariants()
    {
        var product_id =$('.editproduct').attr('data-id');
        $.ajax({
            type: "get",
            url: "{{route('variant.index')}}",
            data:{product_id,product_id},
            dataType: "json",
            success: function (response) {
               variants='';va='';
               response.forEach(el => {
                valuesvar='';
                el.values.forEach(ele => {valuesv(ele);});
                variant(el);
               });
               tablevariants();
               $('.variants').html(variants);
            }
        });
    }
    function attribute(el)
    {
      attributes+=
      '<div class="col-xl-3 col-md-4 col-sm-6">'+
        '<div class="card">'+
          '<div class="card-header">'+el.name+'<a class="btn btn-danger btn-sm float-left m-1 deleteattribute" href="javascript:void(0)" data-id="'+el.id+'">'+
            '<i class="fa fa-trash"></i></a>'+
            '<a class="btn btn-primary btn-sm float-left m-1 editattribute" href="javascript:void(0)" data-id="'+el.id+'"><i class="fa fa-edit"></i></a>'+
          '</div>'+
          '<div class="card-body">'+values+'</div>'+
          '<div class="card-footer text-center"><a class="btn btn-primary btn-sm createvalue" href="javascript:void(0);" data-id="'+el.id+'">انشاء قيمة</a></div>'+
       '</div>'+
     '</div>';
    }
    function value(el)
    {
        values+=
        '<div class="row m-1">'+
          '<div class="col-6">'+el.value+'</div>'+
          '<div class="col-6"><a class="btn btn-danger btn-sm float-left m-1 deletevalue" href="javascript:void(0)" data-id="'+el.id+'"><i class="fa fa-trash"></i></a>'+
           '<a class="btn btn-primary btn-sm float-left m-1  editvalue" href="javascript:void(0)" data-id="'+el.id+'"><i class="fa fa-edit"></i></a>'+
          '</div>'+
        '</div>';
    }
    function variant(el)
    {
        va+= '<tr>'+
             '<td>'+el.id+'</td>'+
             '<td>'+valuesvar+'</td>'+
             '<td>'+el.price+'</td>'+
             '<td>'+el.quantity+'</td>'+
             '<td><a class="btn btn-danger btn-sm m-1 deletevariant" href="javascript:void(0)" data-id="'+el.id+'"><i class="fa fa-trash"></i></a></td>'+
            '</tr>';
    }
    function tablevariants()
    {
        variants+=
        '<div class="card col-12">'+
            '<div class="card-body">'+
                  '<table class="table text-center">'+
                     '<thead>'+
                        '<tr>'+
                         '<th>#</th>'+
                         '<th>القيم</th>'+
                         '<th>السعر</th>'+
                         '<th>الكمية</th>'+
                         '<th>#</th>'+
                        '</tr>'+
                     '</thead>'+
                     '<tbody>'+va+'</tbody>'+
                  '</table>'+
            '</div>'+
        '</div>';
    }
    function valuesv(el)
    {
        valuesvar+=el.value+'_';
    }
 </script>
@endsection
