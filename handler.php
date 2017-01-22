<?php
include "on.php";

$x_xp = $_GET['selectedValue'];
$_fi = $_GET['selectedValue1'];
$_rajon = $_GET['selectedValue2'];
$_tsk = $_GET['selectedValue3'];

$L = $_GET['L'];
$A = $_GET['A'];
$Ip = $_GET['Ip'];
$l = $_GET['l'];

$query = "SELECT x, xp FROM tabl18 WHERE id=$x_xp";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result))
{
    $x=$row['x'];
    $xp=$row['xp'];
}

$query = "SELECT fi FROM tabl27 WHERE id=$_fi";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result))
{
    $fi=$row['fi'];
}

$query = "SELECT prec FROM weather";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result))
{
    $prec[]=$row['prec'];
}

for($i=0;$i<10;$i++)
{
    $fp[$i]=(1000 * $L) / ( $xp * $Ip * pow($A,(1/4)) * pow(($fi * $prec[$i]), (1/4)));
    /*if ($fp[$i] == "Infinity")
    {
         $fp[$i] = 0;
    }*/
}
for($i=0;$i<10;$i++)
{
   $query = "SELECT a FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[]=$row['a'];
        }
Ї
    /*if(($fp[$i] == 0))
   {
        $query = "SELECT 0 FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['0'];
        }
   }
    
    if(($fp[$i] > 0) && ($fp[$i] <= 1))
   {
        $query = "SELECT 1 FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['1'];
        }
   }
    
    if(($fp[$i] > 1) && ($fp[$i] <= 5))
   {
        $query = "SELECT 5 FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['5'];
        }
   }
    
    if(($fp[$i] > 5) && ($fp[$i] <= 10))
   {
        $query = "SELECT 10 FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['10'];
        }
   }
    
    if(($fp[$i] > 10) && ($fp[$i] <= 20))
   {
        $query = "SELECT `20` FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['20'];
        }
   }
    
    if(($fp[$i] > 20) && ($fp[$i] <= 30))
   {
        $query = "SELECT `30` FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['30'];
        }
   }
    
   if(($fp[$i] > 30) && ($fp[$i] <= 40))
   {
        $query = "SELECT 40 FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['40'];
        }
   } 
    
    if(($fp[$i] > 40) && ($fp[$i] <= 50))
   {
        $query = "SELECT 50 FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['50'];
        }
   }
    
    if(($fp[$i] > 50) && ($fp[$i] <= 60))
   {
        $query = "SELECT 60 FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['60'];
        }
   }
    
    if(($fp[$i] > 60) && ($fp[$i] <= 70))
   {
        $query = "SELECT 70 FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['70'];
        }
   }
    
    if(($fp[$i] > 70) && ($fp[$i] <= 80))
   {
        $query = "SELECT 80 FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['80'];
        }
   }
    
    if(($fp[$i] > 80) && ($fp[$i] <= 90))
   {
        $query = "SELECT 90 FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['90'];
        }
   }
    
    if(($fp[$i] > 90) && ($fp[$i] <= 100))
   {
        $query = "SELECT 100 FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['100'];
        }
   }
    
    if(($fp[$i] > 100) && ($fp[$i] <= 150))
   {
        $query = "SELECT 150 FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['150'];
        }
   }
    
    if(($fp[$i] > 150) && ($fp[$i] <= 200))
   {
        $query = "SELECT 200 FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['200'];
        }
   }
    
    if(($fp[$i] > 200) && ($fp[$i] <= 250))
   {
        $query = "SELECT 250 FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['250'];
        }
   }
    
    if(($fp[$i] > 250) && ($fp[$i] <= 300))
   {
        $query = "SELECT 300 FROM tabl21 WHERE rajon=$_rajon AND Tsk=$_tsk";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result))
        {
            $q[$i]=$row['300'];
        }
   }*/



/*

if($value3 == 1)
{
    $query = "SELECT redkij FROM tabl26 WHERE id=$_nsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $nsk=$row['redkij'];
    }
}

if($value3 == 2)
{
    $query = "SELECT obuchnij FROM tabl26 WHERE id=$_nsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $nsk=$row['obuchnij'];
    }
}

if($value3 == 3)
{
    $query = "SELECT gust FROM tabl26 WHERE id=$_nsk";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $nsk=$row['gust'];
    }
}
'prec' => $prec, 'x' => $x, 'xp' => $xp, 'fi' => $fi, 'nsk' => $nsk,
*/


$json10 = json_encode(['L' => $L, 'A' => $A, 'Ip' => $Ip, 'l' => $l, 'fp' => $fp, 'q' => $q]);
echo $json10;
mysql_close($link);
?>