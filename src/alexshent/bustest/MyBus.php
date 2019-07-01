<?php

namespace alexshent\bustest;

class MyBus extends AbstractBus {

    public function openDoors() {
        echo "open doors\n";
    }
    
    public function closeDoors() {
        echo "close doors\n";
    }
    
    public function takeIn(int $passengers) : int {
        //var_dump(__METHOD__);
        
        $taken = parent::takeIn($passengers);
        
        return $taken;
    }
}
