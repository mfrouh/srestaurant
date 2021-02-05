@extends('layouts.app')
@section('title')
 الخصومات
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.css')}}">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto"> الخصومات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
		</div>
    </div>
    <a href="javascript:void(0);" class="btn btn-primary btn-sm "  data-toggle="modal" data-target="#createcoupon">انشاء خصم</a>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
<div class="card">
    <div class="card-header">الخصومات</div>
    <div class="card-body">
        <table class="table text-center data-table">
          <thead>
              <tr>
                  <th>#</th>
                  <th>الكود</th>
                  <th>بداية الخصم</th>
                  <th>نهاية الخصم</th>
                  <th>نوع الخصم</th>
                  <th>قيمة الخصم</th>
                  <th>عدد المرات</th>
                  <th>الصلاحيات</th>
              </tr>
          </thead>
          <tbody></tbody>
        </table>
    </div>
  </div>
<x-createcoupon/>
<x-editcoupon />
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
          ajax: "{{ route('coupon.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'code', name: 'code'},
              {data: 'start', name: 'start'},
              {data: 'end', name: 'end'},
              {data: 'type', name: 'type'},
              {data: 'value', name: 'value'},
              {data: 'times', name: 'times'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          language:
          {
            url:"{{asset('assets/js/arabic.json')}}" ,
          }
      });
   };
   $('#ccoupon').submit(function (e) {
       e.preventDefault();
       var data=$('#ccoupon').serialize();
      $.ajax({
          type: "post",
          url: "{{route('coupon.store')}}",
          data: data,
          dataType: "json",
          success: function (response) {
            $('#createcoupon').modal('toggle');
            $('.data-table').DataTable().ajax.reload();
          }
        });
   });
   $('#ecoupon').submit(function (e) {
       e.preventDefault();
      var data=$('#ecoupon').serialize();
      var id=$('#eid').val();
      $.ajax({
          type: "put",
          url: "{{route('coupon.index')}}/"+id,
          data: data,
          dataType: "json",
          success: function (response) {
            $('#editcoupon').modal('toggle');
            $('.data-table').DataTable().ajax.reload();
          }
      });
   });
   $('.data-table').on('click','.delete',function(){
     var id=$(this).attr('data-id');
     $.ajax({
       type: "delete",
       url: "{{route('coupon.index')}}/"+id,
       dataType: "json",
       success: function (response) {
        $('.data-table').DataTable().ajax.reload();
       }
     });
   });
   $('.data-table').on('click','.editcoupon',function()
   {
       $.ajax({
           type: "get",
           url: "{{route('coupon.index')}}/"+$(this).attr('data-id'),
           dataType: "json",
           success: function (response) {
            $('#ecode').val(response.data.code);
            $('#emessage').val(response.data.message);
            $('#evalue').val(response.data.value);
            $('#eid').val(response.data.id);
            $('#editcoupon').modal('toggle');
           }
       });
   });
  </script>
@endsection
