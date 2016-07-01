/**
 * Created by thomassmit on 14/05/16.
 */

(function()
{

	Vue.component('lighttools',
		{
			template: '#lighttools-template',


			data: function()
			{
				return {

					timerLength: 60 * 5, // Aantal seconden, 10 minuten
					timerCountdown: "00:00",
					timeLeft: 0,
					active: false,
					handle: null,

				}
			},


			methods: {

				turnLightsOff: function()
				{
					var self = this;
					$.post('/lights/turn-all-off').always(function()
					{
						self.$root.$broadcast('updatelights');
					});
				},


				startTimer: function()
				{
					if(this.active)
						return;

					this.active = true;
					this.timeLeft = this.timerLength;
					this.setTimeLeft();

					// start timer

					var self = this;
					this.handle = window.setInterval(function()
					{
						self.timeLeft--;

						if(self.timeLeft <= 0)
						{
							self.stopTimer();
							self.turnLightsOff();

						} else {
							self.setTimeLeft();
						}

					}, 1000);
				},


				setTimeLeft: function()
				{
					this.timerCountdown = this.pad(Math.floor(this.timeLeft / 60)) +
						':' +
						this.pad(this.timeLeft % 60);
				},


				stopTimer: function()
				{
					if(this.active)
					{
						this.active = false;
						window.clearInterval(this.handle);
						this.handle = null;
					}
				},


				toggle: function()
				{
					if(this.active)
						this.stopTimer();
					else
						this.startTimer();
				},


				pad: function(num)
				{
					return num <= 9? '0' + num : num;
				}
			}
		});


})();