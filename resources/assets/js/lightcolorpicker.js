/**
 * Created by thomassmit on 19/06/16.
 */

(function()
{

	Vue.component('lightcolorpickers',
	{
		template: '#lightcolorpickers-template',


		data: function()
		{

			return {
				// Gevonden lichten

				brightness: 100,
				selectedColor: '#000000',

				lights: []
			}
		},


		events: {
			lightsupdated: function()
			{
				this.setLights(this.$root.$refs.lights.lights);
			}
		},


		created: function()
		{
			var me = this;
			// Wachten totdat Vue daadwerkelijk klaar is...
			setTimeout(function()
			{
				var palette = new Image();

				palette.onload = function()
				{
					var canvas = $('.block-lightcolorpickers canvas')[0];

					canvas.getContext('2d')
						.drawImage(
							palette,
							0, 0,
							canvas.width, canvas.height
						);
					
					palette.style.display = 'none';
				};

				palette.src = '/images/palette.jpg';

				me.setupRange();

			}, 500);
		},


		watch: {
			brightness: function()
			{
				this.setLightColor();
			},

			selectedColor: function()
			{
				this.setLightColor();
			}
		},

		methods: {

			selectLight: function(light)
			{
				light.selected = !light.selected;
			},


			setLights: function(lights)
			{
				for(var index in lights)
				{
					if(!this.lights[index])
					{
						var clonedLight = Vue.util.extend({}, lights[index]);
						clonedLight.selected = false;
						this.lights.push(clonedLight);
					}
				}
			},


			setLightColor: function()
			{
				var me = this;
				$.post('/lights/set-colors', {

					brightness: this.brightness,
					color: this.selectedColor,

				}, function()
				{


				}).always(function()
				{
					me.$root.$broadcast('updatelights');
				});
			},


			colorSelected: function(event)
			{
				var clientRect = event.target.getBoundingClientRect();
				var info = event.target.getContext('2d').getImageData(
					event.clientX - clientRect.left, event.clientY - clientRect.top, 1, 1
				);

				this.selectedColor = '#' + this.convertRGB(info.data[0], info.data[1], info.data[2]);
			},


			convertRGB: function(R, G, B)
			{
				return ((R << 16) | (G << 8) | B).toString(16);
			},


			setupRange: function()
			{
				var me = this;
				$('input[type="range"]').rangeslider({

					polyfill: false,

					rangeClass: 'rangeslider',
					disabledClass: 'rangeslider--disabled',
					horizontalClass: 'rangeslider--horizontal',
					verticalClass: 'rangeslider--vertical',
					fillClass: 'rangeslider__fill',
					handleClass: 'rangeslider__handle',

					onSlide: function(position, value)
					{
					//	me.brightness = value;
					},

					onSlideEnd: function(position, value)
					{
						me.brightness = value;
					}
				});

			}


		}
	});


})();