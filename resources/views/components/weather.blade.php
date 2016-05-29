<weather></weather>

<script type="text/x-template" id="weather-template">
	<div class="block block-weather">

		<div class="current-weather">
			<div class="temperature">
				@{{ temperature }}
				<span>&deg;</span>
			</div>

			<div class="icon">
				<img src="@{{ icon }}"/>
			</div>
		</div>

		<div>
			<div class="sun">
				<img src="/images/sunrise.png"/>
				@{{ sunrise }}
			</div>

			<div class="sun">
				<img src="/images/sunset.png"/>
				@{{ sunset }}
			</div>
		</div>

		<p>
			@{{ weather }}
		</p>

	</div>
</script>
