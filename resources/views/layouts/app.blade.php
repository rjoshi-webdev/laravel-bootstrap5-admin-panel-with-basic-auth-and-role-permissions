<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
		<meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--favicon-->
		<link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png" />
		<!-- loader-->
		<link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
		<script src="{{ asset('assets/js/pace.min.js') }}"></script>
		<!-- Bootstrap CSS -->
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
		<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
		@yield('PageTitle')
		
    
  
   
    @yield('styles')
</head>

<body class="off-canvas-sidebar">
    @yield('content')
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    @yield('scripts')
    
    
</body>

</html>
