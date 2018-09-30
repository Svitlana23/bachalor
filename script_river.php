<?php

// INFO ------------------------------------------------------------------------
// level - рівень води     (from Table  water_level)
// array - бегери           (from Table  river_board_new)
// river - ГІС              (from Table  build_river)
//------------------------------------------------------------------------------

    include_once("on.php");
    mysql_select_db('river_flooding');
    mysql_query ("set character_set_client='utf8'");
    mysql_query ("set character_set_results='utf8'");
    mysql_query ("set collation_connection='utf8_general_ci'");

//------------------------------------------------------------------------------

$day = $_GET['day'];                                                            // день


mysql_query("SET group_concat_max_len = 10000;");
$result = mysql_query("SELECT * FROM water_level WHERE data='$day'");
$row    = mysql_fetch_array($result);
    //if($row==false){
    //echo json_encode(['draw1'=>[]]);
    //exit;
    //}
$level = $row['level'];                                                         // рівень воды (Table :: water_level)
$d = ($level - 42)/100;                                                            // delta


$array=[];
$result = mysql_query("SELECT * FROM river_board_new");
while ($row = mysql_fetch_array($result))
{
    $array[] = ['x'=>$row['x'], 'y1'=>$row['y1'], 'y2'=>$row['y2']];            // береги (from Table river_board_new)
}


$river=[];
$result = mysql_query("SELECT * FROM build_river_2");
while ($row = mysql_fetch_array($result))
{
    if(!array_key_exists($row['x'],$river)){
        $river[$row['x']]=[];
    }
    $river[$row['x']][] = ['y'=>$row['y'], 'z'=>$row['z']];                     // gis коррдинати (from Table build_river)
    //$my_river[] = [$row['y'], $row['x']];
}
$river_x = array_keys($river);

//------------------------------------------------------------------------------

$deltaLNG = 0.0008333333;
$deltaLAT = 0.0008333333;

$draw1=[];                                                                      //нижній берег РУЧНИЙ
$draw2=[];                                                                      //верхній берег РУЧНИЙ
$draw3=[];                                                                      //нижній берег ГІС
$draw4=[];                                                                      //верхній берег ГІС
$draw5=[];                                                                      //нижній берег ПІДТОПЛЕННЯ
$draw6=[];                                                                      //верхній берег ПІДТОПЛЕННЯ


// ---------Досліжувана область//


// ЛІНІЇ БЕРЕГІВ (РУЧНИЙ)-------------------------------------------------------
foreach ($array as $item)
{
    $draw1[]=[$item['y1'],$item['x']];
}


foreach(array_reverse($array) as $item)
{
    $draw2[]=[$item['y2'],$item['x']];
}

// Визначення ГІС-координат берегів ------------------------------------------

function minLength($x1,$y1,$x2,$y2)
{
    return sqrt( abs(($x2-$x1)*($x2-$x1)+($y2-$y1)*($y2-$y1) ));
}


foreach ($array as $item)
{


    $min_x = $river_x[0];
    foreach($river_x as $x)
    {
        if(abs($min_x - $item['x'])>abs($x - $item['x']))
        {
            $min_x = $x;
        }
    }

    $min_y1 = 0;
    foreach($river[$min_x] as $index=>$point)
    {
        if(minLength($min_x,$point['y'],$item['x'],$item['y1']) < minLength($min_x,$river[$min_x][$min_y1]['y'],$item['x'],$item['y1'])){
            $min_y1 = $index;
        }
    }

    $min_y2 = 0;
    foreach($river[$min_x] as $index=>$point)
    {
        if(minLength($min_x,$point['y'],$item['x'],$item['y2']) < minLength($min_x,$river[$min_x][$min_y2]['y'],$item['x'],$item['y2'])){
            $min_y2 = $index;
        }
    }

     $draw3[]=[$river[$min_x][$min_y1]['y'],$min_x];
     $draw4[]=[$river[$min_x][$min_y2]['y'],$min_x];

// ЛІНІЇ ПІДТОПЛЕННЯ -----------------------------------------------------------


    $z1 = $river[$min_x][$min_y1]['z'] + $d;
    $z2 = $river[$min_x][$min_y2]['z'] + $d;

    $avg1 = [];
    $avg2 = [];
    foreach ($river[$min_x] as $index=>$point)
    {
        if($point['y'] < $river[$min_x][$min_y1]['y'])
        {
            if( $point['z'] <= $z1)
            {
                $avg1[] = $point['y'];
                //$draw5[] = [$point['y'], $min_x];

            }
        }

        if($point['y'] > $river[$min_x][$min_y2]['y'])
        {
            if( $point['z'] <= $z2)
            {
                $avg2[] = $point['y'];
                //$draw6[] = [$point['y'], $min_x];
            }
        }

    }
    if(count($avg1)>0){
        $y1 = array_sum($avg1)/count($avg1);
        $draw5[] = [$y1, $min_x];
    }
    if(count($avg2)>0){
        $y2 = array_sum($avg2)/count($avg2);
        $draw6[] = [$y2, $min_x];
    }
}


//------------------------------------------------------------------------------

echo json_encode([ 'draw1'=> $draw1, 'draw2' => $draw2, 'draw3' => $draw3, 'draw4' => $draw4, 'draw5' => $draw5, 'draw6' => $draw6]);
?>
