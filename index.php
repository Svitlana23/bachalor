<?php
    include_once('func.php');
    redirectAUTH();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bachalor</title>
    <meta charset="utf-8">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/ct-select-box.min.css">
    
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="js/highcharts.js"></script>
    <script src="js/exporting.js"></script>
    <script src="js/ct-select-box.min.js"></script>
    <script src="js/spearson.js"></script>
<!--
    <script>
        
    var x = [3, 4, 5];
    var y = [78, 57, 65];
    var corr = spearson.correlation.spearman(x, y);
        console.log("corr = " + corr);
</script>
-->
   
    <script>
        
        $(function () {
            $("#correl").bind("click", function (e){
                e.preventDefault();
                $.ajax({
                    method:'get',
                    url:"correlation_arrays.php",
                    type:"GET",
                    dataType: "json",
                    data: {
                        'begin_cor1': $('#begin_cor1').val(),
                        'begin_cor2': $('#begin_cor2').val(),
                        'end_cor1': $('#end_cor1').val(),
                        'end_cor2': $('#end_cor2').val()
                    },
                    success: function funcS($cor){
                       var corr = spearson.correlation.spearman($cor.Q, $cor.Q);
                        console.log("corr = " + corr);
                    }    
            });
            });
        });
        
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
                    }
            });
            });
        });
        
        $(function () {
            $("#weather").bind("click", function (e){
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
                       
                    }    
            });
            });
        });
        
$(function () {
    $("#river_level").bind("click", function (e){
        e.preventDefault();
        $.ajax({
            method:'get',
            url:"depth.php",
            type:"GET",
            dataType: "json",
            data: {
                'F':$('#F').val(),
                'V0':$('#V0').val(),
                'a0':$('#a0').val(),
                'b0':$('#b0').val(),
                'h0':$('#h0').val(),
                'J':$('#J').val()
            },
            success: function depth($depth){
                console.log("q_ser = " + $depth.q_ser);
                console.log("V = " + $depth.V);
                console.log("M1 = " + $depth.M1);
                console.log("y = " + $depth.y);
                console.log("a = " + $depth.a);
                console.log("h3 = " + $depth.h3);
                console.log("V3 = " + $depth.V3);
                $('#h3').val($depth.h3);
                $('#V3').val($depth.V3);
                $('#res1').text("y = " + $depth.y);
                $('#res2').text("a = " + $depth.a);
            }    
    });
    });
});
        
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
    </script>
</head>
<body>

<header id="home">
      <nav>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">
              <nav class="pull">
                <ul class="top-nav">
                  <li><a href="#depth">Розрахунок глибини затоплення <span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                  <li><a href="#prediction">Прогнозування стоку води <span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                  <li><a href="#prut">ГІС р.Прут<span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                  <li><a href="#correlation">Кореляція<span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </nav>
      <section class="hero" id="hero">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-right navicon">
              <a id="nav-toggle" class="nav_slide_button" href="#"><span></span></a>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center inner">
              <h1 class="animated fadeInDown">DANA<span>GIS</span></h1>
              <p class="animated fadeInUp delay-05s">Інформаційна система прогнозування <em>паводків</em></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
              <a href="#prut" class="learn-more-btn">Прогнозування р. Прут</a>
            </div>
          </div>
        </div>
      </section>
