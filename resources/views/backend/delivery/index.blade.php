@extends('layouts.app')
@section('title')
    التوصيل للمنازل
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">التوصيل للمنازل</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
        </div>
    </div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
          <div class="card-header  bg-success-gradient text-center">طلبات للمنازل</div>
          <div class="card-body orders">
          </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-success-gradient text-center">التفاصيل</div>
            <div class="card-body details"></div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click','.showdetails',function(){var id=$(this).attr('data-id'); details(id);});
    $(document).on('click','.startorder',function(){var id=$(this).attr('data-id'); storder(id);});
    getorders();
    function getorders()
    {
      $.ajax({
          type: "get",
          url: "{{route('delivery')}}",
          dataType: "json",
          success: function (response) {
            orders='';
            order='';
            response.forEach(element => {
              oneorder(element);
            });
            allorders();
            $('.orders').html(orders);
          }
      });
    }
    function details(id)
    {
        localStorage.setItem('detailsid',id);
      $.ajax({
          type: "post",
          url: "{{route('delivery.orderdetails')}}",
          data:{id:id},
          dataType: "json",
          success: function (response) {
            adetails=''; detail='';;
            response.details.forEach(element => {
                onedetail(element);
            });
            alldetails();
            $('.details').html(adetails);
          }
      });
    }
    function storder(id)
    {
      $.ajax({
          type: "post",
          url: "{{route('delivery.startdeliveryorder')}}",
          data:{id:id},
          dataType: "json",
          success: function (response) {
            getorders();
          }
      });
    }
    function allorders()
    {
      orders+=
         '<table class="table text-center">'+
           '<thead>'+
             '<th>رقم الطلب</th>'+
             '<th>عنوان الطلب</th>'+
             '<th>شارع الطلب</th>'+
             '<th>معلومات عن الطلب</th>'+
             '<th>بداية التوصيل</th>'+
             '<th>تسليم الطلب</th>'+
             '<th>التفاصيل</th>'+
           '</thead>'+
             '<tbody>'+order+'</tbody>'+
         '</table>';
    }
    function oneorder(el)
    {
      order+=
       '<tr>'+
        '<td>'+el.id+'</td>'+
        '<td>'+el.address.address+'</td>'+
        '<td>'+el.address.street+'</td>'+
        '<td>'+el.note_for_driver+'</td>'+
        '<td><a href="javascript:void(0);" class="btn btn-danger-gradient btn-sm startorder" data-id="'+el.id+'">بداية التوصيل</a></td>'+
        '<td><a href="javascript:void(0);" class="btn btn-primary-gradient btn-sm deliveryorder" data-id="'+el.id+'">تسليم الطلب</a></td>'+
        '<td><a href="javascript:void(0);" class="btn btn-success-gradient btn-sm showdetails" data-id="'+el.id+'">التفاصيل</a></td></tr>';
    }
    function alldetails()
    {
        adetails+=
         '<table class="table text-center">'+
           '<thead>'+
             '<th>المنتج</th>'+
             '<th>الكمية</th>'+
           '</thead>'+
             '<tbody>'+detail+'</tbody>'+
         '</table>';
    }
    function onedetail(el)
    {
       detail+='<tr class="'+status+'"><td>'+el.name+'</td><td>'+el.quantity+'</td></tr>';
    }
</script>
@endsection
