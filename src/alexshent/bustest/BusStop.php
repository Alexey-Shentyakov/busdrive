<?php

namespace alexshent\bustest;

class BusStop {

    // bus stop name
    private $name;
    
    // number of passengers at the bus stop
    private $passengersNumber;
    
    public function __construct(string $name, int $passengers_number) {
        $this->name = $name;
        $this->passengersNumber = $passengers_number;
    }
    
    public function getName() : string {
        return $this->name;
    }
    
    public function getPassengersNumber() : int {
        return $this->passengersNumber;
    }
    
    public function setPassengersNumber(int $passengers) {
        $this->passengersNumber = $passengers;
    }
}
