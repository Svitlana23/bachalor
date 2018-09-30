<?php
include_once('func.php');
authCheck();
$user_id=$_SESSION['user_id'];

include "on.php";

$begin_cor1 = new DateTime($_GET['begin_cor1']);
$begin_cor2 = new DateTime($_GET['begin_cor2']);
$end_cor1 = new DateTime($_GET['end_cor1']);
$end_cor2 = new DateTime($_GET['end_cor2']);
$end_cor1 = $end_cor1->modify( '+1 day' );
$end_cor2 = $end_cor2->modify( '+1 day' );

$n1 =date_diff($begin_cor1, $end_cor1);
$day1=$n1->format('%a');
//echo "<br> n = ".$day1."<br>";
$n2 =date_diff($begin_cor2, $end_cor2);
//$day2=$n2->format('%a');
//echo "<br> n = ".$day2."<br>";

$period1 = new DatePeriod($begin_cor1, new DateInterval('P1D'), $end_cor1);
$period2 = new DatePeriod($begin_cor2, new DateInterval('P1D'), $end_cor2);

$arrayOfDates1 = array_map(
    function($item){return $item->format('Ym');},
    iterator_to_array($period1)
);
$arrayOfDates2 = array_map(
    function($item){return $item->format('Ym');},
    iterator_to_array($period2)
);
$Data1 = array_map(
    function($item){return $item->format('Y-m-d');},
    iterator_to_array($period1)
);
$Data2 = array_map(
    function($item){return $item->format('Y-m-d');},
    iterator_to_array($period2)
);

$dates1 = array_map(
    function($item){return $item->format('d.m.Y');},
    iterator_to_array($period1)
);
$dates2 = array_map(
    function($item){return $item->format('d.m.Y');},
    iterator_to_array($period2)
);
$days1_cor1 = array_map(
    function($item){return $item->format('j');},
    iterator_to_array($period1)
);
$days1_cor2 = array_map(
    function($item){return $item->format('j');},
    iterator_to_array($period2)
);

include 'simple_html_dom.php';

$j1=$begin_cor1->format('j');
$sum_prec1 = array();
$sum_p1 = 0;
for($i=0; $i<$day1; $i++)
{
    $html1=file_get_html('http://www.eurometeo.ru/ukraina/chernyvetska-oblast/chernivci/archive/'.$arrayOfDates1[$i]);
    $days1= $html1->find('table.met8 th.bb',$days1_cor1[$i] - 1);
    if($days1)
    {
        $date1= $days1->find('em',0);
        $date1->outertext='';
        $date_cor1[]=$days1->innertext; 
        
        $e1 = $days1->parent();
        $osadki1 = $e1->next_sibling()->next_sibling()->next_sibling()->next_sibling()->next_sibling()->next_sibling()->
                next_sibling()->next_sibling()->next_sibling()->next_sibling();
        if($days1_cor1[$i]%2!= 0)
        {
            for($k=1;$k<=8;$k++)
            {
                $prec1=$osadki1->find('td em',$k)->innertext; 
                if ($prec1 == '')
                {
                    $prec1 = 0;
                }
                $sum_p1 += $prec1;
            }
        }
        else
        {
            for($k=9;$k<=16;$k++)
            {
                $prec1 = $osadki1->find('td em',$k)->innertext; 
                if ($prec1 == '')
                {
                    $prec1 = 0;
                }
                $sum_p1 += $prec1;
            }   
        }
    }
    
    else
    {
        $date_cor1[]="";
        $sum_p1 = 0;       
    }
    $sum_prec1[$i] = $sum_p1;
    $j1++;
    $sum_p1 = 0;
     
}

$j2=$begin_cor2->format('j');
$sum_prec2 = array();
$sum_p2 = 0;
for($i=0; $i<$day2; $i++)
{
    $html2=file_get_html('http://www.eurometeo.ru/ukraina/chernyvetska-oblast/chernivci/archive/'.$arrayOfDates2[$i]);
    $days2 = $html2->find('table.met8 th.bb',$days1_cor2[$i] - 1);
    if($days2)
    {
        $date2= $days2->find('em',0);
        $date2->outertext='';
        $date_cor2[]=$days2->innertext; 
        
        $e2 = $days2->parent();
        $osadki2 = $e2->next_sibling()->next_sibling()->next_sibling()->next_sibling()->next_sibling()->next_sibling()->
                next_sibling()->next_sibling()->next_sibling()->next_sibling();
        if($days1_cor2[$i]%2!= 0)
        {
            for($k=1;$k<=8;$k++)
            {
                $prec2=$osadki2->find('td em',$k)->innertext; 
                if ($prec2 == '')
                {
                    $prec2 = 0;
                }
                $sum_p2 += $prec2;
            }
        }
        else
        {
            for($k=9;$k<=16;$k++)
            {
                $prec2 = $osadki2->find('td em',$k)->innertext; 
                if ($prec2 == '')
                {
                    $prec2 = 0;
                }
                $sum_p2 += $prec2;
            }   
        }
    }
    
    else
    {
        $date_cor2[]="";
        $sum_p2 = 0;       
    }
    $sum_prec2[$i] = $sum_p2;
    $j2++;
    $sum_p2 = 0;
     
}
$data1 = json_encode($Data1);
$data2 = json_encode($Data2);
$data_weather1 = json_encode($sum_prec1);
$data_weather2 = json_encode($sum_prec2);

$result = mysql_query("SELECT id_inform FROM `data_q` WHERE id_user = '$user_id' ORDER BY id_inform DESC");

if(mysql_num_rows($result) == 0)
{
    $sql_in="INSERT INTO `data_q` (id_user, weather1, weather2, date1, date2) VALUES ('$user_id', '$data_weather1' , '$data_weather2', '$data1', '$data2')";
    mysql_query($sql_in);
}
else{
    $row = mysql_fetch_array($result);
    $id = $row['id_inform'];

    $sql_in="UPDATE `data_q` SET  weather1 = '$data_weather1', weather2 = '$data_weather2', date1 = '$data1', date2 = '$data2'   WHERE id_inform = '$id'";
    mysql_query($sql_in);
}

mysql_close($link);
?>
