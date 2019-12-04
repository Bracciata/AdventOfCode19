<?php
$input1 =254032;
$input2=789860;
$valid_answers=array();
for($i=$input1;$i<=$input2;$i++){
    if(test_input($i)==true){
        array_push($valid_answers,$i);
    }
}

echo sizeof($valid_answers);
# 670


function test_input($number){ 
    if(two_adj($number)==true){
        if(no_decreases($number)==true){
            return true;
        }
    }
    return false;
}
function two_adj($number){
    $length = strlen($number);
    for ($i=0; $i<$length-1; $i++) {
        if(substr($number,$i,1)==substr($number,$i+1,1)){
            $clear = true;
            if($i>0){
                if(substr($number,$i,1)==substr($number,$i-1,1)){
                $clear=false;
                }
            }
            if($i<$length-2){
                if(substr($number,$i,1)==substr($number,$i+2,1)){
                    $clear=false;
                    }
            }
            if ($clear) {
                return true;
            }
        }
    }
    return false;
}
function no_decreases($number){
    $length = strlen($number);
    for ($i=0; $i<$length-1; $i++) {
        if(substr($number,$i,1)>substr($number,$i+1,1)){
            return false;
        }
    }
    return true;
}