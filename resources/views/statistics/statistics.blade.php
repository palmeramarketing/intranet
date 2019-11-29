@extends('layouts.app')

@section('title')
    {{ trans('global.statistics') }}
@endsection

@section('stylesheet')

@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <style>
        body
        {
            background: rgba(165,105,189,1);
        }
    </style>
    <div class="page-header text-center" style="margin-top: 10vh; padding: 10px; padding-top: 7rem; height: 90vh;">
        <div class="card card-nav-tabs card-plain" style="width: 100%; height: 70vh;">
            <div class="navbar navbar-expend-lg navbar-transparent text-center" style="margin: 0px;">
                <div class="nav-tabs-navigation" style="width: 100%;">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="mr-auto ml-auto text-primary">
                                <a class="btn btn-primary btn-round" href="#home" data-toggle="tab">{{ trans('global.statistics') }}</a>
                            </li>
                            <li class="mr-auto ml-auto text-primary">
                                <a class="btn btn-primary btn-round" href="#updates" data-toggle="tab">{{ trans('global.question') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body" style="padding-top: 0px; height: 80vh;">
                <div class="tab-content text-center" style="height: 80vh;">
                    <div class="tab-pane active" id="home" style="height: 90vh;">
                        <canvas id="generalStatistics" width="100%" height="36px" class="" style="background-color: #fff; margin: 0 auto; padding-right: 10px; text-align: left;" >
                        </canvas>                        
                    </div>
                    
                    <div class="tab-pane" id="updates">
                        <canvas id="specificStatistics" width="100%" height="36px" class="" style="background-color: #fff; margin: 0 auto; padding-right: 10px; text-align: left;" >
                        </canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- <canvas id="statistics" class="card" style="background-color: #fff; margin: 0 auto; width: 0px; height: 0px; padding-right: 10px; text-align: left;" >
            
        </canvas> --}}

    </div>

        {{-- print_r($evaluationData) --}}
    
        {{--<div class="text-center py-5" style="padding: 0px;" name="anchorPoint" id="anchorPoint">

        </div>--}}

    {{ $evaluationData['evaluations'][Auth::user()->email]['admin']['question5'] }}
@endsection

@php 
    use App\EvaluationHistory;
    $evaluation = EvaluationHistory::where('date', '11-2019')->first()->value('data');
    $evaluations = json_decode($evaluation);
    $total = 0;
    foreach ($evaluations as $qwerty) {
        //
        if($qwerty->id_user == Auth::user()->id)
        {
            $total += intval($qwerty->value);
        }
    }
    $averageNov = $total/10;
    // echo $averageNov;
@endphp

