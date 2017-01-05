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

//    $id = array();
//    $сharacteristika = array();
//    $x = array();
//    $xp = array();
//    $query="SELECT id,Characteristika,x,xp FROM `tabl18`";
//    $res = mysql_query($query);
//    while ($row = mysql_fetch_array($res))
//    {
//        $id[]=array((int)$row['id']);
//        $сharacteristika[]=array($row['Characteristika']);
//        $x[]=array((double)$row['x']);
//        $xp[]=array((double)$row['xp']);
//    }
//    $json1 = json_encode($id);
//    //$json2 = json_encode($сharacteristika);
//    $json3 = json_encode($x);
//    $json4 = json_encode($xp);
    ?>