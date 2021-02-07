<?php

$text = file_get_contents('php://input');
$assocArr = json_decode($text, true);
$values = $assocArr['values'];
$sum = $assocArr['sum'];
if($sum > 0){
    $rest = $sum;
    for($i = count($values) - 1; $i >=0; $i--){
        $arr[$values[$i]] = floor($rest / $values[$i]);
        $rest = $rest % $values[$i];
    }
}

$arr['isPossible'] = ($rest == 0 && $sum > 0) ? true: false;

if(!$arr['isPossible']){
    $min = $values[0];
    $arr['min'] = $sum - $rest; 
    $arr['max'] = $arr['min'] + $min; 
}   

$json = json_encode($arr);
echo $json;

