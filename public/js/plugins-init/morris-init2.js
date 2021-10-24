(function($) {
    "use strict"

	var dzMorris = function(){
		
		var screenWidth = $(window).width();
		
		var setChartWidth = function(){
			if(screenWidth <= 768)
			{
				var chartBlockWidth = 0;
				chartBlockWidth = (screenWidth < 300 )?screenWidth:300;
				jQuery('.morris_chart_height').css('min-width',chartBlockWidth - 31);
			}
		}
		
		var barChart = function(){
			//bar chart
			Morris.Bar({
				element: 'morris_bar',
				data: [{
					y: 'REGU A',
					po: 100,
					pb: 90,
					ok: 60
				}, {
					y: 'REGU B',
					po: 33,
					pb: 65,
					ok: 40
				}, 
				{
					y: 'REGU C',
					po: 50,
					pb: 40,
					ok: 30
				},
				 {
					y: 'REGU D',
					po: 75,
					pb: 65,
					ok: 40
				}],
				xkey: 'y',
				ykeys: ['po', 'pb', 'ok'],
				labels: ['PO', 'PB', 'OK'],
				barColors: ['#009E3C', '#37d159', '#ff9f00'],
				hideHover: 'auto',
				gridLineColor: 'transparent',
				resize: true,
				barSizeRatio: 0.25,
			});	
		}
		
		
		/* Function ============ */
		return {
			init:function(){
				setChartWidth();
				// donutChart();
				// lineChart();
				// lineChart2();
				barChart();
				// barStalkChart();
				// areaChart();
				//areaChart2();
			},
			
			
			resize:function(){
				screenWidth = $(window).width();
				/* setChartWidth();
				donutChart();
				lineChart();
				lineChart2();
				barChart();
				barStalkChart();
				areaChart();
				areaChart2(); */
			}
		}
		
	}();

	jQuery(document).ready(function(){
		dzMorris.init();
		//dzMorris.resize();
	
	});
		
	jQuery(window).on('load',function(){
		//dzMorris.init();
	});
		
	jQuery( window ).resize(function() {
		//dzMorris.resize();
		//dzMorris.init();
	});
   
})(jQuery);