<lightcolorpickers></lightcolorpickers>

<script type="text/x-template" id="lightcolorpickers-template">
	<div class="block block-lightcolorpickers">


		<div class="lights">
			<ul class="lights">
				<li v-for="light in lights">
					<a href="#"
					   v-on:click="selectLight(light)"
					   class="light @{{{ light.selected? 'selected' : '' }}}"
					>
						<div class="checkbox">
							<i class="icon-ok"></i>
						</div>
						<div class="name">@{{ light.name }}</div>
					</a>
				</li>
			</ul>
		</div>
		<div class="picker">
			<canvas width="600px" height="345px" v-on:click="colorSelected"></canvas>
		</div>
		<div class="brightness">
			<input type="range" v-bind="brightness" step="1" min="0" max="255" data-orientation="horizontal"/>
		</div>

	</div>
</script>
