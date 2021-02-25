@extends('layouts.master2')
@section('name')
تاكيد كلمة المرور
@endsection
@section('content')
<div class="container p-5">
    <div class="row justify-content-center p-5">
        <div class="col-md-6 p-5">
            <div class="card">
                <div class="card-header">تاكيد كلمة المرور</div>
                <div class="card-body">
                   من فضلك اكد كلمة المرور قبل الاستمرار
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password" type="password" placeholder="كلمة المرور" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    تاكيد كلمة المرور
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        نسيت كلمة المرور
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
