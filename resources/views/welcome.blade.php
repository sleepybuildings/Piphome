<!DOCTYPE html>
<html>
<head>
	<title>PIP</title>
	<link rel="stylesheet" href="{{ elixir('css/app.css') }}">
	<link rel="stylesheet" href="{{ elixir('css/lights.css') }}">
	<link rel="stylesheet" href="{{ elixir('css/clock.css') }}">
	<link rel="stylesheet" href="{{ elixir('css/lighttools.css') }}">
	<link rel="stylesheet" href="{{ elixir('css/networkdevices.css') }}">
	<link rel="stylesheet" href="{{ elixir('css/weather.css') }}">
	<style type="text/css">
		@if(!env('APP_DEBUG'))
			*{ cursor: none }
		@endif
	</style>
</head>
<body>

	<div id="app">
		<div id="toolbar">
			@include('components.clock')
		</div>

		@include('components.lights')
		@include('components.lighttools')
		@include('components.networkdevices')
		@include('components.weather')
	</div>

	<script type="text/javascript" src="/js/globals.js"></script>
</body>
</html>
