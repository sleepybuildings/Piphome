/**
 * Created by thomassmit on 14/05/16.
 */

(function()
{

	Vue.component('weather',
		{
			template: '#weather-template',


			data: function()
			{
				return {
					temperature: 0.00,
					icon: '',
					weather: '',
					sunrise: '',
					sunset: '',
				}
			},


			created: function()
			{
				this.updateWeather();
				this.start();
			},


			methods: {

				start: function()
				{
					window.setInterval(this.updateWeather, 1000 * 60 * 60);
				},


				updateWeather: function()
				{
					var self = this;
					$.get('/weather', function(response)
					{
						self.temperature = response.temperature;
						self.icon = response.icon;
						self.weather = response.weather;
						self.sunrise = response.sunrise
						self.sunset = response.sunset;
					});
				}
			}
		});

})();