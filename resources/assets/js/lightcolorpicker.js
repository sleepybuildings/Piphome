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
			updatelights: function()
			{
			//	this.findLights();
			}
		},


		created: function()
		{
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

			}, 500);
		},


		methods: {


			start: function()
			{

			},


			colorSelected: function(event)
			{

				var clientRect = event.target.getBoundingClientRect();

				console.log(event.clientX - clientRect.left, event.clientY - clientRect.top);


				var info = event.target.getContext('2d').getImageData(event.clientX - clientRect.left, event.clientY - clientRect.top, 1, 1);

				this.selectedColor = '#' + this.convertRGB(info.data[0], info.data[1], info.data[2]);
console.log(this.selectedColor);
				//console.log(info, );
			},


			convertRGB: function(R, G, B)
			{
				return ((R << 16) | (G << 8) | B).toString(16);
			}


		}
	});


})();