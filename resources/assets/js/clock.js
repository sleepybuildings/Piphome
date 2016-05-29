/**
 * Created by thomassmit on 14/05/16.
 */

(function()
{


	Vue.component('clock',
	{
		template: '#clock-template',


		data: function()
		{
			return {
				currentTime: '00:00',
			}
		},


		created: function()
		{
			this.startTime();
		},


		/*computed: {
			hexColor: function(x)
			{
				return '#121212';
			}
		},*/


		methods: {

			startTime: function()
			{
				var self = this;
				window.setInterval(function()
				{
					var now = new Date();
					self.currentTime = self.pad(now.getHours()) + ':' + self.pad(now.getMinutes());

				}, 1000);
			},


			pad: function(num)
			{
				return num <= 9? '0' + num : num;
			}

		}
	});


})();