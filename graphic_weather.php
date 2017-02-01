<div>
    <div id="container">
        </div>
</div>

<div>
    <?php
    include "on.php";
    $data = array();
    $query="SELECT date,temp,hum,wind,prec FROM `weather`";
    $res = mysql_query($query);
    while ($row = mysql_fetch_array($res))
    {
        $data[]=array($row['date']);
        $temperature[]=array((int)$row['temp']);
        $hum[]=array((int)$row['hum']);
        $wind[]=array((int)$row['wind']);
        $prec[]=array((int)$row['prec']);
    }
    $json1 = json_encode($data);
    $json2 = json_encode($temperature);
    $json3 = json_encode($hum);
    $json4 = json_encode($wind);
    $json5 = json_encode($prec);
    mysql_close($link);
?>

<script type="text/javascript">    
    $(function () {
    $('#container').highcharts({
        title: {
            text: 'Погодні показники',
            x: -20 //center
        },
        subtitle: {
            text: 'Source:sinoptik.ua',
            x: -20
        },
        xAxis: {
            title:{
                text:'Дата'
            },
            type: 'date',
            categories: <?=$json1?>
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
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
        series: [{
            name: 'Температура',
            data: <?=$json2?>,
            tooltip: {
            valueSuffix: '°C'
        }
        },
            {
            name: 'Вологість',
            data: <?=$json3?>,
            tooltip: {
            valueSuffix: '%'
        }
        },
                {
            name: 'Вітер',
            data: <?=$json4?>,
            tooltip: {
            valueSuffix: 'м/с'
        }
        },
                {
            name: 'Осадки',
            data: <?=$json5?>,
            tooltip: {
            valueSuffix: '%'
        }
        }]
    });
});
</script>
</div>