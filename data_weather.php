<?php
include "on.php";

$begin = new DateTime($_GET['begin']);
$end = new DateTime($_GET['end']);

$n =date_diff($begin, $end);
$day=$n->format('%a');
//echo "<br> n = ".$day."<br>";

$period = new DatePeriod($begin, new DateInterval('P1D'), $end);

$arrayOfDates = array_map(
    function($item){return $item->format('Y-m-d');},
    iterator_to_array($period)
);
//виводим масив дат
//print_r($arrayOfDates);

include 'simple_html_dom.php';



    $query1 = mysql_query("SELECT MAX(id) FROM weather");  
    $max_id = mysql_result($query1, 0);

for($i=0; $i<$day; $i++)
{
  /*  $query="SELECT date FROM weather WHERE date='$arrayOfDates[$i]'";
    $result = mysql_query($query[$i]);
    while ($row = mysql_fetch_array($result))
    {
        $date[]=$row['date'];
    }
    */
    $html=file_get_html('https://sinoptik.ua/погода-черновцы/'.$arrayOfDates[$i]);
    
    if($html->find('td.p5'))
    {
        $temperature = $html->find('td.p5',2)->innertext;
        $humidity= $html->find('td.p5',5)->innertext;
        $precipitation = $html->find('td.p5',7)->innertext;  
    }
    else
    {
        $temperature = $html->find('td.p3',2)->innertext;
        $humidity= $html->find('td.p3',5)->innertext;
        $precipitation = $html->find('td.p3',7)->innertext;      
    }
    
    if ($precipitation == '-')
    {
        $precipitation=0;
    }
    
  /*  $query="SELECT date FROM weather WHERE date='$arrayOfDates[$i]'";
    $row=mysql_query($query);
   
    if(!row)
    {
        $query1 = mysql_query("SELECT MAX(id) FROM weather");  
        $max_id = mysql_result($query1, 0);
    */
        $date=$arrayOfDates[$i];
        $id = $i+1;  
  
    $query="INSERT  INTO weather VALUES ('$id','$temperature','$humidity','$precipitation','$date')";
        mysql_query($query);
   /* }
    else {
        echo "Запис існує!";
    } */
    
}
    
   

 
/*$json11=json_encode(['id'=>$max_id, 'date'=>$date]);
echo $json11;*/
mysql_close($link);
?>
