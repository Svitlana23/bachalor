<?php
    include_once('func.php');
    redirectAUTH();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bachalor</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/ct-select-box.min.css">
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="js/highcharts.js"></script>
    <script src="js/exporting.js"></script>
    <script src="js/ct-select-box.min.js"></script>
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
                        'L':$('#L').val(),
                        'A':$("#A").val(),
                        'Ip':$("#Ip").val(),
                        'l':$("#l").val(),
                        'selectedValue': $('#x_xp').get(0).value, 
                        'selectedValue1': $('#_fi').get(0).value,
                        'selectedValue2': $("#rajon").get(0).text,
                        'selectedValue3': $("#_Tsk").get(0).text,
                        'selectedValue4': $('#_Lambda').get(0).value,
                        'selectedValue5': $('#_p').get(0).value
                    },
                    beforeSend: funcBefore,
                    success: function funcSuccess($json10) {
                    //document.querySelector('.data1').innerHTML += "";
                        //$json10 = JSON.parse($json10);
                        $L= "L = " +$json10.L;
                        $A= "A = " +$json10.A;
                        $Ip= "Ip = "+$json10.Ip;
                        $l= "l = "+$json10.l;
                        $b= "b = "+$json10.b;
                        $p= "p = "+$json10.p;
                        $r= "r = "+$json10.r;
                        $fi= "fi = "+$json10.fi;
                        $tsk= "tsk = "+$json10.tsk;
                        
                        var Fp = new Array ();
                        var q = new Array ();
                        var Q = new Array ();
                        for($i=0;$i<10;$i++)
                        {
                            Fp.push(parseFloat($json10.fp[$i]));
                            q.push(parseFloat($json10.q[$i]));
                            Q.push(parseFloat($json10.Q[$i]));
                        }
                        console.log($L);
                        console.log($A);
                        console.log($Ip);
                        console.log($l);
                        console.log($b);
                        console.log($p);
                        console.log($r);
                        console.log($fi);
                        console.log($tsk);
                        
                        for($i=0;$i<10;$i++)
                            {
                                console.log("Fp" + "[" + $i +"] = " + Fp[$i]);
                                console.log("q" + "[" + $i +"] = " + q[$i]);
                                console.log("Q" + "[" + $i +"] = " + Q[$i]);
                            }
                    }
            });
            });
        });
        
        $(function () {
            $("#submit1").bind("click", function (e){
                e.preventDefault();
                $.ajax({
                    method:'get',
                    url:"data_weather.php",
                    type:"GET",
                    dataType: "json",
                    data: {
                        'begin': $('#begin').val(),
                        'end': $('#end').val()
                    },
                    success: function funcS($json11){
//                        console.log("id = "+$json11.id);
//                        console.log("date= "+$json11.date);
                    }    
            });
            });
        });
        
        $(function () {
            $("#chart").bind("click", function (e){
                e.preventDefault();
                $.ajax({
                    method:'get',
                    url:"chart.php",
                    type:"GET",
                    dataType: "json",
                    success: function funcChart($json6){
                        console.log($json6);
                        $('#container2').highcharts({
                        title: {
                            text: 'МАКСИМАЛЬНИЙ СТОК ВОДИ РІЧОК ДОЩОВИХ ПАВОДКІВ',
                            x: -20 //center
                        },
                        subtitle: {
                        text: 'kbkbbkj',
                        x: -20
                    },
                        xAxis: {
                            title:{
                                text:'Дата'
                            },
                            type: 'date',
                            categories: $json6.data
                        },
                        yAxis: {
                            title: {
                                text: 'Qр%'
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
                            name: 'Qр%',
                            data: $json6.Q,
                            tooltip: {
                            valueSuffix: 'мм'
                        }
                        }]
                    });
                    }    
            });
            });
        });
    </script>
</head>
<body class="bod">
<a href="logout.php">Вихід</a>
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

<div class="text-center">
    <form action="" method="get">
        <input type="date" id="begin" name="" min="2017-01-01" max="2020-12-12" value="2017-01-01">
        <input type="date" id="end" name="" min="2017-01-01" max="2020-12-12" value="2017-01-01">
    <input type="button" id="submit1" value="Вибрати інтервал часу">
    </form>
</div>

