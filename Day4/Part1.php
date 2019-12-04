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
    # 1033


    function test_input($number){ 
        if(there_exists_adj($number)==true){
            if(no_decreases($number)==true){
                return true;
            }
        }
        return false;
    }
    function there_exists_adj($number){
        $length = strlen($number);
        for ($i=0; $i<$length-1; $i++) {
            if(substr($number,$i,1)==substr($number,$i+1,1)){
                return true;
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