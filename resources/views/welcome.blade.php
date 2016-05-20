<!DOCTYPE html>
<html>
<head>
	<title>PIP</title>
	<link rel="stylesheet" href="{{ elixir('css/app.css') }}">
	<link rel="stylesheet" href="{{ elixir('css/lights.css') }}">
</head>
<body>

	<div id="app">
		<div class="block-lights">
			@include('components.lights')
		</div>
	</div>

	<script type="text/javascript" src="/js/globals.js"></script>
</body>
</html>
