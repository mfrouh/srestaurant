@if (session('errors'))
<div class="card bd-0 mg-b-20 bg-danger-transparent alert p-0" style="position: absolute;bottom:0;left:0; z-index:9999;">
    <div class="card-header text-danger font-weight-bold">
        <i class="far fa-times-circle"></i> الاخطاء
        <button aria-label="Close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true">×</span></button>
    </div>
    <div class="card-body text-danger">
        @foreach (session('errors')->all() as $error)
         <strong>{{$error}}</strong><br>
       @endforeach
    </div>
</div>
<script>
  $(".alert").alert();
</script>
@endif

@if (session('success'))
<div class="card bd-0 mg-b-20 bg-success-transparent alert p-0" style="position: absolute;bottom:0;left:0; z-index:9999;">
    <div class="card-header text-success font-weight-bold">
        <i class="far fa-check-circle"></i> نجاح
        <button aria-label="Close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true">×</span></button>
    </div>
    <div class="card-body text-success">
        <strong>{{session('success')}}</strong>
    </div>
</div><script>
    $(".alert").alert();
</script>
@endif
@if (session('error'))
<div class="card bd-0 mg-b-20 bg-danger-transparent alert p-0" style="position: absolute;bottom:0;left:0; z-index:9999;">
    <div class="card-header text-danger font-weight-bold">
        <i class="far fa-times-circle"></i> الاخطاء
        <button aria-label="Close" class="close" data-dismiss="alert" type="button"><span aria-hidden="true">×</span></button>
    </div>
    <div class="card-body text-danger">
        <strong>{{session('error')}}</strong>
    </div>
</div><script>
    $(".alert").alert();
</script>
@endif
