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
                $query="SELECT  weather, date_interval FROM `data_Q` WHERE id_inform = '$id'";
                $result = mysql_query($query);
                $row = mysql_fetch_array($result);
                $weather = json_decode($row['weather'],true);
                $date_interval = json_decode($row['date_interval'],true);
                
                $json7 = json_encode(['weather'=>$weather, 'data'=>$date_interval]);
                echo $json7;
                mysql_close($link);
?>