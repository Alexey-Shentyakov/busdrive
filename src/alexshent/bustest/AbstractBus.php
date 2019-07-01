<?php

namespace alexshent\bustest;

abstract class AbstractBus {

    // maximum of passenger seats
    private $maxPassengerSeats;
    
    // current number of passengers in the bus
    private $passengersNumber;

    public function __construct(int $maxSeatsNum) {
        $this->maxPassengerSeats = $maxSeatsNum;
        $this->passengersNumber = 0;
    }

    // open bus doors
    abstract protected function openDoors();
    
    // close bus doors
    abstract protected function closeDoors();
    
    // take in passengers
    protected function takeIn(int $passengers) : int {
        //var_dump(__METHOD__);
        
        $seatsAvailable = $this->getSeatsAvailable();
        $passengersTaken = 0;
        
        if ($passengers <= $seatsAvailable) {
            // we can take all the passengers
            $passengersTaken = $passengers;
        }
        else {
            // too many passengers, no free seats for all of them
            $passengersTaken = $seatsAvailable;
        }
        
        $this->passengersNumber += $passengersTaken;
        
        echo "passengers taken: $passengersTaken\n";
        return $passengersTaken;
    }
    
    // let off passengers
    public function letOff(int $passengers) {
        if ($this->passengersNumber >= $passengers) {
            $this->passengersNumber -= $passengers;
            echo "passengers let off: $passengers\n";
        }
    }
    
    public function getPassengersNumber() : int {
        return $this->passengersNumber;
    }
    
    public function getSeatsAvailable() : int {
        $seatsAvailable = $this->maxPassengerSeats - $this->passengersNumber;
        return $seatsAvailable;
    }
}
