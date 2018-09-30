<?php
include_once('func.php');
authCheck();
$user_id=$_SESSION['user_id'];
include "on.php";

$x_xp = $_GET['selectedValue'];
$_fi = $_GET['selectedValue1'];
$_rajon = $_GET['selectedValue2'];
$_tsk = $_GET['selectedValue3'];
$_lambda = $_GET['selectedValue4'];
$_p = $_GET['selectedValue5'];

$L = $_GET['L1'];
$A = $_GET['A1'];
$Ip = $_GET['Ip1'];
$l = $_GET['l1'];
$b=1;

$query = "SELECT x, xp FROM tabl18 WHERE id = $x_xp";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result))
{
    $x = $row['x'];
    $xp = $row['xp'];
}

$query = "SELECT fi FROM tabl27 WHERE id = $_fi";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result))
{
    $fi = $row['fi'];
}

$query = "SELECT weather1, weather2 FROM `data_q` WHERE id_user = '$user_id' ORDER BY id_inform DESC";//сортувати за спаданням і взяти перший запис
$result = mysql_query($query);
if(mysql_num_rows($result) == 0)
{
    echo "<script>alert(\"ЗАПИСУ НЕМАЄ!\");</script>";
}
$row = mysql_fetch_array($result);
$prec1 = $row['weather1'];
$prec2 = $row['weather2'];
$prec1 = json_decode($prec1,true);
$prec2 = json_decode($prec2,true);

$n1 = count($prec1);
$n2 = count($prec2);
for($i=0;$i<$n1;$i++)
{
    $d = ($xp * $Ip * pow($A,(1/4)) * pow(($fi * $prec1[$i]), (1/4)));
    if($d!=0){
        $fp1[$i]=(1000 * $L) / $d;
    }
    else{
        $fp1[$i] = 0;
    }
    
}
for($i=0;$i<$n2;$i++)
{
    $d = ($xp * $Ip * pow($A,(1/4)) * pow(($fi * $prec2[$i]), (1/4)));
    if($d!=0){
        $fp2[$i]=(1000 * $L) / ($xp * $Ip * pow($A,(1/4)) * pow(($fi * $prec2[$i]), (1/4)));
    }
    else{
        $fp2[$i]=0;
    }
    
}

if($_p == 1)
{
    $query = "SELECT `p0.1` FROM `tabl20` WHERE number=$_lambda";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $p=$row['p0.1'];
    }
}

if($_p == 2)
{
    $query = "SELECT `p1` FROM `tabl20` WHERE number=$_lambda";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $p=$row['p1'];
    }
}

if($_p == 3)
{
    $query = "SELECT `p2` FROM `tabl20` WHERE number=$_lambda";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $p=$row['p2'];
    }
}

if($_p == 4)
{
    $query = "SELECT `p3` FROM `tabl20` WHERE number=$_lambda";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $p=$row['p3'];
    }
}

if($_p == 5)
{
    $query = "SELECT `p5` FROM `tabl20` WHERE number=$_lambda";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $p=$row['p5'];
    }
}

if($_p == 6)
{
    $query = "SELECT `p10` FROM `tabl20` WHERE number=$_lambda";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $p=$row['p10'];
    }
}

if($_p == 7)
{
    $query = "SELECT `p25` FROM `tabl20` WHERE number=$_lambda";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $p=$row['p25'];
    }
}

for($i=0;$i<$n1;$i++)
{
if(($fp1[$i] == 0))
{
    $query = "SELECT f0 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f0'];
    }
}
    
if(($fp1[$i] > 0) && ($fp1[$i] <= 1))
{
    $query = "SELECT f1 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f1'];
    }
}
    
if(($fp1[$i] > 1) && ($fp1[$i] <= 5))
{
    $query = "SELECT f5 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f5'];
    }
}

if(($fp1[$i] > 5) && ($fp1[$i] <= 10))
{
    $query = "SELECT f10 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f10'];
    }
}

if(($fp1[$i] > 10) && ($fp1[$i] <= 20))
{
    $query = "SELECT `f20` FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f20'];
    }
}

if(($fp1[$i] > 20) && ($fp1[$i] <= 30))
{
    $query = "SELECT `f30` FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f30'];
    }
}

if(($fp1[$i] > 30) && ($fp1[$i] <= 40))
{
    $query = "SELECT f40 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f40'];
    }
} 

if(($fp1[$i] > 40) && ($fp1[$i] <= 50))
{
    $query = "SELECT f50 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f50'];
    }
}

if(($fp1[$i] > 50) && ($fp1[$i] <= 60))
{
    $query = "SELECT f60 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f60'];
    }
}

