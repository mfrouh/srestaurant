@extends('layouts.app')
@section('title')
تعديل البيانات الشخصية
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto"> تعديل البيانات الشخصية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
		</div>
	</div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
                <!-- row opened -->
<form action="{{route('profile-setting.store')}}" method="post" enctype="multipart/form-data">
 @csrf
 <div class="row row-sm">
 	<div class="col-xl-8">
 		<div class="card mg-b-20">
 			<div class="card-header pb-0">
 				<div class="d-flex justify-content-between">
 					<h4 class="card-title mg-b-0">تعديل البيانات الشخصية</h4>
 				</div>
 			</div>
 			<div class="card-body">
                <div class="form-group">
                    <label for="">الاسم</label>
                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{auth()->user()->name}}"  placeholder="الاسم" required>
                    @error('name')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">البريد الالكتروني</label>
                    <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" value="{{auth()->user()->email}}" placeholder="البريد الالكتروني" required>
                    @error('email')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for=""> الصورة الشخصية</label>
                    <input type="file" name="image" class="@error('image') is-invalid @enderror">
                    <img src="{{asset(auth()->user()->image)}}"  height="100px" width="100px">
                    @error('image')
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

