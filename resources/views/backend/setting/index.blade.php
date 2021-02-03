@extends('layouts.app')
@section('title')
الاعدادات
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
	<div class="my-auto">
		<div class="d-flex">
			<h4 class="content-title mb-0 my-auto"> الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
		</div>
	</div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
                <!-- row opened -->
<form action="{{route('setting.store')}}" method="post" enctype="multipart/form-data">
 @csrf
 <div class="row row-sm">
 	<div class="col-xl-8">
 		<div class="card mg-b-20">
 			<div class="card-header pb-0">
 				<div class="d-flex justify-content-between">
 					<h4 class="card-title mg-b-0">الاعدادات</h4>
 				</div>
 			</div>
 			<div class="card-body">
                <div class="form-group">
                    <label for="">اسم الموقع</label>
                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" {{isset($setting->name)?"value=$setting->name":''}}>
                    @error('name')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">وصف الموقع</label>
                    <textarea  name="description" class="form-control  @error('description') is-invalid @enderror">{{isset($setting->description)?$setting->description:''}}</textarea>
                    @error('description')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">لوجو الموقع</label>
                    <input type="file" name="logo" class="form-control  @error('logo') is-invalid @enderror">
                    @error('logo')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for=""> فيس بوك</label>
                    <input type="text" name="facebook" class="form-control  @error('facebook') is-invalid @enderror" value="{{isset($setting->facebook)?$setting->facebook:''}}">
                    @error('facebook')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for=""> يوتيوب </label>
                    <input type="text" name="youtube" class="form-control  @error('youtube') is-invalid @enderror" value="{{isset($setting->youtube)?$setting->youtube:''}}">
                    @error('youtube')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">تويتر </label>
                    <input type="text" name="twitter" class="form-control  @error('twitter') is-invalid @enderror" value="{{isset($setting->twitter)?$setting->instagram:''}}">
                    @error('twitter')
                    <small id="helpId" class="text-muted">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for=""> انستجرام </label>
                    <input type="text" name="instagram" class="form-control  @error('instagram') is-invalid @enderror" value="{{isset($setting->instagram)?$setting->instagram:''}}">
                    @error('instagram')
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

