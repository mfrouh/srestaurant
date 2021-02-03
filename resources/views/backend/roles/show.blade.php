@extends('layouts.app')
@section('title')
انشاء وظيفة
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto"> انشاء وظيفة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
		</div>
	</div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
                <!-- row opened -->
<form action="/role_permissions" method="post">
 @csrf
 <div class="row row-sm">
 	<div class="col-xl-8">
 		<div class="card mg-b-20">
 			<div class="card-header pb-0">
 				<div class="d-flex justify-content-between">
 					<h4 class="card-title mg-b-0">انشاء وظيفة</h4>
 				</div>
 			</div>
 			<div class="card-body">
                <div class="form-group">
                    <label for="">اسم الوظيفة</label>
                    <input type="text" class="form-control" readonly value="{{$role->name}}" >
                    <input type="hidden" class="form-control" name="role_id" readonly value="{{$role->id}}" >
                </div>
                <div class="form-group">
                    <label for="">الصلاحيات</label>
                    @foreach ($permissions as $permission)
                    <label class="btn btn-light" >
                        <input type="checkbox" name="permissions[]"  {{in_array($permission->id,$rolepermissions)?'checked':''}} value="{{$permission->id}}">
                         {{$permission->name}}
                    </label>
                    @endforeach
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-primary" value="حفظ">
                </div>
 			</div>
 		</div>
     </div>
 </div>
</form>
</div>
</div>
@endsection

