/**
 * Created by thomassmit on 14/05/16.
 */

(function()
{

	var lights = {

		toggleLight: function(light)
		{

		}

	};


	Vue.component('lights',
	{
		template: '#light-template',


		data: function()
		{
			return {

				// Gevonden lichten

				lights: []
			}
		},


		created: function()
		{
			this.findLights();
		},


		/*computed: {
			hexColor: function(x)
			{
				return '#121212';
			}
		},*/


		methods: {

			findLights: function()
			{
				var self = this;
				$.get('/lights', function(response)
				{
					for(var index in response)
					{
						if(!response[index].working)
							response[index].working = false;

						self.updateLight(response[index]);
					}
				});
			},


			updateLight: function(light)
			{
				if(typeof(this.lights[light.id]) === 'undefined')
					this.lights.push(light);
				else {

					for(var property in light)
						this.lights[light.id - 1][property] = light[property];
				}
			},


			toggleLight: function(light, event)
			{
				light.working = true;

				var self = this;
				$.post('/lights/toggle', {lightID: light.id}, function(response)
				{
					self.updateLight(response);

				}).always(function()
				{
					light.working = false;
				});
			}

		}
	});


})();