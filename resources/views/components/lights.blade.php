<lights></lights>

<script type="text/x-template" id="light-template">
	<div class="block block-lights">

		<ul class="lights">
			<li v-for="light in lights">
				<a v-bind:style="{ 'background-color': light.hexColor }"
				   v-bind:light="light"
				   v-on:click="toggleLight(light)"
				   class="light @{{{ light.on? 'on' : 'off' }}}"
				>
					<div class="name">@{{ light.name }}</div>
					<div class="status">
						<span v-show="light.working">Bezig...</span>
						<span v-show="!light.working">@{{ light.on? 'Zet uit' : 'Zet aan' }}</span>
					</div>
				</a>
			</li>
		</ul>
	</div>
</script>
