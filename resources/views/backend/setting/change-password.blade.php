@extends('layouts.app')
@section('title')
تغير كلمة السر
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto"> تغير كلمة السر</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
		</div>
	</div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
                <!-- row opened -->
<form action="{{route('change-password.store')}}" method="post">
 @csrf
 <div class="row row-sm">
 	<div class="col-xl-8">
 		<div class="card mg-b-20">
 			<div class="card-header pb-0">
 				<div class="d-flex justify-content-between">
 					<h4 class="card-title mg-b-0">تغير كلمة السر</h4>
 				</div>
 			</div>
 			<div class="card-body">
                <div class="form-group">
                    <label for="">كلمة السر القديمة</label>
                    <input type="password" name="old_password" class="form-control  @error('old_password') is-invalid @enderror"  placeholder="كلمة السر القديمة" required>
                    @error('old_password')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">كلمة السر الجديدة</label>
                    <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror"  placeholder="كلمة السر الجديدة" required>
                    @error('password')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for=""> تاكيد كلمة السر</label>
                    <input type="password" name="password_confirmation" class="form-control  @error('password_confirmation') is-invalid @enderror"  placeholder="تاكيد كلمة السر" required>
                    @error('password_confirmation')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-primary" value="حفظ">
                </div>
 			</div>
 		</div>
     </div>
 </div>
</form>
@endsection

