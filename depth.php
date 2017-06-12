<?php
$F = $_GET['F'];//$("input[name=F]").val() * 1;
include_once('func.php');
authCheck();
$user_id=$_SESSION['user_id'];
include "on.php";
$result = mysql_query("SELECT id_inform FROM `data_q` WHERE id_user = '$user_id' ORDER BY id_inform DESC");

if(mysql_num_rows($result) == 0)
{
    exit(); 
}

$row = mysql_fetch_array($result);
$id = $row['id_inform'];

$query="SELECT Q, weather FROM `data_Q` WHERE id_inform = '$id'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$Q = json_decode($row['Q'],true);
$weather = json_decode($row['weather'],true);
$n=count($Q);
$q_sum = 0;
$weather_sum = 0;
for($i = 0; $i < $n; $i++){
    $q_sum += $Q[$i]; 
    $weather_sum += $weather[$i];
}
$q_ser = $q_sum / $n;
$x = $weather_sum / $n;
$t = $n *3600 *24;//t в секундах
$V = $q_ser * $t; 
$M1 = bcdiv(bcmul(pow(10, 3), $q_ser, 3), $F, 3);
$y = $V / ($F*1000);
//$y = bcmul(bcpow(10, -6, 10), bcmul($t, $M1,10), 10);

$a = $y / $weather_sum;
//----------------------------------------------
$M = $_GET['selectedValue'];
$V0 = $_GET['V0'];
$a0 = $_GET['a0'];
$b0 = $_GET['b0'];
$h0 = $_GET['h0'];
$J = $_GET['J'];
$S0 = 0.5 * ($a0 + $b0) * $h0;   
$Q0 = $V0 * $S0;
$Qmax = $Q0 + ( $J * $F) / 3.6;
$ctg = ($b0 - $a0) / (2 * $h0);
$h = pow((2 * $Qmax * pow((($b0 - $a0) / ($ctg + $ctg)),5/3)), 3/8) - ($b0 - $a0) / ($ctg + $ctg);
$b = $a0 + 2 * $h * $ctg;    
$Smax = 0.5 * ($a0 + $b) * $h;
$Vmax = $Qmax / $Smax;
$h3 = $h - $h0;
if($M == 1){
    if(($h3/ $h) <= 0.1)
    {
      $f=0.2;  
    }
    else if(($h3/ $h) <= 0.2 && ($h3/ $h) >=0.1)
    {
      $f=0.38;  
    }
    else if(($h3/ $h)  <= 0.4 && ($h3/ $h) >=0.2)
    {
      $f=0.6;  
    }
    else if(($h3/ $h) <= 0.6 && ($h3/ $h)>=0.4)
    {
      $f=0.76;  
    }
    else if(($h3/ $h) <= 0.8 && ($h3/ $h) >=0.6)
    {
      $f=0.92;  
    }
    else if(($h3/ $h) <= 1 && ($h3/ $h) >=0.8)
    {
      $f=1.22;  
    }
}
else if($M == 2){
    if(($h3/ $h) <= 0.1)
    {
      $f=0.23;  
    }
    else if(($h3/ $h) <= 0.2 && ($h3/ $h) >=0.1)
    {
      $f=0.43;  
    }
    else if(($h3/ $h)  <= 0.4 && ($h3/ $h) >=0.2)
    {
      $f=0.64;  
    }
    else if(($h3/ $h) <= 0.6 && ($h3/ $h)>=0.4)
    {
      $f=0.84;  
    }
    else if(($h3/ $h) <= 0.8 && ($h3/ $h) >=0.6)
    {
      $f=1.05;  
    }
    else if(($h3/ $h) <= 1 && ($h3/ $h) >=0.8)
    {
      $f=1.2;  
    }
}
else if($M == 3){
    if(($h3/ $h) <= 0.1)
    {
      $f=0.3;  
    }
    else if(($h3/ $h) <= 0.2 && ($h3/ $h) >=0.1)
    {
      $f=0.5;  
    }
    else if(($h3/ $h)  <= 0.4 && ($h3/ $h) >=0.2)
    {
      $f=0.72;  
    }
    else if(($h3/ $h) <= 0.6 && ($h3/ $h) >=0.4)
    {
      $f=0.96;  
    }
    else if(($h3/ $h) <= 0.8 && $h3/ $h >=0.6)
    {
      $f=1.17;  
    }
    else if(($h3/ $h) <= 1 && ($h3/ $h) >=0.8)
    {
      $f=1.32;  
    }
}

$V3 = $M * $f;
$h3 = number_format($h3,2);
$V3 = number_format($V3,2);

$depth = json_encode(['q_ser'=>$q_ser, 'V'=>$V, 'M1'=>$M1, 'y' => $y, 'a' => $a, 'h3' => $h3, 'V3' => $V3, 'M' =>$M]);
echo $depth;
mysql_close($link);
?>
