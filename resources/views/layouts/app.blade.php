<!DOCTYPE html>
<html lang="ar">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        @include('layouts.head')
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.gstatic.com">
       <link href="https://fonts.googleapis.com/css2?family=Rakkas&display=swap" rel="stylesheet">


        <style>
        body{
            font-family: 'Tajawal', sans-serif;
            /* font-family: 'Lalezar', cursive;
            font-family: 'Rakkas', cursive; */
          }

        </style>
	</head>

	<body class="main-body app sidebar-mini">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		@include('layouts.main-sidebar')
		<!-- main-content -->
		<div class="main-content app-content">
			@include('layouts.main-header')
			<!-- container -->
			<div class="container-fluid">
				@yield('page-header')
                @yield('content')
                @include('layouts.message')
				@include('layouts.sidebar')
				{{-- @include('layouts.models') --}}
            	{{--  @include('layouts.footer')  --}}
                @include('layouts.footer-scripts')
	</body>
</html>
