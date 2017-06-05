<?php
//витягти з сесії ід користувача
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

$L = $_GET['L'];
$A = $_GET['A'];
$Ip = $_GET['Ip'];
$l = $_GET['l'];
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

$query = "SELECT weather FROM `data_q` WHERE id_user = '$user_id' ORDER BY id_inform DESC";//сортувати за спаданням і взяти перший запис
$result = mysql_query($query);
if(mysql_num_rows($result) == 0)
{
    echo "<script>alert(\"ЗАПИСУ НЕМАЄ!\");</script>";
}
$row = mysql_fetch_array($result);
$prec = $row['weather'];
$prec = json_decode($prec,true);

$n = count($prec);
for($i=0;$i<$n;$i++)
{
    $fp[$i]=(1000 * $L) / ( $xp * $Ip * pow($A,(1/4)) * pow(($fi * $prec[$i]), (1/4)));
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

for($i=0;$i<$n;$i++)
{
if(($fp[$i] == 0))
{
    $query = "SELECT f0 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f0'];
    }
}
    
if(($fp[$i] > 0) && ($fp[$i] <= 1))
{
    $query = "SELECT f1 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f1'];
    }
}
    
if(($fp[$i] > 1) && ($fp[$i] <= 5))
{
    $query = "SELECT f5 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f5'];
    }
}

if(($fp[$i] > 5) && ($fp[$i] <= 10))
{
    $query = "SELECT f10 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f10'];
    }
}

if(($fp[$i] > 10) && ($fp[$i] <= 20))
{
    $query = "SELECT `f20` FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f20'];
    }
}

if(($fp[$i] > 20) && ($fp[$i] <= 30))
{
    $query = "SELECT `f30` FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f30'];
    }
}

if(($fp[$i] > 30) && ($fp[$i] <= 40))
{
    $query = "SELECT f40 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f40'];
    }
} 

if(($fp[$i] > 40) && ($fp[$i] <= 50))
{
    $query = "SELECT f50 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f50'];
    }
}

if(($fp[$i] > 50) && ($fp[$i] <= 60))
{
    $query = "SELECT f60 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f60'];
    }
}

if(($fp[$i] > 60) && ($fp[$i] <= 70))
{
    $query = "SELECT f70 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f70'];
    }
}

if(($fp[$i] > 70) && ($fp[$i] <= 80))
{
    $query = "SELECT f80 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f80'];
    }
}

if(($fp[$i] > 80) && ($fp[$i] <= 90))
{
    $query = "SELECT f90 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f90'];
    }
}

if(($fp[$i] > 90) && ($fp[$i] <= 100))
{
    $query = "SELECT f100 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f100'];
    }
}

if(($fp[$i] > 100) && ($fp[$i] <= 150))
{
    $query = "SELECT f150 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f150'];
    }
}

if(($fp[$i] > 150) && ($fp[$i] <= 200))
{
    $query = "SELECT f200 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f200'];
    }
}

if(($fp[$i] > 200) && ($fp[$i] <= 250))
{
    $query = "SELECT f250 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f250'];
    }
}

if(($fp[$i] > 250) && ($fp[$i] <= 300))
{
    $query = "SELECT f300 FROM tabl21 WHERE rajon='$_rajon' AND Tsk=$_tsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $q[$i]=$row['f300'];
    }
}
    
}

for($i=0;$i<$n;$i++)
{
    $data_Q[$i]= $q[$i] * $fi * $prec[$i] * $b * $_lambda * $A;
}

$Q = json_encode($data_Q);
$result = mysql_query("SELECT id_inform FROM `data_q` WHERE id_user = '$user_id' ORDER BY id_inform DESC");

if(mysql_num_rows($result) == 0)
{
   exit(); 
}

$row = mysql_fetch_array($result);
$id = $row['id_inform'];
$sql_in="UPDATE `data_q` SET Q = '$Q' WHERE id_inform = '$id'";
mysql_query($sql_in);
mysql_close($link);
?>