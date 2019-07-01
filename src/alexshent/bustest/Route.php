<?php

namespace alexshent\bustest;

class Route implements \Iterator {
    
    // array of bus stops
    private $busStops = [];
    
    // current bus stop index
    private $position = 0;
    
    // route forward direction
    public const DIRECTION_FORWARD = 1;
    
    // route backward direction
    public const DIRECTION_BACKWARD = 0;
    
    public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return $this->busStops[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return isset($this->busStops[$this->position]);
    }
    
    // add a bus stop to the route
    public function addBusStop(BusStop $bs) {
        $this->busStops[] = $bs;
    }
    
    // create reversed route
    public function getBackRoute() {
        $backRoute = new Route();
        $backRoute->position = 0;
        $backRoute->busStops = array_reverse($this->busStops);
        return $backRoute;
    }
}
