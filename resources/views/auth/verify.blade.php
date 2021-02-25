@extends('layouts.master2')
@section('title')
 تحقق من البريد الالكتروني
@endsection
@section('content')
<div class="container p-5">
    <div class="row justify-content-center p-5">
        <div class="col-md-6 p-5">
            <div class="card">
                <div class="card-header">تحقق من البريد الالكتروني</div>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            تحقق من رابط في البريد الالكتروني
                        </div>
                    @endif
                    قبل التحقق تاكيد من بريدك الالكتروني
                    <hr>
                    لو لم تستلم البريد الالكتروني
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">ارسال مرة اخري</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
