@extends('layouts.app')
@section('title')
 الطلبات
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.css')}}">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto"> الطلبات </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
		</div>
	</div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
<div class="card">
    <div class="card-header">الطلبات</div>
    <div class="card-body">
        <table class="table text-center data-table">
          <thead>
              <tr>
                  <th>#</th>
                  <th>نوع الطلب</th>
                  <th>حالة الطلب</th>
                  <th>السعر الكلي</th>
                  <th>الخصم</th>
                  <th>وقت الطلب</th>
                  <th>الصلاحيات</th>
              </tr>
          </thead>
          <tbody></tbody>
        </table>
    </div>
  </div>
  <x-orderdetails/>
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
          ajax: "{{ route('cashier.history') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'type_order', name: 'type'},
              {data: 'status_order', name: 'status'},
              {data: 'total_price', name: 'total_price'},
              {data: 'discount', name: 'discount'},
              {data: 'create', name: 'created_at'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          language:
          {
            url:"{{asset('assets/js/arabic.json')}}" ,
          }
      });
   };
   $(document).on('click','.details',function (e) {
       e.preventDefault();
       orderdetails($(this).attr('data-id'));
   });
   function orderdetails(id)
   {
    $.ajax({
        type: "post",
        url: "{{route('cashier.orderdetails')}}",
        data: {id:id},
        dataType: "json",
        success: function (response) {
             oneorder='';
             oneorder='<div class="row text-center"><div class="col-6 m-auto">المنتج</div><div class="col-3 m-auto">الكمية</div><div class="col-3 m-auto">الحالة</div></div>';
             response.details.forEach(element => {
                detail(element);
             });
            $('.orderd').html(oneorder);
            $('#orderdetails').modal('toggle');
        }
    });
   }
   function detail(el)
   {
    oneorder+=
    '<div class="row text-center">'+
       '<div class="col-3 m-auto"><img class="rounded-circle p-2" src="'+el.product.image_path+'" height="100px" width="100px"></div>'+
       '<div class="col-3 m-auto">'+el.name+'</div>'+
       '<div class="col-3 m-auto">'+el.quantity+'</div>'+
       '<div class="col-3 m-auto">'+el.status_order+'</div>'+
    '</div>';
   }
  </script>
@endsection
