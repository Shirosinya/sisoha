{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
            <!-- row -->
			<div class="container-fluid">
                <div class="form-head d-md-flex mb-sm-4 mb-3 align-items-start">
					<div class="mr-auto  d-lg-block">
						<h1 class="text-black font-w600">{{$nama_zona}}</h1>
						<p class="mb-0">Selamat Datang</p>
					</div>
					<!-- <a href="javascript:void(0);" class="btn btn-primary rounded light mr-3">Refresh</a> -->
					<!-- <a href="javascript:void(0);" class="btn btn-primary rounded"><i class="flaticon-381-settings-2 mr-0"></i></a> -->
				</div>
				<div class="row">
					<div class="col-xl-12 col-xxl-12">
						<div class="row">
							<!-- <div class="col-xl-12">
								<div class="card bg-danger property-bx text-white">
									<div class="card-body">
										<div class="media d-sm-flex d-block align-items-center">
											<span class="mr-4 d-block mb-sm-0 mb-3">
												<svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M31.8333 79.1667H4.16659C2.33325 79.1667 0.833252 77.6667 0.833252 75.8333V29.8333C0.833252 29 1.16659 28 1.83325 27.5L29.4999 1.66667C30.4999 0.833332 31.8333 0.499999 32.9999 0.999999C34.3333 1.66667 34.9999 2.83333 34.9999 4.16667V76C34.9999 77.6667 33.4999 79.1667 31.8333 79.1667ZM7.33325 72.6667H28.4999V11.6667L7.33325 31.3333V72.6667Z" fill="white"/>
													<path d="M75.8333 79.1667H31.6666C29.8333 79.1667 28.3333 77.6667 28.3333 75.8334V36.6667C28.3333 34.8334 29.8333 33.3334 31.6666 33.3334H75.8333C77.6666 33.3334 79.1666 34.8334 79.1666 36.6667V76C79.1666 77.6667 77.6666 79.1667 75.8333 79.1667ZM34.9999 72.6667H72.6666V39.8334H34.9999V72.6667Z" fill="white"/>
													<path d="M60.1665 79.1667H47.3332C45.4999 79.1667 43.9999 77.6667 43.9999 75.8334V55.5C43.9999 53.6667 45.4999 52.1667 47.3332 52.1667H60.1665C61.9999 52.1667 63.4999 53.6667 63.4999 55.5V75.8334C63.4999 77.6667 61.9999 79.1667 60.1665 79.1667ZM50.6665 72.6667H56.9999V58.8334H50.6665V72.6667Z" fill="white"/>
												</svg>
											</span>
											<div class="media-body mb-sm-0 mb-3 mr-5">
												<h4 class="fs-22 text-white">Barang Inventaris</h4>
												<div class="progress mt-3 mb-2" style="height:8px;"> -->
													<!-- <div class="progress-bar bg-white progress-animated" style="width: 86%; height:8px;" role="progressbar">
														<span class="sr-only">86% Complete</span>
													</div> -->
												<!-- </div> -->
												<!-- <span class="fs-14">431 more to break last month record</span> -->
											<!-- </div>
											<span class="fs-46 font-w500">4</span>
										</div>
									</div>
								</div>
							</div> -->
							<div class="col-sm-12 col-md-6">
								<div class="card">
									<div class="card-body">
										<div class="media align-items-center">
											<div class="media-body mr-3">	
												<h1 class="fs-36 text-black font-w800" style="margin-left: 50px;"><span style="color: #009e3c;">{{$satpam_zona}}</span></h1>
												<p class="fs-18 mb-0 text-black font-w500">Total Personil {{$nama_zona}}</p>
												<!-- <span class="fs-13">..</span> -->
											</div>
											<div class="d-inline-block">
												<!-- <span class="donut1" data-peity='{ "fill": ["rgb(60, 76, 184)", "rgba(236, 236, 236, 1)"],   "innerRadius": 38, "radius": 10}'>2/8</span>
												<small class="text-primary">71%</small>
												<span class="circle bgl-primary"></span> -->
												<img src="images/personil.png" alt="personil" style="height: 110px; width: 110px; margin-right: 40px;">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6">
								<div class="card">
									<div class="card-body">
										<div class="media align-items-center">
											<div class="media-body mr-3">	
												<h2 class="fs-36 text-black font-w800" style="margin-left: 50px;"><span style="color: #009e3c;">{{$satpams}}</span></h2>
												<p class="fs-18 mb-0 text-black font-w500">Total Personil Semua Zona</p>
												<!-- <span class="fs-13">...</span> -->
											</div>
											<div class="d-inline-block position-relative" >
												<!-- <i class="la la-user" style="width:100px; height:100px;"></i> -->
												<img src="images/personil-zona.png" alt="personil" style="height: 130px; width: 130px; margin-right: 40px; margin-bottom: -20px; margin-top: -15px;">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Pam Swakarsa Hari ini</h4>
							</div>
							<div class="card-body">
								<!-- <p style="text-align:center;"></p> -->
								<?php echo "<p style='text-align:center;'>" . date("d-m-Y") . "</p>";?>
								<div id="morris_bar" class="morris_chart_height"></div>
							</div>
						</div>
                    </div>
				</div>
            </div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>

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
					po: {{$pamsumAPO}},
					pb: {{$pamsumAPB}},
					ok: {{$pamsumAOK}}
				}, {
					y: 'REGU B',
					po: {{$pamsumBPO}},
					pb: {{$pamsumBPB}},
					ok: {{$pamsumBOK}}
				}, 
				{
					y: 'REGU C',
					po: {{$pamsumCPO}},
					pb: {{$pamsumCPB}},
					ok: {{$pamsumCOK}}
				},
				 {
					y: 'REGU D',
					po: {{$pamsumDPO}},
					pb: {{$pamsumDPB}},
					ok: {{$pamsumDOK}}
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
</script>
@endsection			