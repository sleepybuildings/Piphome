/**
 * Created by thomassmit on 14/05/16.
 */

(function()
{

	Vue.component('networkdevices',
		{
			template: '#networkdevices-template',


			data: function()
			{
				return {

					devices:[]
				}
			},


			created: function()
			{
				this.updateDeviceList();
				this.start();
			},


			methods: {


				start: function()
				{
					window.setInterval(this.updateDeviceList, 1000 * 10 * 5);
				},


				updateDeviceList: function()
				{
					var self = this;
					$.get('/ping', function(response)
					{
						for(var index in response)
							self.updateDevice(response[index]);
					});
				},


				updateDevice: function(device)
				{
					for(var index in this.devices)
						if(this.devices[index].name == device.name)
						{
							this.devices[index].online = device.online;
							return;
						}

					this.devices.push(device);
				}

			}
		});


})();