<?php
function showStroopEffect(){
    $colorArr = ['red', 'blue', 'green', 'yellow', 'lime', 'magenta', 'black', 
             'gold', 'gray', 'tomato'
            ];

$selectedTextArr = [];

for($i = 0; $i < 5; $i++){
    for($j = 0; $j < 5; $j++){
        if(count($selectedTextArr) == count($colorArr)){
            $selectedTextArr = []; 
        }
        
        //for text
        do{
            $random = mt_rand(0, count($colorArr) - 1);
            $randomText = $colorArr[$random]; 
        }while(in_array($randomText, $selectedTextArr, true));
        
        $selectedTextArr[] = $randomText;
        
        //for color
        $colorIndex = ($random + 3) % count($colorArr);
        $color = $colorArr[$colorIndex];
        
        echo '<span style="color:'.$color.'">'.$randomText.' </span>';    
    }
    echo '<br>';
}
}  
       
