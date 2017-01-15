<?php
include "on.php";

$value = $_GET['selectedValue'];
$value1 = $_GET['selectedValue1'];
$rajon = $_GET['selectedValue2'];
$value3 = $_GET['selectedValue3'];
$value4 = $_GET['selectedValue4'];

$query = "SELECT prec FROM weather";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result))
{
    $prec[]=$row['prec'];
}
$query = "SELECT x, xp FROM tabl18 WHERE id=$value";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result))
{
    $x=$row['x'];
    $xp=$row['xp'];
}

$query = "SELECT fi FROM tabl27 WHERE id=$value1";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result))
{
    $fi=$row['fi'];
}

if($value3 == 1)
{
    $query = "SELECT redkij FROM tabl26 WHERE id=$value4";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $nsk=$row['redkij'];
    }
}

if($value3 == 2)
{
    $query = "SELECT obuchnij FROM tabl26 WHERE id=$value4";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $nsk=$row['obuchnij'];
    }
}

if($value3 == 3)
{
    $query = "SELECT gust FROM tabl26 WHERE id=$value4";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $nsk=$row['gust'];
    }
}

/*for ($i =0;$i<10;$i++)
{
    $Fp[$i]=$_GET['fp'];
    echo $Fp[$i];

}
/* Для фск тск
if($value2 == 1)
{
    $query = "SELECT fi FROM tabl27 WHERE id=$value1";
    $result = mysql_query($query);
    while ($row = mysql_fetch_array($result))
    {
        $fi=$row['fi'];
    }
}*/


$json10 = json_encode(['prec' => $prec, 'x' => $x, 'xp' => $xp, 'fi' => $fi, 'nsk' => $nsk]);
echo $json10;
mysql_close($link);
?>