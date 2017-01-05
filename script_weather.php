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

date_default_timezone_set('UTC');
$interval = new DateInterval('P1D');
/*
$begin=new DateTime($_GET['begin']);
$end=new DateTime($_GET['end']);
//$interval=$end->diff($begin);//кількість днів DateInterval
$res=$end->diff($begin);
$res=$res->format("%a"); //кількість днів in numders
*/
function Parse($p1,$p2,$p3){
$num1=strpos($p1,$p2);//Возвращает позицию первого вхождения подстроки
if($num1===false) return 0; 
$num2=substr($p1, $num1);//Возвращает подстроку
return strip_tags(substr($num2, 0, strpos($num2, $p3)));
}

$string[0]='https://sinoptik.ua/%D0%BF%D0%BE%D0%B3%D0%BE%D0%B4%D0%B0-%D1%87%D0%B5%D1%80%D0%BD%D0%BE%D0%B2%D1%86%D1%8B/';
/*
$query="SELECT MAX(id) FROM `weather`";
$res = mysql_query($query);
if (!$res) { 
echo "Ошибка выполнения запроса!<br>".mysql_error(); 
die; 
}
$now_id = (int)mysql_result($res, 0);
echo $now_id;
*/
$now=new DateTime(date('Y-m-d'));
for($i=0;$i<10;$i++){
    
    $url=$string[0];
    $url=$url.$now->format('Y-m-d');
    $query=file_get_contents ($url);
    $str='<tbody>';
    $data= Parse($query, $str,'</tbody>');

    $array=split(' ',$data);
    if(isset($array[92])) {
        $_temp= (int) $array[42];
        $_hum=$array[72];
        $_wind=$array[82];
        $_prec=$array[92];
    }
    else {
        $_temp= (int)$array[24];
        $_hum=$array[42];
        $_wind=$array[48];
        $_prec=$array[54]; 
    }
    $_date=$now->format('Y-m-d');
    //$_day=$now->format('Y-m-d');
    $id=$i+1;
    
    
    if($_prec=='-') $_prec=0;
    //echo $_temp." ".$_hum." ".$_wind." ".$_prec.";                 ";
    $sql_in="INSERT INTO weather VALUES ('$id','$_temp','$_hum','$_wind','$_prec','$_date')";
    mysql_query($sql_in);
    $url=$url.$now->add($interval)->format('Y-m-d');
       } 

/*$sql_out="SELECT * FROM 'weather'";
if ($res=mysql_query($sql_out)){ 
			while($row=mysql_fetch_assoc($res)){
       echo '<tr><td>ID: '.$row['id'].'</td><td>Температура'.$row['temp'].'</td><td>Вологість'.$row['hum'].'</td><td>Вітер'.$row['wind'].'</td><td>Імовірність опадів'.$row['prec'].'</td></tr>';
            }
}*/
/*
function Parse($p1,$p2,$p3,$kilk){
for($i=0;$i<=$kilk;$i++)
{
  $num1[$i]=strpos($p1,$p2);
if($num1[$i]===false) return 0; 
$num2[$i]=substr($p1, $num1[$i]);
return strip_tags(substr($num2[$i], 0, strpos($num2[$i], $p3)));
}
}

$begin=new DateTime($_GET['begin']);
$end=new DateTime($_GET['end']);
$res=$end->diff($begin);//кількість днів 
$res=$res->format("%a");
$a="https://sinoptik.ua/%D0%BF%D0%BE%D0%B3%D0%BE%D0%B4%D0%B0-%D1%87%D0%B5%D1%80%D0%BD%D0%BE%D0%B2%D1%86%D1%8B/";
for($i=0;$i<=$res;$i++)
{
    $string[$i]=file_get_contents ($a."2016-10-28"); 
    $str[$i]='<tbody>';
    $now[$i]= Parse($string[$i], $str[$i],'</tbody>', $res);
}
for($i=0;$i<=$res;$i++){
    $array=split(' ',$now[$i]);
    
    if(isset($array[92])) {
    $_temp[$i]= (int) $array[43];
    $_hum[$i]=$array[73];
    $_wind[$i]=$array[83];
    $_prec[$i]=$array[93];
    }
    else {
    $_temp[$i]=(int)$array[24];
    $_hum[$i]=$array[42];
    $_wind[$i]=$array[48];
    $_prec[$i]=$array[54];
}
}
    for($i=0;$i<=$res;$i++)
    {
        echo $_temp[$i]." ".$_hum[$i]." ".$_wind[$i]." ".$_prec[$i]."\r\n";
    }
*/
mysql_close($link);
?>
