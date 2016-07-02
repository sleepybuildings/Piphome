/**
 * Created by thomassmit on 01/07/16.
 */

(function($)
{

	Vue.component('dailymeter',
	{
		template: '#dailymeter-template',


		data: function()
		{
			return {
			}
		},


		created: function()
		{
			this.makeChart();
			this.update();
			this.start();
		},

		computed: {

			dataset: {
				set: function(dataset)
				{
					var chart = $('.dailymeter-chart').highcharts();

					if(chart)
					{
						for(index in dataset)
						{
							var date = new Date(dataset[index][0])
							dataset[index][0] = date.getTime();
						}

						chart.series[0].setData(dataset);
					}
				}
			}
		},



		methods: {

			start: function()
			{
				//window.setInterval(this.update, 5000);
			},


			update: function()
			{
				var me = this;
				$.get('/meter/today', function(response)
				{
					if(response.dataset)
						me.dataset = response.dataset;
				});
			},

			makeChart: function()
			{


				var chartOptions = {
					chart: {
						type: 'area',
						zoomType: null,
						backgroundColor: null,
					},
					tooltip: { enabled: false },

					title: {
						text: 'Dagoverzicht',
						style: {
							color: '#fff',
						}
					},
					xAxis: {
						type: 'datetime',

					},
					yAxis: {
						title: {
							text: 'Gebruik'
						},
						gridLineColor: '#444343',
					},
					credits: {
						enabled: false
					},
					legend: {
						enabled: false
					},
					plotOptions: {
						area: {

							fillColor: {
								linearGradient: [0, 0, 0, 300],
								stops: [
									[0.3, '#DF5353'], // red
									[0.7, '#DDDF0D'], // yellow
									[0.9, '#55BF3B'] // groen
								]
							},
							lineWidth: 0,
							threshold: null
						}
					},

					series: [{
						type: 'area',
						name: 'W',
						data: [],
						states: {
							hover: {
								enabled: false
							}
						}

					}]
				};


				$(document).ready(function()
				{
					Highcharts.setOptions({
						global: {
							useUTC: false,
						}
					});

					$('.dailymeter-chart').highcharts(chartOptions);
				});

			}

		}
	});


})(jQuery);