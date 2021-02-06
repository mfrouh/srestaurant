@extends('layouts.app')
@section('title')
الصلاحيات
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.css')}}">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">الصلاحيات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
        </div>
    </div>
    <a href="javascript:void(0);" class="btn btn-primary btn-sm "  data-toggle="modal" data-target="#createpermission">انشاء صلاحية</a>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
<div class="card">
    <div class="card-header">الصلاحيات</div>
    <div class="card-body">
        <table class="table text-center data-table">
          <thead>
              <tr>
                  <th>#</th>
                  <th>اسم الصلاحية</th>
                  <th>الصلاحيات</th>
              </tr>
          </thead>
          <tbody></tbody>
        </table>
    </div>
  </div>
  <x-createpermission/>
  <x-editpermission/>
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
          ajax: "{{ route('permissions.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          language:
          {
            url:"{{asset('assets/js/arabic.json')}}" ,
          }
      });
   };
   $('#cpermission').submit(function (e) {
       e.preventDefault();
       var data=$('#cpermission').serialize();
      $.ajax({
          type: "post",
          url: "{{route('permissions.store')}}",
          data: data,
          dataType: "json",
          success: function (response) {
            $('#createpermission').modal('toggle');
            $('.data-table').DataTable().ajax.reload();
          }
        });
   });
   $('#epermission').submit(function (e) {
       e.preventDefault();
      var data=$('#epermission').serialize();
      var id=$('#eid').val();
      $.ajax({
          type: "put",
          url: "{{route('permissions.index')}}/"+id,
          data: data,
          dataType: "json",
          success: function (response) {
            $('#editpermission').modal('toggle');
            $('.data-table').DataTable().ajax.reload();
          }
      });
   });
   $('.data-table').on('click','.delete',function(){
     var id=$(this).attr('data-id');
     $.ajax({
       type: "delete",
       url: "{{route('permissions.index')}}/"+id,
       dataType: "json",
       success: function (response) {
        $('.data-table').DataTable().ajax.reload();
       }
     });
   });
   $('.data-table').on('click','.editpermission',function()
   {
       $.ajax({
           type: "get",
           url: "{{route('permissions.index')}}/"+$(this).attr('data-id'),
           dataType: "json",
           success: function (response) {
            $('#ename').val(response.data.name);
            $('#eid').val(response.data.id);
            $('#editpermission').modal('toggle');
           }
       });
   });
  </script>
@endsection
