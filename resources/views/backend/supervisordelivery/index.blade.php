@extends('layouts.app')
@section('title')
التوصيل للمنازل
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
			<h4 class="content-title mb-0 my-auto">التوصيل للمنازل</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
        </div>
    </div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 col-xl-8">
        <div class="card">
            <div class="card-header bg-warning-gradient text-center">طلبات تحت الاعداد</div>
            <div class="card-body orders"></div>
        </div>
    </div>
    <div class="col-md-12 col-xl-4">
       <div class="card">
           <div class="card-header bg-success-gradient text-center">العمال</div>
           <div class="card-body deliverys"></div>
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
    $(document).on('change','.selectdelivery',function(){var id=$(this).attr('data-id'); var delivery=$(this).val();selectdeliverytoorder(delivery,id);});
    $(document).on('click','.getdelivery',function(){var id=$(this).attr('data-id');getdeliverytoorder(id);});
    function getorders()
    {
      $.ajax({
          type: "get",
          url: "{{route('superdelivery')}}",
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
    function getdeliverytoorder(id)
    {
      $.ajax({
          type: "post",
          url: "{{route('superdelivery.deliverys')}}",
          dataType: "json",
          data:{id:id},
          success: function (response) {
            deliverys='';
            response.deliverys.forEach(element => {
              getdeliverys(response.order,element);
            });
            $('.deliverys').html(deliverys);
          }
      });
    }
    function selectdeliverytoorder(delivery,id)
    {
      $.ajax({
          type: "post",
          url: "{{route('superdelivery.selectdelivery')}}",
          data:{delivery:delivery,id:id},
          dataType: "json",
          success: function (response) {
            allorders();
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
             '<th>اختيار السائق</th>'+
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
        '<td><a href="javascript:void(0);" class="btn btn-success-gradient btn-sm getdelivery" data-id="'+el.id+'">اختيار السائق</a></td></tr>';
    }
    function checkselected(selected,sel)
    {
     if (selected==sel) {
          return 'selected';
     }
    }
    function getdeliverys(ch,el)
    {
        selected=''; if(ch.delivery_by==el.id){selected='checked';}

        deliverys+='<div class="row m-3"><input class="selectdelivery m-2" name="one" type="checkbox" data-id="'+ch.id+'" value="'+el.id+'" '+selected+'>'+el.name+'</div>';
    }
</script>
@endsection
