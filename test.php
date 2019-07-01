<?php

spl_autoload_register(
function($class) {
    $base_dir = __DIR__ . '/src/';
    
    $file = $base_dir . str_replace('\\', '/', $class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
}
);

// ---------------------------------

try {
    // create five bus stops
    $bs1 = new \alexshent\bustest\BusStop("bus stop 1", 1);
    $bs2 = new \alexshent\bustest\BusStop("bus stop 2", 5);
    $bs3 = new \alexshent\bustest\BusStop("bus stop 3", 99);
    $bs4 = new \alexshent\bustest\BusStop("bus stop 4", 14);
    $bs5 = new \alexshent\bustest\BusStop("bus stop 5", 3);
    
    // create a route
    $route = new \alexshent\bustest\Route();
    
    // add bus stops to the route
    $route->addBusStop($bs1);
    $route->addBusStop($bs2);
    $route->addBusStop($bs3);
    $route->addBusStop($bs4);
    $route->addBusStop($bs5);
    
    // create a bus
    $bus = new \alexshent\bustest\MyBus(10);
    
    // create a driver
    $driver = new \alexshent\bustest\Driver("John Smith", 12);
    
    // set bus for the driver
    $driver->setBus($bus);
    
    // set route for the driver
    $driver->setRoute($route);
    
    // follow route forward
    $driver->followRoute();
    
    // follow route backward
    $driver->followRoute(\alexshent\bustest\Route::DIRECTION_BACKWARD);
}
catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
}
