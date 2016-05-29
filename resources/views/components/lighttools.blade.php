<lighttools></lighttools>

<script type="text/x-template" id="lighttools-template">
	<div class="light-tools">
		<button v-on:click="toggle()">
			<span v-if="active">
				Stop (<span> @{{ timerCountdown }}</span> )
			</span>
			<span v-else>
				Slaaptimer
			</span>
		</button>

		<button v-on:click="turnLightsOff()">
			Zet alle lampen uit
		</button>
	</div>
</script>
