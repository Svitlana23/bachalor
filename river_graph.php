<?php
include_once('func.php');
authCheck();
include "on.php";

$query="SELECT * FROM `build_river`";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
    $zz[] = json_decode($row['z'],true);
    $x[] = json_decode($row['x'],true);
}
$json35 = json_encode(['zz'=>$zz, 'x'=>$x]);
echo $json35;
mysql_close($link);
?>