<!DOCTYPE html>
<html>
<head>
	<title>PIP</title>
	<link rel="stylesheet" href="{{ elixir('css/app.css') }}">
	<link rel="stylesheet" href="{{ elixir('css/lights.css') }}">
	<link rel="stylesheet" href="{{ elixir('css/clock.css') }}">
	<link rel="stylesheet" href="{{ elixir('css/lighttools.css') }}">
	<link rel="stylesheet" href="{{ elixir('css/networkdevices.css') }}">
</head>
<body>

	<div id="app">
		<div id="toolbar">
			@include('components.clock')
		</div>

		<div class="block-lights">
			@include('components.lights')
		</div>
		@include('components.lighttools')
		@include('components.networkdevices')
	</div>

	<script type="text/javascript" src="/js/globals.js"></script>
</body>
</html>
