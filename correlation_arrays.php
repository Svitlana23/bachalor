<?php
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

$begin_cor1 = new DateTime($_GET['begin_cor1']);
$begin_cor2 = new DateTime($_GET['begin_cor2']);
$end_cor1 = new DateTime($_GET['end_cor1']);
$end_cor2 = new DateTime($_GET['end_cor2']);

$query="SELECT Q FROM `data_Q` WHERE id_inform = '$id'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$Q = json_decode($row['Q'],true);

$cor = json_encode(['Q'=>$Q]);
echo $cor;
mysql_close($link);

?>
