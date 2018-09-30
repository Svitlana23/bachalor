<?php
    include_once('func.php');
    include_once('on.php');
    redirectAUTH();
    $user_id=$_SESSION['user_id'];
    $result = mysql_query("SELECT username FROM `users` WHERE id_user = '$user_id'");
    $row = mysql_fetch_array($result);
    $username = $row['username'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Bachalor</title>
    <meta charset="utf-8">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/ct-select-box.min.css">
    <link rel="stylesheet" type="text/css" href="css/examples.css" />
    <link rel="stylesheet" href="css/modal_window.css">
    <link rel="stylesheet" type="text/css" href="css/my_style.css">
    <script src="js/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ct-select-box.min.js"></script>
<!--    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>-->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>
<!--    <script async defer src="https://maps.googleapis.com/maps/api/js?v=3&key=YOUR_API_KEY&callback=initMap">-->
    <script type="text/javascript" src="js/gmaps.js"></script>
    <script src="js/highcharts.js"></script>
    <script src="js/exporting.js"></script>
    <script src="js/spearson.js"></script>
    <script src="js/modal_window.js"></script>
    <script src="js/graphics.js"></script>
    <script src="js/river.js"></script>
</head>
<body>
<header>
<nav role='navigation'>
 <div class="col-md-10">
  <ul>
    <li><a href="#prediction">Стік води в річці</a></li>
    <li><a href="#depth">Розрахунок глибини затоплення</a></li>
    <li><a href="#prut">Розлиття р. Прут</a></li>
<!--    <li><a href="#correlation">Кореляція</a></li>-->
    <li><a href="logout.php">Вихід</a></li>
  </ul>
  </div>
    <div class="col-md-2 user">
        Привіт, <?php echo "".$username." " ?>
    </div>
</nav>  
</header>
<section class="hero" id="hero">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-right navicon">
          <a id="nav-toggle" class="nav_slide_button" href="#"><span></span></a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center inner">
          <h1 class="animated fadeInDown">DANA<span>GIS</span></h1><br>
          <p class="animated fadeInUp delay-05s main_name">Web-орієнтована система моніторингу та оцінки гідрологічних характеристик річки Прут</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
          <a href="#prut" class="learn-more-btn">Карта р. Прут</a>
        </div>
      </div>
    </div>
</section>

<!--Прогнозування стоку води-->
<section class="text-center" id="prediction">
    <div class="container">
       <div class="row">
           <h1>Стік води в річці</h1>
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
                        <input type="date" id="end" name="" min="2017-01-01" max="2020-12-12" value="2017-01-01"><br>
                  </div>
                  <div class="col-md-6 text-left">
                      <input type="button" id="weather" class="btn_weath" value="Записати погоду">
                      
                  </div>  
            </form>
           </div>
    <form action="" method="get">
       <div class="row">
       <div class="col-md-4"></div>
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
          <div class="col-md-2">
           </div>
       </div>
       <div class="row">
       <div class="col-md-4 text-center">
       </div>
        <div class="col-md-4 text-center">
             
                            <select-box id="rajon" required placeholder="Район кривих редукцій">
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
                        
                           <?php
                            include "on.php"; 
                                $query = "SELECT * FROM `tabl20`";
                                $result = mysql_query($query) or die(mysql_error());
                                print '<select-box id="_Lambda"  required placeholder="Площа, висота водозбору">';
                                print '<select-box-header></select-box-header><select-box-content>';
                                while ($row = mysql_fetch_array($result)) { 
                                    print '<select-box-option value="'.$row['number'].'">Район '.$row['raion']." Площа / висота ".$row['A_Hb'].'</select-box-option>'; 
                                }
                                mysql_free_result($result);
                                print '</select-box-content></select-box>';
                            ?>
                        
                            <select-box id="_p" required placeholder="Ймовірність перевищення Р%">
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
                        
                            <?php
                                $query = "SELECT * FROM `tabl18`";
                                $result = mysql_query($query) or die(mysql_error());
                                print '<select-box id="x_xp"  required placeholder="Характеристика русла і заплави">';
                                print '<select-box-header></select-box-header><select-box-content>';
                                while ($row = mysql_fetch_array($result)) { 
                                    print '<select-box-option value="'.$row['id'].'">'.$row['Characteristika'].'</select-box-option>'; 
                                }
                                mysql_free_result($result);
                                print '</select-box-content></select-box>';
                            ?>
                        
                           <?php
                                $query = "SELECT * FROM `tabl27`";
                                $result = mysql_query($query) or die(mysql_error());
                                print '<select-box id="_fi"  required placeholder="Тип гірського району, типи грунтів">';
                                print '<select-box-header></select-box-header><select-box-content>';
                                while ($row = mysql_fetch_array($result)) { 
                                    print '<select-box-option value="'.$row['id'].'">'.$row['type'].'</select-box-option>'; 
                                }
                                mysql_free_result($result);
                                print '</select-box-content></select-box>';
                            ?>
                        
                            <select-box id="_Tsk" required placeholder="Тривалість схилового добігання">
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
                <br>
          </div>
          <div class="col-md-4 text-left">
             <br>
             <br>
             <br>
             <br>
             <br>
              <input type="button" class="maps" id="m2"  value="Райони параметра λP%">
              <br>
              <input type="button" class="maps" id="m3" value="Райони кривих редукцій">
                
           </div>
       </div>
    <div>
        <img src="img/map_reduction.jpg" id="map2" alt="">
    </div>
    <div>
        <img src="img/map.jpg" id="map_reduction" alt="">
    </div>          
       <div class="row">
           <div class="col-md-6 text-right">
               <input type="button" id="submit" class="btn_res" value="Обчислити">
           </div>
           <div class="col-md-6 text-left">
               <input type="button" class="btn_graph" id="weather_g" onclick="location.href='#weather_graph'"  value="Погода">
               <input type="button" class="btn_graph" id="level" onclick="location.href='#level_graph'"  value="Рівень води">
               <input type="button" class="btn_graph" id="Q" onclick="location.href='#Q_graph'"  value="Стік води">
           </div>
       </div>  
       <div class="container">
    <div class="row">
        <div class="col-md-4 text-center">
            <div id="weather_graph">
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div id="level_graph">
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div id="Q_graph">
            </div>
        </div>
    </div>
</div>       
    </form>
    </div>
</div>
</section>


<!--Розрахунок глибини затоплення-->
<section class="intro text-center section-padding" id="depth">
  <div class="container">
    <div class="row">
     <div class="col-md-8 col-md-offset-2">
         <h1 class="arrow">Розрахунок глибини затоплення</h1>
     </div>
    </div>
    <div class="row">
     <div class="col-md-6 text-center">
        <h4>Площа водозбору води, F (км²): <input name="F" id="F" type="text" value="200" size="10"></h4>
        <h4>Швидкість води в річці до початку паводку, V0 (м/с): <input  name="V0" id="V0" type="text" value="1" size="10"></h4>
        <h4>Ширина дна ріки, a0 (м): <input  name="a0" id="a0" type="text" value="80" size="10"></h4>
    </div>
    <div class="col-md-6 text-center">
        <h4>Ширина ріки до паводку, b0 (м): <input  name="b0" id="b0" type="text" value="100" size="10"></h4>
        <h4>Інтенсивність випадання осадків, J (мм/год): <input  name="J" id="J" type="text" value="25" size="10"></h4>
        <h4>Глибина ріки до паводку, h0 (м): <input  name="h0" id="h0" type="text" value="1" size="10"></h4>
    </div>
    <div class="row">
      <div class="col-md-11 text-center">
           <center>
            <select-box id="M" required placeholder="Оберіть морфологічний показник русла ріки">
                <select-box-header></select-box-header>
                <select-box-content>
                    <select-box-option value="1">1,25</select-box-option>
                    <select-box-option value="2">1,5</select-box-option>
                    <select-box-option value="3">2</select-box-option>
                </select-box-content>
            </select-box>
            </center>
        </div>
        </div>
        <div class="row">
           <div class="col-md-12 text-center">
            <input id="river_level" class="btn_res" type="button" name="send" value="Обчислити">
            </div>
        </div>
    <div class="row">
    <div class="col-md-12 text-center">
        <div class="res">
            <center><h1>Результат:</h1></center>
            <div class="col-md-6">
                <h4>Глибина затоплення, м: <input  name="h3" id="h3" type="text" size="15"></h4>

            </div>
            <div class="col-md-6">
                <h4>Швидкість потоку води під час паводку, м/с: <input  name="V3" id="V3" type="text" size="15"></h4>
            </div>
            <div class="col-md-12">
                <h4>Шар стоку, у: <input  name="res1" id="res1" type="text" size="15"></h4>
            </div>
        </div>
    </div>
  </div>
</div>
</div>
</section>

<section class="intro text-center section-padding" id="prut">
    <div class="container">
        <div class="row">
          <div class="col-md-12">
             <h1 class="arrow">Розлиття р. Прут</h1>
         </div>
          <center>
           <form method="get">
            <input type="date" name="day" id="day" min="2015-07-20" max="2017-12-12" value="2016-08-10">
            <button id="submit2"> Побудувати річку </button>
            </form>
            </center>
        </div>
    </div>
    <div class="row">
            <div class="span11">
            <div id="map"></div>
        </div>
        </div>
</section>


<!-- Кореляція-->
<section class="intro text-center section-padding" id="correlation">
<div class="container">
    <div class="row">
     <div class="col-md-8 col-md-offset-2">
         <h1 class="arrow">Кореляція</h1>
     </div>
        <div class="col-md-4"></div>
        </div>
         <div class="row">
          <form action="" method="get">
              <div class="col-md-2"></div>
              <div class="col-md-4 text-right">
                  Q1 = <input type="date" id="begin_cor1" name="" min="2012-01-01" max="2020-12-12" value="2017-01-01">
                  <br>
                  <br>
                  Q2 = <input type="date" id="begin_cor2" name="" min="2012-01-01" max="2020-12-12" value="2016-01-01">
              </div>
              <div class="col-md-2 text-left">
                  <input type="date" id="end_cor1" name="" min="2012-01-01" max="2020-12-12" value="2017-01-01">
                   <br>
                   <br>
                    <input type="date" id="end_cor2" name="" min="2012-01-01" max="2020-12-12" value="2016-01-01">
              </div>
              <div class="col-md-4 text-left">
                  <input type="button" id="cor_weather" class="btn_weath" value="Записати погоду">
              </div>  
              
        </form>
        </div>
        <div class="container">
    <div class="row">
        <form action="" method="get">
           <div class="row">
            <div class="col-md-4 text-center">
                <br>
                 <table id="input_data">
                     <tr>
                         <th>
                             <label for="L">Довжина водозбору L (км) </label>
                         </th>
                         <th>
                             <input type="text" name="L" id="L1" size="10" value="7">
                         </th>
                     </tr>
                     <tr>
                         <th>
                             <label for="A">Площа водозбору A (км²) </label>
                         </th>
                         <th>
                             <input type="text" name="A" id="A1" size="10" value="20">
                         </th>
                     </tr>
                    <tr>
                         <th>
                             <label for="Ip">Середньозважений ухил схилів басейну(‰) </label>
                         </th>
                         <th>
                             <input type="text" name="Ip" id="Ip1" size="10" value="11">
                         </th>
                     </tr>
                    <tr>
                         <th>
                             <label for="Isk">Середній ухил схилів басейну Isk (‰) </label>
                         </th>
                         <th>
                             <input type="text" name="Isk" id="Isk1" size="10" value="15">
                         </th>
                     </tr>
                    <tr>
                         <th>
                             <label for="l">Середня довжина схилів басейнів l (км) </label>
                         </th>
                         <th>
                             <input type="text" name="l" id="l1" size="10" value="8">
                         </th>
                     </tr>
                 </table>
              </div>
              <div class="col-md-4 text-center">
                <br>
                    <table>
                        <tr>
                            <th>
                                <select-box id="rajon1" required placeholder="Оберіть район кривих редукцій згідно карти поданої нижче">
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
                        </tr>
                        <tr>
                            <th>
                                <select-box id="_p1" required placeholder="Оберіть ймовірність перевищення Р%">
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
                        </tr>
                        <tr>
                            <th>
                               <?php
                                    $query = "SELECT * FROM `tabl27`";
                                    $result = mysql_query($query) or die(mysql_error());
                                    print '<select-box id="_fi1"  required placeholder="Оберіть тип гірського району, типи грунтів">';
                                    print '<select-box-header></select-box-header><select-box-content>';
                                    while ($row = mysql_fetch_array($result)) { 
                                        print '<select-box-option value="'.$row['id'].'">'.$row['type'].'</select-box-option>'; 
                                    }
                                    mysql_free_result($result);
                                    print '</select-box-content></select-box>';
                                ?>
                            </th>
                        </tr>
                    </table>
               </div>
               <div class="col-md-4 text-center">
                  <br>
                   <table>
                       <tr>
                            <th>
                               <?php
                                include "on.php"; 
                                    $query = "SELECT * FROM `tabl20`";
                                    $result = mysql_query($query) or die(mysql_error());
                                    print '<select-box id="_Lambda1"  required placeholder="Оберіть площу водозбору А (км²), середню висоту водозбору Н (м)">';
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
                                <?php
                                    $query = "SELECT * FROM `tabl18`";
                                    $result = mysql_query($query) or die(mysql_error());
                                    print '<select-box id="x_xp1"  required placeholder="Оберіть характеристику русла і заплави">';
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
                                <select-box id="_Tsk1" required placeholder="Оберіть тривалість схилового добігання">
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
               <div class="col-md-12 text-center">
                    <input type = "button" id = "correl" class="btn_res" value = "Розрахувати кореляцію">
               </div>
           </div> 
              <div class="row">
               <div class="col-md-12">
                    <center><input type = "text"  id = "inp_cor" value = "" size = "10"></center>
               </div>
           </div> 
        </form>
        </div>
        </div>

    </div>
</section>


<a href="" id="go"></a>
<div id="modal_form"><!-- Сaмo oкнo --> 
      <span id="modal_close">X</span> <!-- Кнoпкa зaкрыть --> 
      <h1>Очікуйте завантаження даних!</h1>
</div>
<div id="overlay"></div><!-- Пoдлoжкa -->

<a href="" id="window_weather"> </a>
<div id="modal_form1"><!-- Сaмo oкнo --> 
      <span id="modal_close1">X</span> <!-- Кнoпкa зaкрыть --> 
      <h1>Оберіть інтервал!</h1>
</div>
<div id="overlay1"></div><!-- Пoдлoжкa -->

<script>
    $('#m2').click(function() { 
        if($('#map2').css('display')=='block'){
            $('#map2').css('display', 'none');
        }
        else{
            $('#map2').css('display', 'block');
        }
    })
    $('#m3').click(function() { 
        if($('#map_reduction').css('display')=='block'){
            $('#map_reduction').css('display', 'none');
        }
        else{
            $('#map_reduction').css('display', 'block');
        }
    })
    $('#river_level').click(function() { 
            $('.res').css('display', 'block');
    })
    $('#correl').click(function() { 
            $('#inp_cor').css('display', 'block');
    })
</script>
</body>
</html>