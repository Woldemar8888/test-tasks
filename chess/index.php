<?php

interface IChessmen{
    public function move($dx, $dy);
    public function getPosition(); 
}

abstract class AbstractChessmen implements IChessmen{
    protected $x;
    protected $y;
    
    public function __construct($x, $y){
        if($x >= 1 && $x <= 8 && $y >= 1 && $y <=8){
            $this->x = $x;
            $this->y = $y; 
        }else{
            throw new Exception('can not set this position');
        }
        
    }

    public function getPosition(){
        $arr = [];
        $arr['x'] = $this->x;
        $arr['y'] = $this->y;
        return $arr;
    }
    
    protected function checkForBounds($x, $y, $className){
        if(($x) > 8 || ($x) < 1){
            throw new Exception($className.' can not move this way cause of desk size<br>');
        }
        if(($y) > 8 || ($y) < 1){
            throw new Exception($className.' can not move this way cause of desk size<br>');
        }
    }
}

class King extends AbstractChessmen{
    public function move($x, $y){
        $this->checkForFigureOpportunities($x, $y, get_class($this));
        $this->checkForBounds($x, $y, get_class($this));
        
        $this->x = $x;
        $this->y = $y;
    }
    
    private function checkForFigureOpportunities($x, $y, $className){
        $dx = $x - $this->x;
        $dy = $y - $this->y;
        if(abs($dx) > 1 || abs($dy) > 1){
            throw new Exception($className.' can not move this way cause of figure opportunities');
        }
    }
}

class Queen extends AbstractChessmen{
    public function move($x, $y){
        $this->checkForFigureOpportunities($x, $y, get_class($this));
        $this->checkForBounds($x, $y, get_class($this));
        
        $this->x = $x;
        $this->y = $y;
    }
    
    private function checkForFigureOpportunities($x, $y, $className){
        $dx = $x - $this->x;
        $dy = $y - $this->y;
        if( !( ($dx == 0) || ($dy == 0) || (abs($dx) == abs($dy)) ) ){
            throw new Exception($className.' can not move this way cause of figure opportunities');
        }
    }
}

try{
    $queen = new Queen(1,1);
    $queen->move(7,3);   
}catch(Exception $e){
    echo 'Exception has been thrown: ',  $e->getMessage(), '<br>';
}

try{
    $king = new King(4,3);
    $king->move(2,2);
     
}catch(Exception $e){
    echo 'Exception has been thrown: ',  $e->getMessage(), '<br>';
}

echo 'position of queen is: x: ', $queen->getPosition()['x'], ', y: ',$queen->getPosition()['y'], '<br>';
echo 'position of king is: x:', $king->getPosition()['x'], ', y: ', $king->getPosition()['y'], '<br>';








