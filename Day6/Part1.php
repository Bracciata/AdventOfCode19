<?php
    $input1 = file_get_contents("Input1.txt");
    $input1 = str_replace("\n", ')',$input1);
    $input1 = str_replace(" ", '',$input1);
    $input1 = explode(")", $input1);
    $keys = array();
    $values = array();
    for($i=0;$i<sizeof($input1);$i=$i+2){
        array_push($keys,$input1[$i]);
        array_push($values,$input1[$i+1]);
    }
    $orbits = array_map(null, $keys, $values);
    $directs = 0;
    $indirects = 0;
    for($i=0;$i<sizeof($orbits);$i++){
        $find = $orbit[$i][0];
        $directs=$directs+1;
        $last_find = $i;
        while($find !=="COM"){
            for($j=0;$j<$last_find;$j++){
                if($orbits[$j][1]==$find){
                    $find == $orbits[$j][0];
                    $indirects = $indirects+1;
                    $last_find=$j;
                    break;
                }
            }
        }
    }
    echo($indirects+$directs);