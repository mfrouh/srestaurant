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
			<h4 class="content-title mb-0 my-auto"> المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
        </div>
    </div>
    <a href="javascript:void(0);" class="btn btn-primary btn-sm "  data-toggle="modal" data-target="#createproduct">انشاء منتج</a>
  </div>

  <!-- breadcrumb -->
@endsection
@section('content')
<div class="card">
    <div class="card-header">المنتجات</div>
    <div class="card-body">
        <table class="table text-center data-table">
          <thead>
              <tr>
                {{-- 'category_id','menu_id','name','description','price','status','slug','sku','image','video_url','quantity' --}}
                  <th>#</th>
                  <th>اسم المنتج</th>
                  <th>القسم</th>
                  <th>القائمة</th>
                  <th>الحالة</th>
                  <th>السعر</th>
                  <th>الكمية</th>
                  <th>الصلاحيات</th>
              </tr>
          </thead>
          <tbody></tbody>
        </table>
    </div>
  </div>
  <x-createproduct/>
  <x-editproduct />
  @endsection
  @section('js')
  <script type="text/javascript" charset="utf8" src="{{asset('js/datatables.js')}}"></script>
  <script type="text/javascript">
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      datatable();
     function datatable() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'category_name', name: 'category_id'},
                {data: 'menu_name', name: 'menu_id'},
                {data: 'stat', name: 'status'},
                {data: 'price', name: 'price'},
                {data: 'quantity', name: 'quantity'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            language:
            {
              url:"{{asset('assets/js/arabic.json')}}" ,
            }
        });
     };
     $('#cproduct').submit(function (e) {
         e.preventDefault();
         var data=$('#cproduct').serialize();
        $.ajax({
            type: "post",
            url: "{{route('product.store')}}",
            data: data,
            dataType: "json",
            success: function (response) {
              $('#createproduct').modal('toggle');
              $('.data-table').DataTable().ajax.reload();
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
     $('.data-table').on('click','.delete',function(){
       var id=$(this).attr('data-id');
       $.ajax({
         type: "delete",
         url: "{{route('product.index')}}/"+id,
         dataType: "json",
         success: function (response) {
          $('.data-table').DataTable().ajax.reload();
         }
       });
     });
     $('.data-table').on('click','.editproduct',function()
     {
         $.ajax({
             type: "get",
             url: "{{route('product.index')}}/"+$(this).attr('data-id'),
             dataType: "json",
             success: function (response) {
              $('#ename').val(response.data.name);
              $('#eid').val(response.data.id);
              $('#editproduct').modal('toggle');

             }
         });
     });
    </script>
  @endsection