@section('script')
<script src="{{ asset('js/statistics.js') }}"></script>
<script>
    
    var evaluaciones = [

        {{ intval($averageNov)+2 }},
        {{ intval($averageNov)+3 }},
        {{ intval($averageNov)+4 }},
        {{ intval($averageNov)+1 }},
        {{ intval($averageNov)+5 }},
        {{ intval($averageNov)+1 }},
        {{ intval($averageNov)+7 }},
        {{ intval($averageNov)+4 }},
        {{ intval($averageNov)+4 }},
        {{ intval($averageNov)+2 }},
        {{ intval($averageNov)+4 }},
        {{ intval($averageNov)+6 }},

    ];

    var sum = 0;
    
    var promedio = 0;
    
    var i = 0;
    
    while(i < evaluaciones.length)
    {   
        sum += evaluaciones[i];
        i++;
    }
    
    promedio = sum/evaluaciones.length;
    
    var ctx = document.getElementById('generalStatistics');
    
    var generalStatistics = new Chart(ctx, {
    
    type: 'line',
    
    data: {
    
        labels: [
            '{{ trans('global.january') }}',
            '{{ trans('global.february') }}',
            '{{ trans('global.march') }}',
            '{{ trans('global.april') }}',
            '{{ trans('global.may') }}',
            '{{ trans('global.june') }}',
            '{{ trans('global.july') }}',
            '{{ trans('global.august') }}',
            '{{ trans('global.september') }}',
            '{{ trans('global.october') }}',
            '{{ trans('global.november') }}',
            '{{ trans('global.december') }}',
        ],
    
        datasets: [{
            label: promedio.toFixed(2)+" - Promedio anual",
            data: evaluaciones,
            backgroundColor: 'rgba(255, 255, 255, 0)',
            borderColor: 'rgba(132, 84, 159, 1)',
            // borderWidth: 1,
            lineTension: 0.5,
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    max: 10,
                    min: 0,
                }
            }],
            
        },
        tooltips: {
            enabled: false,
        }
        
    }
    });

    // 
    // 
    // 

    // var ctxs = document.getElementById('specificStatistics');
    // var specificStatics = new Chart(ctxs, {
    //     //
    //     type: 'line',
    // data: {
    //     labels: ['{{-- trans('global.january') --}}', '{{-- trans('global.february') --}}', '{{-- trans('global.march') --}}', '{{-- trans('global.april') --}}', '{{-- trans('global.may') --}}', '{{-- trans('global.june') --}}', '{{-- trans('global.july') --}}', '{{-- trans('global.august') --}}', '{{-- trans('global.september') --}}', '{{-- trans('global.october') --}}', '{{-- trans('global.november') --}}', '{{-- trans('global.december') --}}',],
    //     datasets: [{
    //         label: promedio.toFixed(2)+" - Promedio anual",
    //         data: evaluaciones,
    //         backgroundColor: 'rgba(255, 255, 255, 0)',
    //         borderColor: 'rgba(175, 25, 34, 1)',
    //         borderWidth: 1,
    //         lineTension: 0.1,
    //     }]
    // },
    // options: {
    //     scales: {
    //         yAxes: [{
    //             ticks: {
    //                 beginAtZero: true,
    //                 max: 10,
    //                 min: 0,
    //             }
    //         }],
            
    //     },
    //     tooltips: {
    //         enabled: false,
    //     }
        
    // }
    // });

    // 
    // 
    // 


    var lineChartData = {
            labels: [
                '{{ trans('global.january') }}',
                '{{ trans('global.february') }}',
                '{{ trans('global.march') }}',
                '{{ trans('global.april') }}',
                '{{ trans('global.may') }}',
                '{{ trans('global.june') }}',
                '{{ trans('global.july') }}',
                '{{ trans('global.august') }}',
                '{{ trans('global.september') }}',
                '{{ trans('global.october') }}',
                '{{ trans('global.november') }}',
                '{{ trans('global.december') }}',
            ],

            datasets: [{
                label: 'Q1',
                borderColor: 'rgb(138, 43, 226)',
                backgroundColor: 'rgb(138, 43, 226)',
                lineTension: 0.5,
                fill: false,
                data: [
                    {{ 0 }},
                    {{ 2 }},
                    {{ 1 }},
                    {{ 3 }},
                    {{ 5 }},
                    {{ 4 }},
                    {{ 7 }},
                    {{ 6 }},
                    {{ 9 }},
                    {{ 8 }},
                    {{ 1 }},
                    {{ 0 }},
                ],
            }, {
                label: 'Q2',
                borderColor: 'rgb(100, 149, 237)',
                backgroundColor: 'rgb(100, 149, 237)',
                lineTension: 0.5,
                fill: false,
                data: [

                    {{ 0 }},
                    {{ 0 }},
                    {{ 2 }},
                    {{ 1 }},
                    {{ 3 }},
                    {{ 5 }},
                    {{ 4 }},
                    {{ 7 }},
                    {{ 6 }},
                    {{ 9 }},
                    {{ 8 }},
                    {{ 1 }},
                ],
            }, {
                label: 'Q3',
                borderColor: 'rgb(0, 139, 139)',
                backgroundColor: 'rgb(0, 139, 139)',
                lineTension: 0.5,
                fill: false,
                data: [

                    {{ 1 }},
                    {{ 0 }},
                    {{ 0 }},
                    {{ 2 }},
                    {{ 1 }},
                    {{ 3 }},
                    {{ 5 }},
                    {{ 4 }},
                    {{ 7 }},
                    {{ 6 }},
                    {{ 9 }},
                    {{ 8 }},
                ],
            }, {
                label: 'Q4',
                borderColor: 'rgb(139, 0, 139)',
                backgroundColor: 'rgb(139, 0, 139)',
                lineTension: 0.5,
                fill: false,
                data: [
                    {{ 8 }},
                    {{ 1 }},
                    {{ 0 }},
                    {{ 0 }},
                    {{ 2 }},
                    {{ 1 }},
                    {{ 3 }},
                    {{ 5 }},
                    {{ 4 }},
                    {{ 7 }},
                    {{ 6 }},
                    {{ 9 }},
                ],
            }, {
                label: 'Q5',
                borderColor: 'rgb(255, 140, 0)',
                backgroundColor: 'rgb(255, 140, 0)',
                lineTension: 0.5,
                fill: false,
                data: [
                    {{ 9 }},
                    {{ 8 }},
                    {{ 1 }},
                    {{ 0 }},
                    {{ 0 }},
                    {{ 2 }},
                    {{ 1 }},
                    {{ 3 }},
                    {{ 5 }},
                    {{ 4 }},
                    {{ 7 }},
                    {{ 6 }},
                ],
            }, {
                label: 'Q6',
                borderColor: 'rgb(178, 34, 34)',
                backgroundColor: 'rgb(178, 34, 34)',
                lineTension: 0.5,
                fill: false,
                data: [
                    {{ 6 }},
                    {{ 9 }},
                    {{ 8 }},
                    {{ 1 }},
                    {{ 0 }},
                    {{ 0 }},
                    {{ 2 }},
                    {{ 1 }},
                    {{ 3 }},
                    {{ 5 }},
                    {{ 4 }},
                    {{ 7 }},
                ],
            }, {
                label: 'Q7',
                borderColor: 'rgb(218, 165, 32)',
                backgroundColor: 'rgb(218, 165, 32)',
                lineTension: 0.5,
                fill: false,
                data: [
                    {{ 7 }},
                    {{ 6 }},
                    {{ 9 }},
                    {{ 8 }},
                    {{ 1 }},
                    {{ 0 }},
                    {{ 0 }},
                    {{ 2 }},
                    {{ 1 }},
                    {{ 3 }},
                    {{ 5 }},
                    {{ 4 }},
                ],
            }, {
                label: 'Q8',
                borderColor: 'rgb(50, 205, 50)',
                backgroundColor: 'rgb(50, 205, 50)',
                lineTension: 0.5,
                fill: false,
                data: [
                    {{ 4 }},
                    {{ 7 }},
                    {{ 6 }},
                    {{ 9 }},
                    {{ 8 }},
                    {{ 1 }},
                    {{ 0 }},
                    {{ 0 }},
                    {{ 2 }},
                    {{ 1 }},
                    {{ 3 }},
                    {{ 5 }},
                ],
            }, {
                label: 'Q9',
                borderColor: 'rgb(255, 165, 0)',
                backgroundColor: 'rgb(255, 165, 0)',
                lineTension: 0.5,
                fill: false,
                data: [
                    {{ 5 }},
                    {{ 4 }},
                    {{ 7 }},
                    {{ 6 }},
                    {{ 9 }},
                    {{ 8 }},
                    {{ 1 }},
                    {{ 0 }},
                    {{ 0 }},
                    {{ 2 }},
                    {{ 1 }},
                    {{ 3 }},
                ],
            }, {
                label: 'Q10',
                borderColor: 'rgb(0, 128, 128)',
                backgroundColor: 'rgb(0, 128, 128)',
                lineTension: 0.5,
                fill: false,
                data: [
                    {{ 3 }},
                    {{ 5 }},
                    {{ 4 }},
                    {{ 7 }},
                    {{ 6 }},
                    {{ 9 }},
                    {{ 8 }},
                    {{ 1 }},
                    {{ 0 }},
                    {{ 0 }},
                    {{ 2 }},
                    {{ 1 }},
                ],
            }

            ]
        };

        window.onload = function() {
            var ctx = document.getElementById('specificStatistics').getContext('2d');
            window.myLine = Chart.Line(ctx, {
                type: 'line',
                data: lineChartData,
                options: {
                    responsive: true,
                    hoverMode: 'index',
                    stacked: false,
                    title: {
                        display: true,
                        text: 'Prueba de grafica de caracteristicas especificas'
                    },
                    scales: {
                        yAxes: [{
                            type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                            display: true,
                            position: 'left',
                        }],
                    }
                }
            });
        };

       
    
</script>

@endsection
