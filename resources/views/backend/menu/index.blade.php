@extends('layouts.app')
@section('title')
 القوائم
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.css')}}">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto"> القوائم</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
		</div>
    </div>
    <a href="javascript:void(0);" class="btn btn-primary btn-sm "  data-toggle="modal" data-target="#createmenu">انشاء قائمة</a>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
<div class="card">
    <div class="card-header">القوائم</div>
    <div class="card-body">
        <table class="table text-center data-table">
          <thead>
              <tr>
                  <th>#</th>
                  <th>اسم القائمة</th>
                  <th>الحالة</th>
                  <th>الصلاحيات</th>
              </tr>
          </thead>
          <tbody></tbody>
        </table>
    </div>
  </div>
  <x-createmenu/>
  <x-editmenu/>
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
          ajax: "{{ route('menu.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'stat', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          language:
          {
            url:"{{asset('assets/js/arabic.json')}}" ,
          }
      });
   };
   $('#cmenu').submit(function (e) {
       e.preventDefault();
       var data=$('#cmenu').serialize();
      $.ajax({
          type: "post",
          url: "{{route('menu.store')}}",
          data: data,
          dataType: "json",
          success: function (response) {
            $('#createmenu').modal('toggle');
            $('.data-table').DataTable().ajax.reload();
          }
        });
   });
   $('#emenu').submit(function (e) {
       e.preventDefault();
      var data=$('#emenu').serialize();
      var id=$('#eid').val();
      $.ajax({
          type: "put",
          url: "{{route('menu.index')}}/"+id,
          data: data,
          dataType: "json",
          success: function (response) {
            $('#editmenu').modal('toggle');
            $('.data-table').DataTable().ajax.reload();
          }
      });
   });
   $('.data-table').on('click','.delete',function(){
     var id=$(this).attr('data-id');
     $.ajax({
       type: "delete",
       url: "{{route('menu.index')}}/"+id,
       dataType: "json",
       success: function (response) {
        $('.data-table').DataTable().ajax.reload();
       }
     });
   });
   $('.data-table').on('click','.editmenu',function()
   {
       $.ajax({
           type: "get",
           url: "{{route('menu.index')}}/"+$(this).attr('data-id'),
           dataType: "json",
           success: function (response) {
            $('#ename').val(response.data.name);
            $('#eid').val(response.data.id);
            $('#editmenu').modal('toggle');

           }
       });
   });
  </script>
@endsection
