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
$overlaps = explode_array($overlaps);
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
        $current_min = min($current_min, abs($overlap[0])+abs($overlap[1]));
    }
    return $current_min;
}


function find_overlapping_cords($coords_list_one,$coords_list_two){
   
    return array_intersect($coords_list_one,$coords_list_two);
}

function iterateMoves($input)
{
    $current_position = [0,0];
    $coords = array();
    foreach ($input as $move) {
        list($current_position, $coordinates) = send_move_input($current_position, $move);
        $current_position = $current_position;
        $coords = array_merge($coords, $coordinates);
    }
    return $coords;
}
function send_move_input($current_position,$move){
    $number_of_moves = substr($move,1);
    $dir = substr($move,0,1);
    return move($dir,$number_of_moves,$current_position);
}
function move($letter,$number_of_moves,$current_position){
    $postions = array();
    switch($letter){
        case 'R':
            for ($i = 0; $i < $number_of_moves; $i++) {
                $current_position = [$current_position[0]+1,$current_position[1]];
                array_push($postions, $current_position);
            }
            return array($current_position, $postions);
        case 'L':
            for ($i = 0; $i < $number_of_moves; $i++) {
                $current_position = [$current_position[0]-1,$current_position[1]];
                array_push($postions, $current_position);
            }
            return array($current_position, $postions);
        case 'U':
            for ($i = 0; $i < $number_of_moves; $i++) {
                $current_position = [$current_position[0],$current_position[1]+1];
                array_push($postions, $current_position);
            }
            return array($current_position, $postions);
        case 'D':
            for ($i = 0; $i < $number_of_moves; $i++) {
                $current_position = [$current_position[0],$current_position[1]-1];
                array_push($postions, $current_position);
            }
            return array($current_position, $postions);
    }
}