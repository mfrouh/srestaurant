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
    <div class="col-md-12 col-xl-6">
        <div class="card">
            <div class="card-header bg-warning-gradient text-center">طلبات تحت الاعداد</div>
            <div class="card-body orders"></div>
        </div>
    </div>
    <div class="col-md-12 col-xl-6">
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
    getorders();
    $(document).on('click','.showdetails',function(){var id=$(this).attr('data-id'); details(id);});
    $(document).on('change','.changestatusorder',function(){var id=$(this).attr('data-id'); changeorder(id); });
    // $(document).on('change','.changestatusdetails',function(){var id=$(this).attr('data-id'); var status=$(this).val();changeorderdetails(status,id);});
    $(document).on('change','.selectchef',function(){var id=$(this).attr('data-id'); var chef=$(this).val();selectcheftoorder(chef,id);});
    function getorders()
    {
      $.ajax({
          type: "get",
          url: "{{route('kitchen')}}",
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
          url: "{{route('kitchen.orderdetails')}}",
          data:{id:id},
          dataType: "json",
          success: function (response) {
            adetails=''; detail='';chefs='';
            response.details.forEach(element => {
                chefs='';
                response.chefs.forEach(el => {
                 getchefs(element.created_by,el);
                });
                onedetail(element);
            });
            alldetails();
            $('.details').html(adetails);
          }
      });
    }
    function selectcheftoorder(chef,id)
    {
      $.ajax({
          type: "post",
          url: "{{route('kitchen.selectchef')}}",
          data:{chef:chef,id:id},
          dataType: "json",
          success: function (response) {
            details(localStorage.getItem('detailsid'));
          }
      });
    }
    function changeorder(id)
    {
      $.ajax({
          type: "post",
          url: "{{route('kitchen.changeorder')}}",
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
             '<th>نوع الطلب</th>'+
             '<th>حالة الطلب</th>'+
             '<th>هل اكتمل الطلب</th>'+
             '<th>التفاصيل</th>'+
           '</thead>'+
             '<tbody>'+order+'</tbody>'+
         '</table>';
    }
    function oneorder(el)
    {
      var status='';
      if (el.status=="Processing") { status='bg-warning';} if (el.status=="EndProcessing") { status='bg-primary';}
      order+=
       '<tr class="'+status+'">'+
        '<td>'+el.id+'</td>'+
        '<td>'+el.type_order+'</td><td>'+
        '<div class="progress">'+
         '<div class="progress-bar" style="width:'+el.status_order_complete+'%">'+el.status_order_complete+'%</div>'+
        '</div></td>'+
        '<td>'+
        '<input type="checkbox" class="changestatusorder" data-id="'+el.id+'">'+
        '</td>'+
        '<td><a href="javascript:void(0);" class="btn btn-success-gradient btn-sm showdetails" data-id="'+el.id+'">التفاصيل</a></td></tr>';
    }
    function checkselected(selected,sel)
    {
     if (selected==sel) {
          return 'selected';
     }
    }
    function alldetails()
    {
        adetails+=
         '<table class="table text-center">'+
           '<thead>'+
             '<th>المنتج</th>'+
             '<th>الكمية</th>'+
             '<th>الحالة</th>'+
             '<th>اختيار الطباخ</th>'+
           '</thead>'+
             '<tbody>'+detail+'</tbody>'+
         '</table>';
    }
    function onedetail(el)
    {
        var status='';
      if (el.status=="Prepare") { status='bg-warning';}
      if (el.status=="Completed") { status='bg-primary';}
       detail+='<tr class="'+status+'"><td>'+el.name+'</td><td>'+el.quantity+'</td><td>'+el.status_order+'</td><td>'+
      '<select class="form-control selectchef" data-id="'+el.id+'" name="selectchef"><option value="">اختار الشيف</option>'+chefs+'</select></td></tr>';
    }
    function getchefs(ch,el)
    {
        selected=''; if(ch==el.id){selected='selected';}
      chefs+='<option value="'+el.id+'" '+selected+'>'+el.name+'</option>';
    }

</script>
@endsection
