@extends('layouts.app')
@section('title')
الوظائف
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.css')}}">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">الوظائف</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
        </div>
    </div>
    <a href="javascript:void(0);" class="btn btn-primary btn-sm "  data-toggle="modal" data-target="#createrole">انشاء وظيفة</a>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
<div class="card">
    <div class="card-header">الوظائف</div>
    <div class="card-body">
        <table class="table text-center data-table">
          <thead>
              <tr>
                  <th>#</th>
                  <th>اسم الوظيفة</th>
                  <th>الصلاحيات</th>
              </tr>
          </thead>
          <tbody></tbody>
        </table>
    </div>
  </div>
  <x-createrole/>
  <x-editrole/>
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
          ajax: "{{ route('roles.index') }}",
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
   $('#crole').submit(function (e) {
       e.preventDefault();
       var data=$('#crole').serialize();
      $.ajax({
          type: "post",
          url: "{{route('roles.store')}}",
          data: data,
          dataType: "json",
          success: function (response) {
            $('#createrole').modal('toggle');
            $('.data-table').DataTable().ajax.reload();
          }
        });
   });
   $('#erole').submit(function (e) {
       e.preventDefault();
      var data=$('#erole').serialize();
      var id=$('#eid').val();
      $.ajax({
          type: "put",
          url: "{{route('roles.index')}}/"+id,
          data: data,
          dataType: "json",
          success: function (response) {
            $('#editrole').modal('toggle');
            $('.data-table').DataTable().ajax.reload();
          }
      });
   });
   $('.data-table').on('click','.delete',function(){
     var id=$(this).attr('data-id');
     $.ajax({
       type: "delete",
       url: "{{route('roles.index')}}/"+id,
       dataType: "json",
       success: function (response) {
        $('.data-table').DataTable().ajax.reload();
       }
     });
   });
   $('.data-table').on('click','.editrole',function()
   {
       $.ajax({
           type: "get",
           url: "{{route('roles.index')}}/"+$(this).attr('data-id'),
           dataType: "json",
           success: function (response) {
            $('#ename').val(response.data.name);
            $('#eid').val(response.data.id);
            $('#editrole').modal('toggle');
           }
       });
   });
  </script>
@endsection
