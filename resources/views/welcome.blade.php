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
	<link rel="stylesheet" href="{{ elixir('css/lightcolorpickers.css') }}">
	<link rel="stylesheet" href="{{ elixir('css/meter.css') }}">
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

		<div id="pages">

			<div class="page">
				@include('components.lights')
				@include('components.lighttools')
				@include('components.networkdevices')
				@include('components.weather')
				@include('components.meter')
			</div>


			<div class="page" style="background: royalblue;">
				@include('components.lightcolorpicker')
			</div>


			<div class="page" style="background: #dfe126;">
				<h1 style="margin: 100px; color:white;font-size: 30px">RUND</h1>
			</div>

			<div class="page" style="background: #5de167;">
				<h1 style="margin: 100px; color:white;font-size: 30px">SCHAAP</h1>
			</div>
		</div>

	</div>

	<script type="text/javascript" src="/js/globals.js"></script>

	<script type="text/javascript" src="/js/highcharts/js/highcharts.js"></script>
	<script type="text/javascript" src="/js/highcharts/js/highcharts-more.js"></script>
	<script type="text/javascript" src="/js/highcharts/js/modules/solid-gauge.js"></script>

</body>
</html>
