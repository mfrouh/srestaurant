@extends('layouts.app')
@section('title')
 الموظفين
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.css')}}">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
            <h4 class="content-title mb-0 my-auto"> الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
        </div>
    </div>
    @can('انشاء موظف')
      <a href="javascript:void(0);" class="btn btn-primary btn-sm "  data-toggle="modal" data-target="#createemployee">انشاء موظف</a>
    @endcan
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
<div class="card">
  <div class="card-header">الموظفين</div>
  <div class="card-body">
      <table class="table text-center data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>اسم الموظف</th>
                <th>البريد الالكتروني</th>
                <th>الصلاحيات</th>
            </tr>
        </thead>
        <tbody></tbody>
      </table>
  </div>
</div>
@can('انشاء موظف')
  <x-createemployee/>
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
          ajax: "{{ route('employee.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          language:
          {
            url:"{{asset('assets/js/arabic.json')}}" ,
          }
      });
   };
   $('#cemployee').submit(function (e) {
       e.preventDefault();
       var data=$('#cemployee').serialize();
      $.ajax({
          type: "post",
          url: "{{route('employee.store')}}",
          data: data,
          dataType: "json",
          success: function (response) {
            $('#createemployee').modal('toggle');
            $('.data-table').DataTable().ajax.reload();
          }
        });
   });
   $('.data-table').on('click','.delete',function(){
     var id=$(this).attr('data-id');
     $.ajax({
       type: "delete",
       url: "{{route('employee.index')}}/"+id,
       dataType: "json",
       success: function (response) {
        $('.data-table').DataTable().ajax.reload();
       }
     });
   });
   getroles();
   function getroles()
   {
       $.ajax({
           type: "get",
           url: "{{route('employee.roles')}}",
           dataType: "json",
           success: function (response) {
               roles='';
               response.forEach(element => {
                   roles+= '<label class="btn btn-light m-1" >'+
                        '<input type="radio" name="role" value="'+element+'">'+element+'</label>';
               });

            $('.roles').html(roles);
           }
       });
   }
  </script>
@endsection
