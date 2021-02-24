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
                  <th>رقم الطلب</th>
                  <th>اسم المنتج</th>
                  <th>حالة الطلب</th>
                  <th>الكمية</th>
                  <th>نوع المنتج</th>
                  <th>السعر الكلي</th>
                  <th>وقت الطلب</th>
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
          ajax: "{{ route('chefkitchen.history') }}",
          columns: [
              {data: 'order.id', name: 'id'},
              {data: 'product.name', name: 'name'},
              {data: 'status_order', name: 'status'},
              {data: 'quantity', name: 'quantity'},
              {data: 'variant_id', name: 'variant_id'},
              {data: 'total_price', name: 'total_price'},
              {data: 'order.create', name: 'created_at'},
          ],
          language:
          {
            url:"{{asset('assets/js/arabic.json')}}" ,
          }
      });
   };
  </script>
@endsection
