<?php
ini_set('memory_limit','512M');
$central = [0,0];
$input1 = file_get_contents("Input1.txt");
$input1 = explode(",", $input1);
$input2 = file_get_contents("Input2.txt");
$input2 = explode(",", $input2);
$coords1 = iterateMoves($input1);
$coords1 = implode_array($coords1);
$coords2 = iterateMoves($input2);
$coords2 = implode_array($coords2);
$overlaps = find_overlapping_cords($coords1,$coords2);
$smallest_manhattan =  find_smallest_manhattan($overlaps);
echo($smallest_manhattan);

function implode_array($array){
    $arrayOut = array();
    foreach($array as $coord){
        array_push($arrayOut, implode(',',$coord));
    }
    return $arrayOut;
}
function explode_array($array){

    $arrayOut = array();
    foreach($array as $coords){
        array_push($arrayOut, explode(',',$coords));
    }
    return $arrayOut;
}


function find_smallest_manhattan($overlaps)
{
    $current_min = INF;
    foreach ($overlaps as $overlap) {
        # There is not substaction because it always from zero
        $current_min = min($current_min, $overlap[2]);
    }
    return $current_min;
}

function check_in_coords_mode($coords1,$coords2){
    $coords = array();
    for ($i=0;$i<sizeof($coords1);$i++) {
        for ($j=$i+1;$j<sizeof($coords2);$j++) {
            if(substr($coords1[$i], 0, strpos($coords1[$i], ","))==substr($coords2[$j], 0, strpos($coords2[$j], ","))){
                $steps = substr($coords1[$i], 1+strpos($coords1[$i], ","))+substr($coords2[$j], 1+strpos($coords2[$j], ","));
                echo('Steps:'.$steps.'end');
                $x = substr($coords1[$i],0,strpos(",",substr($coords1[$i], 0, strpos($coords1[$i], ","))));
                echo('x:'.$x);
                $y = substr($coords1[$i], strpos(",",substr($coords1[$i],0, 1+strpos($coords1[$i], ","))),strpos($coords1[$i], ","));
                echo('y:'.$y.'end');

                array_push($coords,[$x,$y,$steps]);

            }
        }
    }
    return $coords;

}
function find_overlapping_cords($coords_list_one,$coords_list_two){
    return check_in_coords_mode($coords_list_one,$coords_list_two);
}

function iterateMoves($input)
{
    $current_position = [0,0];
    $coords = array();
    $steps = 0;
    foreach ($input as $move) {
        list($current_position, $coordinates, $steps) = send_move_input($current_position, $move,$steps);
        $current_position = $current_position;
        $steps = $steps;
        $coords = array_merge($coords, $coordinates);
    }
    return $coords;
}
function send_move_input($current_position,$move,$steps){
    $number_of_moves = substr($move,1);
    $dir = substr($move,0,1);
    return move($dir,$number_of_moves,$current_position,$steps);
}
function move($letter,$number_of_moves,$current_position,$steps){
    $postions = array();
    switch($letter){
        case 'R':
            for ($i = 0; $i < $number_of_moves; $i++) {
                $steps = $steps+1;
                $current_position = [$current_position[0]+1,$current_position[1],$steps];
                array_push($postions, $current_position);
            }
            return array($current_position, $postions);
        case 'L':
            for ($i = 0; $i < $number_of_moves; $i++) {
                $steps= $steps+1;

                $current_position = [$current_position[0]-1,$current_position[1],$steps];
                array_push($postions, $current_position);
            }
            return array($current_position, $postions);
        case 'U':
            for ($i = 0; $i < $number_of_moves; $i++) {            
                    $steps= $steps+1;

                $current_position = [$current_position[0],$current_position[1]+1,$steps];
                array_push($postions, $current_position);
            }
            return array($current_position, $postions);
        case 'D':
            for ($i = 0; $i < $number_of_moves; $i++) {
                $steps= $steps+1;
                $current_position = [$current_position[0],$current_position[1]-1,$steps];
                array_push($postions, $current_position);
            }
            return array($current_position, $postions,$steps);
    }
}