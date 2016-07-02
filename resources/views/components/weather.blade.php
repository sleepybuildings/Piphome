<weather></weather>

<script type="text/x-template" id="weather-template">
	<div class="block block-weather">

		<div class="current-weather">
			<div class="temperature">
				@{{ temperature }}
				<i class="wi wi-celsius"></i>
			</div>

			<div class="icon">
				<i class="wi @{{ icon }}"></i>
			</div>
		</div>

		<div class="times">
			<div class="sun">
				<i class="wi wi-sunrise"></i>
				@{{ sunrise }}
			</div>

			<div class="sun">
				<i class="wi wi-sunset"></i>
				@{{ sunset }}
			</div>
		</div>

		<p>
			@{{ weather }}
		</p>

	</div>
</script>
