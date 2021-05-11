/* globals Chart:false, feather:false */

(function () {
	'use strict'

	feather.replace()

	// Graphs
	var ctx = document.getElementById('myChart')
	// eslint-disable-next-line no-unused-vars
	var myChart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: [
			'Sunday',
			'Monday',
			'Tuesday',
			'Wednesday',
			'Thursday',
			'Friday',
			'Saturday'
		],
		datasets: [{
			data: [
				15339,
				21345,
				18483,
				24003,
				23489,
				24092,
				12034
			],
			lineTension: 0,
			backgroundColor: 'transparent',
			borderColor: "#D9D9D9",
   		pointBackgroundColor: "#D9D9D9",
   		pointBorderColor: "#D9D9D9",
		}]
	},
	options: {
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero: true
				},
				gridLines: {
					zeroLineColor: 'gray'
				}
			}],
			xAxes: [{
				gridLines: {
					zeroLineColor: 'gray'
				}
			}]
		},
		legend: {
			display: false
		}
	}
	})
})()
