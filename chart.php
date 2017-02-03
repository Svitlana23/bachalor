<?php
                include "on.php";
                $query="SELECT Q, date FROM `data_Q`";
                $res = mysql_query($query);
                while ($row = mysql_fetch_array($res))
                {
                    $Q[]=array((double)$row['Q']);
                    $data[]=array($row['date']);
                }
                $json6 = json_encode(['Q'=>$Q, 'data'=>$data]);
                echo $json6;
                mysql_close($link);
?>