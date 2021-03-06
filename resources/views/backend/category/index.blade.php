@extends('layouts.app')
@section('title')
 الاقسام
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.css')}}">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
            <h4 class="content-title mb-0 my-auto"> الاقسام</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
        </div>
    </div>
    @can('انشاء قسم')
      <a href="javascript:void(0);" class="btn btn-primary btn-sm "  data-toggle="modal" data-target="#createcategory">انشاء قسم</a>
    @endcan
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
<div class="card">
  <div class="card-header">الاقسام</div>
  <div class="card-body">
      <table class="table text-center data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>اسم القسم</th>
                <th>الحالة</th>
                <th>القسم الرائيسي</th>
                <th>الصلاحيات</th>
            </tr>
        </thead>
        <tbody></tbody>
      </table>
  </div>
</div>
@can('انشاء قسم')
  <x-createcategory/>
@endcan
@can('تعديل قسم')
  <x-editcategory />
@endcan

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
          ajax: "{{ route('category.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'stat', name: 'status'},
              {data: 'parent_id', name: 'parent_id'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          language:
          {
            url:"{{asset('assets/js/arabic.json')}}" ,
          }
      });
   };
   $('#ccategory').submit(function (e) {
       e.preventDefault();
       var data=$('#ccategory').serialize();
      $.ajax({
          type: "post",
          url: "{{route('category.store')}}",
          data: data,
          dataType: "json",
          success: function (response) {
            $('#createcategory').modal('toggle');
            $('.data-table').DataTable().ajax.reload();
          }
        });
   });
   $('#ecategory').submit(function (e) {
       e.preventDefault();
      var data=$('#ecategory').serialize();
      var id=$('#eid').val();
      $.ajax({
          type: "put",
          url: "{{route('category.index')}}/"+id,
          data: data,
          dataType: "json",
          success: function (response) {
            $('#editcategory').modal('toggle');
            $('.data-table').DataTable().ajax.reload();
          }
      });
   });
   $('.data-table').on('click','.delete',function(){
     var id=$(this).attr('data-id');
     $.ajax({
       type: "delete",
       url: "{{route('category.index')}}/"+id,
       dataType: "json",
       success: function (response) {
        $('.data-table').DataTable().ajax.reload();
       }
     });
   });
   $('.data-table').on('click','.editcategory',function()
   {
       $.ajax({
           type: "get",
           url: "{{route('category.index')}}/"+$(this).attr('data-id'),
           dataType: "json",
           success: function (response) {
            $('#ename').val(response.data.name);
            $('#eid').val(response.data.id);
            $('#editcategory').modal('toggle');

           }
       });
   });
   $('.data-table').on('click','.changestatus',function()
   {
       $.ajax({
           type: "post",
           url: "{{route('category.index')}}/status",
           dataType: "json",
           data:{id:$(this).attr('data-id')},
           success: function (response) {
            $('.data-table').DataTable().ajax.reload();

           }
       });
   });
  </script>
@endsection
