<lightcolorpickers></lightcolorpickers>

<script type="text/x-template" id="lightcolorpickers-template">
	<div class="block block-lightcolorpickers">


		<div class="lights" v-bind:style="{ backgroundColor: selectedColor }">

		</div>
		<div class="picker">
			<canvas width="500px" height="425px" v-on:click="colorSelected"></canvas>
		</div>
		<div class="brightness">
			<input type="range" v-bind="brightness" min="0" max="255"/>
		</div>

	</div>
</script>
