<?php

    $dblocation = "127.0.0.1";   
      $dbuser = "root";   
      $dbpasswd = "";   
    ini_set('max_execution_time', 900);
      $link = mysql_connect($dblocation, $dbuser, $dbpasswd);   
      if (!$link) {
        die("Підключення не встановленно: <br>" . mysql_error() . "<br>");
    }  
     mysql_select_db('river_flooding');
mysql_query ("set character_set_client='utf8'"); 
mysql_query ("set character_set_results='utf8'"); 
mysql_query ("set collation_connection='utf8_general_ci'");
    ?>