<?php
include "on.php";

$value = $_GET['selectedValue'];
$value1 = $_GET['selectedValue1'];

$query = "SELECT prec FROM weather";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result))
{
    $prec=$row['prec'];
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

$json10 = json_encode(['prec' => $prec, 'x' => $x, 'xp' => $xp, 'fi' => $fi]);
echo $json10;
mysql_close($link);
?>