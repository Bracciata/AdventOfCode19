<?php
$central = [0,0];
$input1 = file_get_contents("Input1.txt");
$input1 = explode(",", $input1);
$input2 = file_get_contents("Input2.txt");
$input2 = explode(",", $input2);
$coords1 = iterateMoves($input1);
$coords2 = iterateMoves($input2);
$overlaps = find_overlapping_cords($coords1,$coords2);


function find_overlapping_cords($coords_list_one,$coords_list_two){
    $overlap_positions = array();
    foreach($coords_list_one as $coords_one){
        foreach($coords_list_two as $coords_two){
            echo($coords_one);
            if($coords_one[0]==$coords_two[0]&&$coords_one[1]==$coords_two[1]){
                array_push($overlap_positions, $coords_one);
            }
        }
    }
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
    var_dump($coords);
    return $coords;
}
function send_move_input($current_position,$move){
    $number_of_moves = substr($move,1);
    $dir = substr($move,0,1);
    return move($dir,$number_of_moves,$current_position);
}
function move($letter,$number_of_moves,$current_position){
    $postions = array($current_position);
    switch($letter){
        case 'R':
            for ($i = 0; $i < $number_of_moves; $i++) {
                $current_position = [$current_position[0],$current_position[1]+1];
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
                $current_position = [$current_position[0]+1,$current_position[1]];
                array_push($postions, $current_position);
            }
            return array($current_position, $postions);
        case 'D':
            for ($i = 0; $i < $number_of_moves; $i++) {
                $current_position = [$current_position[0]-1,$current_position[1]];
                array_push($postions, $current_position);
            }
            return array($current_position, $postions);
    }
}