<div>
    <h1 class="text-center">Розрахунки</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
               <form action="" method="get">
                <h2 class="text-center">Введіть дані</h2>
                <label for="L">Довжина водозбору L (км)= </label>
                <input type="text" name="L" id="L" size="10" value="7">
                <br>
                <label for="A">Площа водозбору A (км²)= </label>
                <input type="text" name="A" id="A" size="10" value="20">
                <br>
                <label for="Ip">Середньозважений ухил схилів басейну Ip (‰)= </label>
                <input type="text" name="Ip" id="Ip" size="10" value="11">
                <br>
                <label for="Isk">Середній ухил схилів басейну Isk (‰)= </label>
                <input type="text" name="Isk" id="Isk" size="10" value="15">
                <br>
                <label for="l">Середня довжина схилів басейнів l (км)= </label>
                <input type="text" name="l" id="l" size="10" value="8">
                <br>
                <?php
                    include "on.php"; 
                    $query = "SELECT * FROM `tabl18`";
                    $result = mysql_query($query) or die(mysql_error());
                    print '<select-box id="x_xp"  required placeholder="Оберіть характеристику русла і заплави">';
                    print '<select-box-header></select-box-header><select-box-content>';
                    while ($row = mysql_fetch_array($result)) { print '<select-box-option value="'.$row['id'].'">'.$row['Characteristika'].'</select-box-option>'; }
                    mysql_free_result($result);
                    print '</select-box-content></select-box>';
                   
                    $query = "SELECT * FROM `tabl27`";
                    $result = mysql_query($query) or die(mysql_error());
                    print '<select-box id="_fi"  required placeholder="Оберіть тип гірського району, типи грунтів">';
                    print '<select-box-header></select-box-header><select-box-content>';
                    while ($row = mysql_fetch_array($result)) { print '<select-box-option value="'.$row['id'].'">'.$row['type'].'</select-box-option>'; }
                    mysql_free_result($result);
                    print '</select-box-content></select-box>';
                    
                    $query = "SELECT * FROM `tabl20`";
                    $result = mysql_query($query) or die(mysql_error());
                    print '<select-box id="_Lambda"  required placeholder="Оберіть площу водозбору А (км²), середню висоту водозбору Н (м)">';
                    print '<select-box-header></select-box-header><select-box-content>';
                    while ($row = mysql_fetch_array($result)) { print '<select-box-option value="'.$row['number'].'">Район '.$row['raion']." Площа / висота ".$row['A_Hb'].'</select-box-option>'; }
                    mysql_free_result($result);
                    print '</select-box-content></select-box>';
                ?>

                <select-box id="rajon" required placeholder="Оберіть район кривих редукцій згідно карти">
                    <select-box-header></select-box-header>
                    <select-box-content>
                        <select-box-option value="1">7,8,10,29</select-box-option>
                        <select-box-option value="2">5,6,14,26,33,5в</select-box-option>
                        <select-box-option value="3">3,4,9,17,27,32</select-box-option>
                        <select-box-option value="4">2,12,16,24,28,30</select-box-option>
                        <select-box-option value="5">1,11,18,22, 31</select-box-option>
                        <select-box-option value="6">13,19,23,25,34</select-box-option>
                        <select-box-option value="7">15,20,21</select-box-option>
                        <select-box-option value="8">5г (Закарпатська низовина)</select-box-option>
                        <select-box-option value="9">5а (Північні схили Карпат)</select-box-option>
                        <select-box-option value="10">5б (Північні схили Карпат)</select-box-option>
                        <select-box-option value="11">6а (Північні схили Гірського Криму)</select-box-option>
                        <select-box-option value="12">6а (Південні схили Гірського Криму)</select-box-option>
                        <select-box-option value="13">6а (Керченський півострів)</select-box-option>
                </select-box-content>
                </select-box>
                
                <select-box id="_Tsk" required placeholder="Оберіть тривалість схилового добігання">
                    <select-box-header></select-box-header>
                    <select-box-content>
                        <select-box-option value="1">10</select-box-option>
                        <select-box-option value="2">30</select-box-option>
                        <select-box-option value="3">60</select-box-option>
                        <select-box-option value="4">100</select-box-option>
                        <select-box-option value="5">150</select-box-option>
                        <select-box-option value="6">200</select-box-option>
                </select-box-content>
                </select-box>
                
                <select-box id="_p" required placeholder="Оберіть ймовірність перевищення Р%">
                    <select-box-header></select-box-header>
                    <select-box-content>
                        <select-box-option value="1">0.1</select-box-option>
                        <select-box-option value="2">1</select-box-option>
                        <select-box-option value="3">2</select-box-option>
                        <select-box-option value="4">3</select-box-option>
                        <select-box-option value="5">5</select-box-option>
                        <select-box-option value="6">10</select-box-option>
                        <select-box-option value="7">25</select-box-option>
                </select-box-content>
                </select-box>
                <br>
                <input type="button" id="submit" value="Обчислити">
                <input type="button" id="chart" onclick="location.href='#container2'"  value="Отримати результат у вигляді графіка">
                </form>
            </div>
            <div class="col-md-4">
                
            </div>
            
            <div class="col-md-2">
               
            </div>
        </div>
    </div>
</div>


<div>
    <div id="container2">
    </div>
</div>
<script src="js/myscript.js"></script>
</body>
</html>