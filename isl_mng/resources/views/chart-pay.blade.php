@extends('layouts.app')

@section('template_title')
Chart
@endsection

@section('content')

<section class="content">
    <!-- BAR CHART -->
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Pay Fee</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="chart">
                <canvas id="barChart" style="min-height: 500px; height: 500px; max-height: 750px; max-width: 100%;"></canvas>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
@endsection

@section('script')
<!-- ChartJS -->
<script src="/assets/plugins/chart.js/Chart.min.js"></script>
<script>

    var jsonText = JSON.stringify('{{$jareaChartData}}').replace(/&quot;/g,'"').toString().substr(1).slice(0, -1);
    var areaChartData = JSON.parse(jsonText);
    console.log(areaChartData);

    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        datasetFill : false,
        legend: {
            display: true
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: true,
                }
            }],
            yAxes: [{
                gridLines: {
                    display: true,
                },
                ticks: {
                    min: 0, //minimum tick
                    //max: 50, //maximum tick
                }
            }]
        }
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0



    var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: areaChartOptions
    })

</script>
@endsection()