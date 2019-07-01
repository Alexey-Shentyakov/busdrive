<?php

namespace alexshent\bustest;

class Driver {

    // driver name
    private $name;
    
    // years of driving experience
    private $drivingExperience;
    
    // the bus that this driver is driving 
    private $bus;
    
    // the route that is followed
    private $route;
    
    public function __construct($name, $driving_experience) {
        $this->name = $name;
        $this->drivingExperience = $driving_experience;
        $this->bus = null;
        $this->route = null;
    }
    
    public function setBus(AbstractBus $bus) {
        $this->bus = $bus;
    }
    
    public function setRoute(Route $route) {
        $this->route = $route;
        $this->routeBack = $this->route->getBackRoute();
    }
    
    // follow route
    public function followRoute($direction = Route::DIRECTION_FORWARD) {
    
        if ($this->route == null) {
            throw new \Exception("null route");
        }
        
        // reverse route if backward direction
        if ($direction === Route::DIRECTION_BACKWARD) {
            $this->route = $this->route->getBackRoute();
        }
    
        // route (bus stop collection) iterator
        foreach ($this->route as $bs) {
            
            // announce the bus stop name
            echo $bs->getName() . "\n\n";
            
            // passengers in the bus
            echo "passengers in the bus: " . $this->bus->getPassengersNumber() . "\n";
            
            // passengers at the stop
            echo "passengers at the stop: " . $bs->getPassengersNumber() . "\n";
            
            // open doors
            $this->bus->openDoors();
            
            // let random number of passengers off
            $passengersNum = $this->bus->getPassengersNumber();
            
            if ($passengersNum > 0) {
                $random = random_int(1, $passengersNum);
                $this->bus->letOff($random);
            }
            
            // take as much passengers from the bus stop as we can
            $busStopPassengers = $bs->getPassengersNumber();
            
            if ($this->bus->getSeatsAvailable() > $bs->getPassengersNumber()) {
                $this->wait(1);
            }
            
            $busStopPassengers = $bs->getPassengersNumber();
            
            $passengersTaken = $this->bus->takeIn($busStopPassengers);
            $bs->setPassengersNumber($busStopPassengers - $passengersTaken);
            
            // close doors
            $this->bus->closeDoors();
            
            // passengers in the bus
            echo "passengers in the bus: " . $this->bus->getPassengersNumber() . "\n";
            
            // passengers at the stop
            echo "passengers at the stop: " . $bs->getPassengersNumber() . "\n";
            
            echo "--------------------------\n";
        }
    }
    
    // wait at the bus stop
    private function wait(int $minutes) {
        echo "waiting $minutes minute(s) ...\n";
    }
}
