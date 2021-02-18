@extends('layouts.app')
@section('title')
المطبخ
@endsection
@section('css')
  <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto">المطبخ</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
        </div>
    </div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header bg-warning-gradient text-center">طلبات تحت الاعداد</div>
            <div class="card-body orders"></div>
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
    getorders();
    $(document).on('change','.changestatusdetails',function(){var id=$(this).attr('data-id'); var status=$(this).val();changeorderdetails(status,id);});
    function getorders()
    {
      $.ajax({
          type: "get",
          url: "{{route('chefkitchen')}}",
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
    function changeorderdetails(status,id)
    {
      $.ajax({
          type: "post",
          url: "{{route('chefkitchen.changeorderdetails')}}",
          data:{status:status,id:id},
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
             '<th>اسم المنتج</th>'+
             '<th>نوع الطلب</th>'+
             '<th>حالة الطلب</th>'+
             '<th>كمية الطلب</th>'+
             '<th>التفاصيل</th>'+
           '</thead>'+
             '<tbody>'+order+'</tbody>'+
         '</table>';
    }
    function oneorder(el)
    {
      var status='';
      if (el.status=="Prepare") { status='bg-warning';} if (el.status=="Completed") { status='bg-primary';}
      order+=
       '<tr class="'+status+'">'+
        '<td>'+el.order.id+'</td>'+
        '<td>'+el.product.name+'</td>'+
        '<td>'+el.order.type_order+'</td>'+
        '<td>'+
          '<select class="form-control changestatusdetails" data-id="'+el.id+'">'+
              '<option value="Pending" '+checkselected('Pending',el.status)+'>لم يطهي بعد</option>'+
              '<option value="Prepare" '+checkselected('Prepare',el.status)+'>يطهي الان</option>'+
              '<option value="Completed" '+checkselected('Completed',el.status)+'>اكتمل الطهي</option>'+
          '</select>'+
        '</td>'+
        '<td>'+el.quantity+'</td>'+
        '<td></td></tr>';
    }
    function checkselected(selected,sel)
    {
     if (selected==sel) {
          return 'selected';
     }
    }
</script>
@endsection