if(($fp1[$i] > 60) && ($fp1[$i] <= 70))
{
    $query = "SELECT f70 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f70'];
    }
}

if(($fp1[$i] > 70) && ($fp1[$i] <= 80))
{
    $query = "SELECT f80 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f80'];
    }
}

if(($fp1[$i] > 80) && ($fp1[$i] <= 90))
{
    $query = "SELECT f90 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f90'];
    }
}

if(($fp1[$i] > 90) && ($fp1[$i] <= 100))
{
    $query = "SELECT f100 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f100'];
    }
}

if(($fp1[$i] > 100) && ($fp1[$i] <= 150))
{
    $query = "SELECT f150 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f150'];
    }
}

if(($fp1[$i] > 150) && ($fp1[$i] <= 200))
{
    $query = "SELECT f200 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f200'];
    }
}

if(($fp1[$i] > 200) && ($fp1[$i] <= 250))
{
    $query = "SELECT f250 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f250'];
    }
}

if(($fp1[$i] > 250) && ($fp1[$i] <= 300))
{
    $query = "SELECT f300 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q1[$i]=$row['f300'];
    }
}
    
}

for($i=0;$i<$n2;$i++)
{
if(($fp2[$i] == 0))
{
    $query = "SELECT f0 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f0'];
    }
}
    
if(($fp2[$i] > 0) && ($fp2[$i] <= 1))
{
    $query = "SELECT f1 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f1'];
    }
}
    
if(($fp2[$i] > 1) && ($fp2[$i] <= 5))
{
    $query = "SELECT f5 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f5'];
    }
}

if(($fp2[$i] > 5) && ($fp2[$i] <= 10))
{
    $query = "SELECT f10 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f10'];
    }
}

if(($fp2[$i] > 10) && ($fp2[$i] <= 20))
{
    $query = "SELECT `f20` FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f20'];
    }
}

if(($fp2[$i] > 20) && ($fp2[$i] <= 30))
{
    $query = "SELECT `f30` FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f30'];
    }
}

if(($fp2[$i] > 30) && ($fp2[$i] <= 40))
{
    $query = "SELECT f40 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f40'];
    }
} 

if(($fp2[$i] > 40) && ($fp2[$i] <= 50))
{
    $query = "SELECT f50 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f50'];
    }
}

if(($fp2[$i] > 50) && ($fp2[$i] <= 60))
{
    $query = "SELECT f60 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f60'];
    }
}

if(($fp2[$i] > 60) && ($fp2[$i] <= 70))
{
    $query = "SELECT f70 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f70'];
    }
}

if(($fp2[$i] > 70) && ($fp2[$i] <= 80))
{
    $query = "SELECT f80 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f80'];
    }
}

if(($fp2[$i] > 80) && ($fp2[$i] <= 90))
{
    $query = "SELECT f90 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f90'];
    }
}

if(($fp2[$i] > 90) && ($fp2[$i] <= 100))
{
    $query = "SELECT f100 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f100'];
    }
}

if(($fp2[$i] > 100) && ($fp2[$i] <= 150))
{
    $query = "SELECT f150 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f150'];
    }
}

if(($fp2[$i] > 150) && ($fp2[$i] <= 200))
{
    $query = "SELECT f200 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f200'];
    }
}

if(($fp2[$i] > 200) && ($fp2[$i] <= 250))
{
    $query = "SELECT f250 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f250'];
    }
}

if(($fp2[$i] > 250) && ($fp2[$i] <= 300))
{
    $query = "SELECT f300 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q2[$i]=$row['f300'];
    }
}
    
}

for($i=0;$i<$n1;$i++)
{
    $data_Q1[$i]= $q1[$i] * $fi * $prec1[$i] * $b * $_lambda * $A;
}
for($i=0;$i<$n2;$i++)
{
    $data_Q2[$i]= $q2[$i] * $fi * $prec2[$i] * $b * $_lambda * $A;
}

$Q1 = json_encode($data_Q1);
$Q2 = json_encode($data_Q2);



$result = mysql_query("SELECT id_inform FROM `data_q` WHERE id_user = '$user_id' ORDER BY id_inform DESC");

if(mysql_num_rows($result) == 0)
{
   exit(); 
}

$row = mysql_fetch_array($result);
$id = $row['id_inform'];
$sql_in="UPDATE `data_q` SET Q1 = '$Q1', Q2 = '$Q2' WHERE id_inform = '$id'";
mysql_query($sql_in);

$cor = json_encode(['Q1' => $data_Q1, 'Q2' => $data_Q2]);
echo $cor;
mysql_close($link);
?>
