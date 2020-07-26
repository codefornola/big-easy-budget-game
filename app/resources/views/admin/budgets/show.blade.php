@extends('layout.admin')

@section('content')

	<a href="{{ route('admin.budgets.export', ['budgets' => $budget, 'type' => 'report']) }}" class="btn btn-success">Download Report <i class="fa fa-fw fa-download"></i></a>
	<br><br>
	<div class="row">
		<div class="col-lg-6">

			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Engagement (Overall)</h3>
		        </div>
				<div class="box-body with-border">
					<div class="row">
					@if(isset($stats['summaryActivity']['total']))
						<div class="col-sm-6">Total completed budgets: {{ $stats['summaryActivity']['total'] }}</div>
						<div class="col-sm-6">Average minutes to complete: {{ $budget->secondsToTime($stats['summaryActivity']['avgTakeTime']) }}</div>
				    @else
						<!-- <div class="col-sm-6">stats: {{ implode(', ', $stats) }}</div> -->
					@endif
					</div>
				</div>

                <div class="box-header with-border">
                  <h3 class="box-title">Engagement (Last 14 Days)</h3>
                </div>

				<div class="box-body border-radius-none">
                  <canvas class="chart" id="engagement-chart" style="height:200px;"></canvas>
                </div>

			</div>


		</div>
		<div class="col-lg-6">

			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">User Budget Allocation</h3>
		        </div>
				<div class="box-body no-padding">
					{{--{!! $budget->description !!}--}}
					@include('admin.budgets.sections.dash-org-avg')

				</div>
				<div class="box-body table-responsive no-padding">
					{{--@include('admin.budgets.sections.list')--}}
				</div>
			</div>

		</div>
	</div>
@endsection

@section('deferred')
	@parent
	<script src="/bower_components/admin-lte/plugins/chartjs/Chart.min.js"></script>
	<script>
		var ctx = document.getElementById("engagement-chart").getContext("2d");
		var data = {
			labels: {!! json_encode($graph['dates']) !!},
			datasets: [
				{
					label: "Completed budgets",
					fillColor: "#3c8dbc",
					strokeColor: "transparent",
					pointColor: "#3c8dbc",
					pointStrokeColor: "#333",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "#333",
					data: {!! json_encode($graph['completes']) !!}
				},
				{
					label: "Mins to complete (avg)",
					fillColor: "transparent",
					strokeColor: "#FDB45C",
					pointColor: "#FDB45C",
					pointStrokeColor: "#333",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "#333",
					data: {!! json_encode($graph['times']) !!}
				}
			]
		};
		/**
		 * ,
		 {
			 label: "Completed Surveys",
			 fillColor: "#ddd",
			 strokeColor: "transparent",
			 pointColor: "#ddd",
			 pointStrokeColor: "#333",
			 pointHighlightFill: "#fff",
			 pointHighlightStroke: "#333",
			 data: [25, 43, 30, 17, 31, 12, 20]
		 }
		 */
		var myLineChart = new Chart(ctx).Line(data, {
			responsive: false,
			bezierCurve : false,
			pointDotRadius : 3,
			pointDotStrokeWidth : 0,
			tooltipYPadding: 15,
			tooltipXPadding: 15,
			multiTooltipTemplate: "<%= value %>     <%= datasetLabel %>"
		});
	</script>
@endsection