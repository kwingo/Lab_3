<?php

require __DIR__ .  '/vendor/autoload.php';

$app = new \Slim\App();

$app -> get('/inventory', function($request, $response, $args){
    return $response->write("Inventory of Glasses");
});

$app->run();
