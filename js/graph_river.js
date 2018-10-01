$(function () {
    $("#river_g").bind("click", function (e){
        e.preventDefault();
        $.ajax({
            method:'get',
            url:"river_graph.php",
            type:"GET",
            dataType: "json",
            success: function funcChart1($json35){
                $('#river_graph').highcharts({
                    chart:{
                        type: 'spline'
                    },
                    title: {
                        text: '',
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
                        categories: $json35.x
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
                        name: 'H',
                        data: $json35.zz,
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