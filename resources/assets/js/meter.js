/**
 * Created by thomassmit on 01/07/16.
 */

(function($)
{

	Vue.component('meter',
		{
			template: '#meter-template',


			data: function()
			{
				return {
					min: 0,
					max: 200,
				}
			},

			computed: {

				current: {
					set: function(l1)
					{
						var chart = $('.meter-chart').highcharts();

						if(chart)
							chart.series[0].points[0].update(l1);
					}
				}
			},


			created: function()
			{
				this.makeChart();
				this.update();
			},


			methods: {

				start: function()
				{
					window.setInterval(this.update, 5000);
				},


				update: function()
				{
					var me = this;
					$.get('/meter/current', function(response)
					{
						if(response.current)
							me.current = response.current;
					});
				},

				makeChart: function()
				{
					var chartOptions = {
						chart: {
							type: 'solidgauge',
							backgroundColor: null,
						},
						title: 'P1 Meter',

						pane: {
							center: ['50%', '60%'],
							size: '90%',
							startAngle: -90,
							endAngle: 90,
							background: {
								backgroundColor: 'rgba(255, 255, 255, 0.1)',// 'transparent',//null,//'rgba(255, 255, 255, 0.1)',
								innerRadius: '60%',
								outerRadius: '100%',
								borderWidth: 0,
								shape: 'arc'
							}
						},
						yAxis: {
							stops: [
								[0.1, '#55BF3B'], // green
								[0.3, '#DDDF0D'], // yellow
								[0.9, '#DF5353'] // red
							],
							min: 0.0,
							max: 2.5,
							lineWidth: 0,
							minorTickInterval: 0,
							tickInterval: 1,
							tickWidth: 0,
							tickLength: 0,
							tickPosition: 'inside',
							title: {
								//y: -10
							},
							labels: {
								y: -15,

								align: 'left',
								distance: -30,
								rotation: 'auto'
							}
						},
						plotOptions: {
							solidgauge: {

							}
						},
						tooltip: {
							valueSuffix: ' kW'
						},
						series: [{
							name: 'kW',
							data: [0.000],
							dataLabels: {
								y: -20,
								borderWidth: 0,
								useHTML: true,
								formatter: function()
								{
									return '<div class="meter-current"><span class="current">' +
										this.y +
										'</span><span class="unit">kW</span></div>';
								}
							},
						}]

					};


					$(document).ready(function()
					{
						$('.meter-chart').highcharts(chartOptions);
					});

				}

			}
		});


})(jQuery);