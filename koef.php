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

$query="SELECT  Q1, Q2 FROM `data_Q` WHERE id_inform = '$id'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$Q1= json_decode($row['Q1'],true);
$Q2 = json_decode($row['Q2'],true);
$a = 1*0;
$data = json_encode(['Q1'=>$Q1, 'Q2'=>$Q2, 'a'=>$a]);
echo $data;
mysql_close($link);
?>