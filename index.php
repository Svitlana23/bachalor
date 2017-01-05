<!DOCTYPE html>
<html>
<head>
	<title>Bachalor</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
<!--    <script src="js/jquery.tooltip.min.js"></script>-->
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
<!--    <script src="ajax.js"></script>-->
    <script>
        function funcBefore(){
            $("#information").text("Очікування даних");
        }
        
        $(function () {
            $("#submit").bind("click", function (e){
                e.preventDefault();
                $.ajax({
                    method:'get',
                    url:"handler.php",
                    type:"GET",
                    dataType: "json",
                    data: {
                        'selectedValue': $('#x_xp').val(), 
                        'selectedValue1': $('#_fi').val()
                    },
                    beforeSend: funcBefore,
                    success: function funcSuccess($json10) {
                        for($i=0;$i<10;$i++)
                            {
                                document.querySelector('.demo').innerHTML += 'response: '+$json10.prec[$i] +'<br>';
                            }
                        
                        //$json10 = JSON.parse($json10);
                        $L=$("#L").val();
                        $A=$("#A").val();
                        $Ip=$("#Ip").val();
                        $xp = +$json10.xp;
                        $x = +$json10.x;
                        $fi = +$json10.fi;
                        $res=0;
                        for($i=0;$i<10;$i++)
                        {
                            $fp=(1000 * $L) / ( $xp * Math.pow($Ip,$x) * Math.pow($A,(1/4)) * Math.pow(($fi ), (1/4)));
                        }
                        $("#information").val($fp);
                        $("#information1").val($json10.prec);
                        console.log($json10.prec[1]);
                    }
                    
            });
            });
        });
    </script>
</head>
<body class="bod">

	<div>
		<h1 class="text-center">
			Розрахунок глибини затоплення
		</h1>
	</div>
	<div>
<form  action="">
                    <div class="container-fluid">
			            <div class="row">
                        <div class="col-md-2"></div>
			                <div class="col-md-5">
                            <div class="item">
                                <ul class="place1">
                                    <li>Площа водозбору води, F (км²):</li>
                                    <li>Швидкість води в ріці до початку паводку, V0 (м/с):</li>
                                    <li>Ширина дна ріки, a0 (м):</li>
                                    <li>Ширина ріки до паводку, b0 (м):</li>
                                    <li>Глибина ріки до паводку, h0 (м):</li>
                                    <li>Інтенсивність випадання осадків, J (мм/год):</li>
                                </ul>
                            </div>
                            </div>
                            <div class="col-md-2">
                            <div class="item">
                                <ul class="place2">
                                    <li><input  name="F" type="text" value="300" size="10"></li>
                                    <li><input  name="V0" type="text" value="2" size="10"></li>
                                    <li><input  name="a0" type="text" value="80" size="10"></li>
                                    <li><input  name="b0" type="text" value="100" size="10"></li>
                                    <li><input  name="h0" type="text" value="3" size="10"></li>
                                    <li><input  name="J" type="text" value="75" size="10"></li>
                                </ul>   
                            </div>
                        </div>
                        <div class="col-md-3"></div>
		            </div>
		            </div>
                    <div class="container">
		            <div class="row">
                       <div class="col-md-3"></div>
                       <div class="col-md-6">
                            <div class="text-center">
                                <input class="calc" type="button" name="send" value="Обчислити">
                            </div>
                        </div>
                        <div class="col-md-3"></div>   
                           
                    </div>
                    <div class="row">
                           <div class="col-md-3"></div>
                           <div class="col-md-6">
                           <div class="text-center">
                           <h4>Результат:</h4><br>
                            <p>Глибина затоплення:</p>
                            <input  name="h3" type="text" size="10">
                            <p>Швидкість потоку води під час паводку:</p>
                            <input  name="V3" type="text" size="10">
                            </div>
                            </div>
                            <div class="col-md-3"></div>

                        </div>
                    </div>
						</form>
    </div>

    
<div>
    
    <div>
        <form action="script_weather.php">
            <button>Ввести дані погоди в БД</button>
        </form>
    </div>
</div>

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

<div>
    <h1 class="text-center">Розрахунки</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
               <form action="">
                <h2 class="text-center">Введіть дані</h2>
                <label for="L">Довжина водозбору L (км)= </label>
                <input type="text" name="L" id="L" size="10" value="272">
                <br>
                <label for="A">Площа водозбору A (км²)= </label>
                <input type="text" name="A" id="A" size="10" value="27.5">
                <br>
                <label for="Ip">Середньозважений нахил водозбору Ip (‰)= </label>
                <input type="text" name="Ip" id="Ip" size="10" value="0.3">
                <br>
                <p>Для визначення проміжних параметрів x та xp виберіть:</p>
                <p>Характеристика русла і пойми</p>
                <?php
                    include "on.php"; 
                    $query = "SELECT * FROM `tabl18`";
                    $result = mysql_query($query) or die(mysql_error());
                    print '<td><SELECT name="" id="x_xp" required>';
                    while ($row = mysql_fetch_array($result)) { print '<option value="'.$row[id].'">'.$row['Characteristika'].'</option>'; }
                    mysql_free_result($result);
                    print'</select></td>';
                ?>
                <?php
                    include "on.php"; 
                    $query = "SELECT * FROM `tabl27`";
                    $result = mysql_query($query) or die(mysql_error());
                    print '<td><SELECT name="" id="_fi" required>';
                    while ($row = mysql_fetch_array($result)) { print '<option value="'.$row[id].'">'.$row['type'].'</option>'; }
                    mysql_free_result($result);
                    print'</select></td>';
                ?>
                <input type="button" id="submit" value="Обчислити">
                </form>
            </div>
            <div class="col-md-4">
                <h2 class="text-center">Результат</h2>
                <div>
                <label>Фр = </label>
                <input type="text" name="" id="information" size="10">
                <br>
                <input type="text" name="" id="information1" size="50">
                </div>
            </div>
            <div class="col-md-2">
               <p><b>Оберіть інтервал часу для розрахунку</b></p>
                Діапазон днів<br>
                    Від <input type="date" name="begin" min="2000-01-01" max="2020-12-12" value="2016-10-28">
                    До <input type="date" name="end" min="2000-01-01" max="2020-12-12" value="2016-10-28">
            </div>
        </div>
    </div>
</div>

<div class="demo"></div>
<!--<script src="ajax.js"></script>-->
<script src="js/myscript.js"></script>
</body>
</html>