@extends('layouts.app')
@section('title')
 العروض
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.css')}}">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto"> العروض</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
		</div>
	</div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
<div class="card">
    <div class="card-header">العروض</div>
    <div class="card-body">
        <table class="table text-center data-table">
          <thead>
              <tr>
                  <th>#</th>
                  <th>المنتج</th>
                  <th>نوع الخصم</th>
                  <th>قيمة الخصم</th>
                  <th>الرسالة</th>
                  <th>بداية العرض</th>
                  <th>نهاية العرض</th>
                  <th>الصلاحيات</th>
              </tr>
          </thead>
          <tbody></tbody>
        </table>
    </div>
  </div>
  <x-createoffer/>
  <x-editoffer/>
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
          ajax: "{{ route('offer.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'product_id', name: 'product_id'},
              {data: 'type', name: 'type'},
              {data: 'value', name: 'value'},
              {data: 'message', name: 'message'},
              {data: 'start_offer', name: 'start_offer'},
              {data: 'end_offer', name: 'end_offer'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          language:
          {
            url:"{{asset('assets/js/arabic.json')}}" ,
          }
      });
   };
   $('#eoffer').submit(function (e) {
       e.preventDefault();
      var data=$('#eoffer').serialize();
      var id=$('#eid').val();
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
   $('.data-table').on('click','.delete',function(){
     var id=$(this).attr('data-id');
     $.ajax({
       type: "delete",
       url: "{{route('offer.index')}}/"+id,
       dataType: "json",
       success: function (response) {
        $('.data-table').DataTable().ajax.reload();
       }
     });
   });
   $('.data-table').on('click','.editoffer',function()
   {
       $.ajax({
           type: "get",
           url: "{{route('offer.index')}}/"+$(this).attr('data-id'),
           dataType: "json",
           success: function (response) {
            $('#ename').val(response.data.name);
            $('#eid').val(response.data.id);
            $('#editoffer').modal('toggle');

           }
       });
   });
  </script>
@endsection

