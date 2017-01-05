<?php
include "on.php"; 
$value = $_REQUEST['value'];
$query = "SELECT x, xp FROM tabl18 WHERE id=$value";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result))
{
    $res1=$row['x'];
    $res2=$row['xp'];
}
$x = json_encode($res1);
$xp = json_encode($res2);
echo $x;
echo $xp;

?>