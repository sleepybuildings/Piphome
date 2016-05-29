<networkdevices></networkdevices>

<script type="text/x-template" id="networkdevices-template">
	<div class="block networkdevices-block">
		<ul class="networkdevices">
			<li v-for="device in devices">
				@{{ device.name }}

				<div class="@{{{ device.online? 'on' : 'off' }}}"></div>
			</li>
		</ul>
	</div>
</script>