</header>
   
    <section class="intro text-center section-padding" id="depth">
      <div class="container">
        <div class="row">
         <div class="col-md-8 col-md-offset-2 wp1">
             <h1 class="arrow">Розрахунок глибини затоплення</h1>
         </div>
         
         <div class="col-md-5 col-md-offset-2 text-left">
            <h4>Площа водозбору води, F (км²): <input name="F" id="F" type="text" value="200" size="10"></h4>
            <h4>Швидкість води в річці до початку паводку, V0 (м/с): <input  name="V0" id="V0" type="text" value="1" size="10"></h4>
            <h4>Ширина дна ріки, a0 (м): <input  name="a0" id="a0" type="text" value="80" size="10"></h4>
        </div>
        <div class="col-md-4 text-left">
            <h4>Ширина ріки до паводку, b0 (м): <input  name="b0" id="b0" type="text" value="100" size="10"></h4>
            <h4>Інтенсивність випадання осадків, J (мм/год): <input  name="J" id="J" type="text" value="25" size="10"></h4>
            <h4>Глибина ріки до паводку, h0 (м): <input  name="h0" id="h0" type="text" value="1" size="10"></h4>
        </div>
        <div></div>
        <div class="col-md-8 col-md-offset-2 text-center">
            <input id="river_level" type="button" name="send" value="Обчислити">
            <h1>Результат:</h1>
            <div class="col-md-4 col-md-offset-1 text-left">
                <h3>Глибина затоплення: <input  name="h3" id="h3" type="text" size="15"></h3>
            </div>
            <div class="col-md-7 text-left">
                <h3>Швидкість потоку води під час паводку: <input  name="V3" id="V3" type="text" size="15"></h3>
            </div>
        </div>
      </div>
  </div>
</section>

<section class="text-center" id="prediction">
    <div class="container">
       <div class="row">
           <h1>Прогнозування стоку води</h1>
           <br>
       </div>
       <div class="container">
           <div class="row">
              <form action="" method="get">
                  <div class="col-md-4"></div>
                  <div class="col-md-2">
                      <input type="date" id="begin" name="" min="2017-01-01" max="2020-12-12" value="2017-01-01">
                       <br>
                       <br>
                        <input type="date" id="end" name="" min="2017-01-01" max="2020-12-12" value="2017-01-01">
                  </div>
                  <div class="col-md-6 text-left">
                      <input type="button" id="weather"  value="Записати погоду">
                      
                  </div>  
            </form>
           </div>
<div class="row">
    <form action="" method="get">
       <div class="row">
       <div class="col-md-2"></div>
        <div class="col-md-6 text-center">
             <table id="input_data">
                 <tr>
                     <th>
                         <label for="L">Довжина водозбору L (км) </label>
                     </th>
                     <th>
                         <input type="text" name="L" id="L" size="10" value="7">
                     </th>
                 </tr>
                 <tr>
                     <th>
                         <label for="A">Площа водозбору A (км²) </label>
                     </th>
                     <th>
                         <input type="text" name="A" id="A" size="10" value="20">
                     </th>
                 </tr>
                <tr>
                     <th>
                         <label for="Ip">Середньозважений ухил схилів басейну Ip (‰) </label>
                     </th>
                     <th>
                         <input type="text" name="Ip" id="Ip" size="10" value="11">
                     </th>
                 </tr>
                <tr>
                     <th>
                         <label for="Isk">Середній ухил схилів басейну Isk (‰) </label>
                     </th>
                     <th>
                         <input type="text" name="Isk" id="Isk" size="10" value="15">
                     </th>
                 </tr>
                <tr>
                     <th>
                         <label for="l">Середня довжина схилів басейнів l (км) </label>
                     </th>
                     <th>
                         <input type="text" name="l" id="l" size="10" value="8">
                     </th>
                 </tr>
             </table>
          </div>
          <div class="col-md-2 text-center">
              
                <table>
                    <tr>
                        <th>
                            <select-box id="rajon" required placeholder="Оберіть район кривих редукцій згідно карти поданої нижче">
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
                        </th>
                        <th>
                           <?php
                            include "on.php"; 
                                $query = "SELECT * FROM `tabl20`";
                                $result = mysql_query($query) or die(mysql_error());
                                print '<select-box id="_Lambda"  required placeholder="Оберіть площу водозбору А (км²), середню висоту водозбору Н (м)">';
                                print '<select-box-header></select-box-header><select-box-content>';
                                while ($row = mysql_fetch_array($result)) { 
                                    print '<select-box-option value="'.$row['number'].'">Район '.$row['raion']." Площа / висота ".$row['A_Hb'].'</select-box-option>'; 
                                }
                                mysql_free_result($result);
                                print '</select-box-content></select-box>';
                            ?>
                        </th>
                    </tr>
                    <tr>
                        <th>
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
                        </th>
                        <th>
                            <?php
                                $query = "SELECT * FROM `tabl18`";
                                $result = mysql_query($query) or die(mysql_error());
                                print '<select-box id="x_xp"  required placeholder="Оберіть характеристику русла і заплави">';
                                print '<select-box-header></select-box-header><select-box-content>';
                                while ($row = mysql_fetch_array($result)) { 
                                    print '<select-box-option value="'.$row['id'].'">'.$row['Characteristika'].'</select-box-option>'; 
                                }
                                mysql_free_result($result);
                                print '</select-box-content></select-box>';
                            ?>
                        </th>
                    </tr>
                    <tr>
                        <th>
                           <?php
                                $query = "SELECT * FROM `tabl27`";
                                $result = mysql_query($query) or die(mysql_error());
                                print '<select-box id="_fi"  required placeholder="Оберіть тип гірського району, типи грунтів">';
                                print '<select-box-header></select-box-header><select-box-content>';
                                while ($row = mysql_fetch_array($result)) { 
                                    print '<select-box-option value="'.$row['id'].'">'.$row['type'].'</select-box-option>'; 
                                }
                                mysql_free_result($result);
                                print '</select-box-content></select-box>';
                            ?>
                        </th>
                        <th>
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
                        </th>
                    </tr>
                </table>
           </div>
       </div>
       <div class="row">
           <div class="col-md-6 text-right">
               <input type="button" id="submit" value="Обчислити">
           </div>
           <div class="col-md-6 text-left">
               <input type="button" id="level" onclick="location.href='#level_graph'"  value="Рівень води">
               <input type="button" id="weather_g" onclick="location.href='#weather_graph'"  value="Погода">
               <input type="button" id="Q" onclick="location.href='#Q_graph'"  value="Стік води">
           </div>
       </div>         
    </form>
    </div>
    </div>
