<?php
include "on.php";

$value = $_GET['selectedValue'];

$query = "SELECT prec FROM weather";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result))
{
    $data=$row['prec'];
}
$query = "SELECT x, xp FROM tabl18 WHERE id=$value";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result))
{
    $res1=$row['x'];
    $res2=$row['xp'];
}
$x = json_encode($res1);
$xp = json_encode($res2);

$json10 = json_encode(['data' => $data, 'x' => $x, 'xp' => $xp]);
echo $json10;
mysql_close($link);
?>