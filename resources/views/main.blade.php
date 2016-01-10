<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Plantas</title>
		<meta name="description" content="Plantas">
		<meta name="author" content="merkurio">
		<link href="{{ asset('/css/normalize.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		@yield('content')
		<script src="{{ asset('/js/jquery-1.11.3.min.js') }}"></script>
		<script src="{{ asset('/js/app.js') }}"></script>
	</body>
</html>