</div>
</section>



<!--
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
                    /*include "on.php"; 
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
                    print '</select-box-content></select-box>';*/
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

-->
<div class="container">
    <div class="row">
        <div class="col-md-6 text-center">
            <div id="weather_graph">
            </div>
        </div>
        <div class="col-md-6 text-center">
            <div id="Q_graph">
            </div>
            <div id="level_graph">
</div>
        </div>
    </div>
</div>



<div class="text-center">
    <img src="img/map_reduction.jpg" id="map_reduction" alt="">
</div>
    
    
<section class="intro text-center section-padding" id="correlation">
<div class="container">
    <div class="row">
     <div class="col-md-8 col-md-offset-2 wp1">
         <h1 class="arrow">Кореляція</h1>
     </div>
        <div class="col-md-4"></div>
        </div>
         <div class="row">
          <form action="" method="get">
              <div class="col-md-2"></div>
              <div class="col-md-4 text-right">
                 <br>
                  Q1 = <input type="date" id="begin_cor1" name="" min="2017-01-01" max="2020-12-12" value="2017-01-01">
                  <br>
                  <br>
                  Q2 = <input type="date" id="begin_cor2" name="" min="2017-01-01" max="2020-12-12" value="2017-01-01">
              </div>
              <div class="col-md-4 text-left">
                 <br>
                  <input type="date" id="end_cor1" name="" min="2017-01-01" max="2020-12-12" value="2017-01-01">
                   <br>
                   <br>
                    <input type="date" id="end_cor2" name="" min="2017-01-01" max="2020-12-12" value="2017-01-01">
              </div>
              <div class="col-md-2">
                  <input type="button" id="correl"  value="Здійснити кореляцію">

              </div>  
        </form>
        </div>
  
</div>
</section>
<a href="logout.php">Вихід</a>
<!--<script src="js/myscript.js"></script>-->
<script src="js/scripts.js"></script>
<script src="js/waypoints.min.js"></script>
</body>
</html>