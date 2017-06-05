<?php
include_once('func.php');
authCheck();
$user_id=$_SESSION['user_id'];

include "on.php";

$begin = new DateTime($_GET['begin']);
$end = new DateTime($_GET['end']);
$end = $end->modify( '+1 day' );

$n =date_diff($begin, $end);
$day=$n->format('%a');
echo "<br> n = ".$day."<br>";

$period = new DatePeriod($begin, new DateInterval('P1D'), $end);

$arrayOfDates = array_map(
    function($item){return $item->format('Ym');},
    iterator_to_array($period)
);
$Data = array_map(
    function($item){return $item->format('Y-m-d');},
    iterator_to_array($period)
);

$dates = array_map(
    function($item){return $item->format('d.m.Y');},
    iterator_to_array($period)
);
$days1 = array_map(
    function($item){return $item->format('j');},
    iterator_to_array($period)
);

include 'simple_html_dom.php';

$j=$begin->format('j');
$sum_prec = array();
$sum_p = 0;
for($i=0; $i<$day; $i++)
{
    $html=file_get_html('http://www.eurometeo.ru/ukraina/chernyvetska-oblast/chernivci/archive/'.$arrayOfDates[$i]);
    $days= $html->find('table.met8 th.bb',$days1[$i] - 1);
    if($days)
    {
        $date= $days->find('em',0);
        $date->outertext='';
        $date1[]=$days->innertext; 
        
        $e = $days->parent();
        $osadki = $e->next_sibling()->next_sibling()->next_sibling()->next_sibling()->next_sibling()->next_sibling()->
                next_sibling()->next_sibling()->next_sibling()->next_sibling();
        if($days1[$i]%2!= 0)
        {
            for($k=1;$k<=8;$k++)
            {
                $prec=$osadki->find('td em',$k)->innertext; 
                if ($prec == '')
                {
                    $prec = 0;
                }
                $sum_p += $prec;
            }
        }
        else
        {
            for($k=9;$k<=16;$k++)
            {
                $prec=$osadki->find('td em',$k)->innertext; 
                if ($prec == '')
                {
                    $prec = 0;
                }
                $sum_p += $prec;
            }   
        }
    }
    
    else
    {
        $date1[]="";
        $sum_p = 0;       
    }
    $sum_prec[$i] = $sum_p;
    $j++;
    $sum_p = 0;
    
    $query="SELECT level FROM `water_level` WHERE data='$Data[$i]'";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    $level1[$i] = $row['level']/100; 
}

    $data = json_encode($Data);
    $data_weather = json_encode($sum_prec);
    $level = json_encode($level1);
    $sql_in="INSERT INTO `data_q` (id_user, date_interval, weather, level) VALUES ('$user_id' , '$data', '$data_weather', '$level')";
    mysql_query($sql_in);
mysql_close($link);
?>
