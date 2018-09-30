$(function () {
    $("#Q").bind("click", function (e){
        e.preventDefault();
        $.ajax({
            method:'get',
            url:"Q.php",
            type:"GET",
            dataType: "json",
            success: function funcChart($json6){
                $('#Q_graph').highcharts({
                chart:{
                     type: 'spline'   
                },
                title: {
                    text: 'МАКСИМАЛЬНИЙ СТІК ВОДИ РІЧОК ДОЩОВИХ ПАВОДКІВ',
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    title:{
                        text:'Дата'
                    },
                    type: 'date',
                    labels: {
                        overlow: 'justify'
                    },
                    categories: $json6.data
                },
                yAxis: {
                    title: {
                        text: 'Qр%, м3/с'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                plotOptions: {
                    spline: {
                        lineWidth: 4,
                        states: {
                            hover: {
                                lineWidth: 5
                            }
                        },
                        marker: {
                            enabled: false
                        },
                    }
                },
                series: [{
                    name: 'Qр%',
                    data: $json6.Q,
                    tooltip: {
                    valueSuffix: 'м3/с'
                }
                }],
                navigation: {
                    menuItemStyle: {
                        fontSize: '10px'
                    }
                }
            });
            }    
        });
    });
});
        
$(function () {
    $("#weather_g").bind("click", function (e){
        e.preventDefault();
        $.ajax({
            method:'get',
            url:"weather.php",
            type:"GET",
            dataType: "json",
            success: function funcChart2($json7){
                 $('#weather_graph').highcharts({
                     chart:{
                        type: 'spline'   
                     },
                    title: {
                        text: 'Опади',
                        x: -20 //center
                    },
                    subtitle: {
                        text: '',
                        x: -20
                    },
                    xAxis: {
                        title:{
                            text:'Дата'
                        },
                        type: 'date',
                        categories: $json7.data
                    },
                    yAxis: {
                        title: {
                            text: 'Опади, мм'
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    plotOptions: {
                        spline: {
                            lineWidth: 4,
                            states: {
                                hover: {
                                    lineWidth: 5
                                }
                            },
                            marker: {
                                enabled: false
                            },
                        }
                    },
                    series: [{
                        name: 'Опади',
                        data: $json7.weather,
                        tooltip: {
                        valueSuffix: 'мм'
                    }
                    }]
            });
            }    
        });
    });
});
        
$(function () {
    $("#level").bind("click", function (e){
        e.preventDefault();
        $.ajax({
            method:'get',
            url:"level.php",
            type:"GET",
            dataType: "json",
            success: function funcChart3($data_level){
                $('#level_graph').highcharts({
                chart:{
                     type: 'spline'   
                },
                title: {
                    text: 'РІВЕНЬ ВОДИ В РІЧЦІ',
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    title:{
                        text:'Дата'
                    },
                    type: 'date',
                    categories: $data_level.data
                },
                yAxis: {
                    title: {
                        text: 'h, см'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                plotOptions: {
                        spline: {
                            lineWidth: 4,
                            states: {
                                hover: {
                                    lineWidth: 5
                                }
                            },
                            marker: {
                                enabled: false
                            },
                        }
                    },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: 'h',
                    data: $data_level.level,
                    tooltip: {
                    valueSuffix: 'см'
                }
                }]
            });
            }    
        });
    });
});
