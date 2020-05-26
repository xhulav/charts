(function (factory) {
	'use strict';
	if (typeof define === 'function' && define.amd) {
		define(['jQuery' ], factory);
	} else if (typeof exports === 'object') {
		module.exports = factory(require('jQuery'));
	} else {
		if (typeof jQuery === 'undefined') {
			throw 'chart-factory requires jQuery to be loaded first';
		}
		factory(jQuery);
	}
}(function ($) {
	'use strict';

	function ChartFactory($canvas, options) {
		this.$canvas = $canvas;
		this.type = 'doughnut';
		this.options = options;
		this.data = null;

		this.init();
		this.run();

		return this;
	}

	ChartFactory.prototype = {
		constructor: ChartFactory,

		addListeners: function() {

		},

		init: function() {
			this.loadChartType();
			this.loadData();
			this.showPercentages();

			if (this.type === 'bar' || this.type === 'line') {
				this.forceBarChartBeginAtZero();
			}
		},
		run: function() {
			let _this = this;
			new Chart(this.$canvas, {
				type: _this.type,
				data: _this.data,
				options: _this.options
			});
		},

		loadChartType: function() {
			let type = this.$canvas.attr('data-chart-type');
			if (type !== undefined) {
				this.type = type;
			}
		},

		loadData: function() {
			let data = this.$canvas.attr('data-chart-values');
			if (data !== undefined) {
				this.data = $.parseJSON(data);
			} else {
				throw "Attribute data-chart-values missing.";
			}
		},

		showPercentages: function () {
			let percentages = this.$canvas.attr('data-show-percentages');
			if (percentages === true) {
				this.options.tooltips = {
					callbacks: {
						label: function(tooltipItem, data) {
							let dataset = data.datasets[tooltipItem.datasetIndex].data;
							let tooltipLabel = data.labels[tooltipItem.index];
							let tooltipData = dataset[tooltipItem.index];
							let total = 0;
							for (let i in dataset) {
								total += dataset[i];
							}
							let tooltipPercentage = Math.round((tooltipData / total) * 100);
							return tooltipLabel + ': ' + tooltipData + ' (' + tooltipPercentage + '%)';
						}
					}
				}
			}
		},

		forceBarChartBeginAtZero: function() {
			this.options.scales = {
				yAxes: [
					{
						ticks: {
							beginAtZero: true
						}
					}
				]
			};
		}
	};

	(function( $ ) {

		$.fn.chartFactory = function(options) {

			return this.each(function () {

				let $this = $(this);
				if (!$this.data('ChartFactory')) {
					let extendedOptions = $.extend(true, {}, $.fn.chartFactory.defaults, options);
					$(this).data('ChartFactory', new ChartFactory($this, extendedOptions));
				}
			});
		};

		$.fn.chartFactory.defaults = {
			legend: {
				display: false
			}
		};

	}( jQuery ));
}));
