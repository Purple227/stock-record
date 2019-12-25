
<!doctype html>

<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link href="{{ mix('css/fontawesome.css') }}" rel="stylesheet">


	<style type="text/css">
		body
		{
			background-color: black;
			display:flex; 
			flex-direction:column; 
			justify-content:center;
			position: relative;
			min-height: 100vh;
		}

	</style>

</head>

<body class="is-rounded">
	<div id="app">
	<app> </app>
	</div>
	<script src="{{ mix('js/app.js') }}"></script>

</body>

</html>
