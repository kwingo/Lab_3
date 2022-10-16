<?php

require __DIR__ .  '/vendor/autoload.php';
require  __DIR__ . '/bootstrap.php';

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Glasses\Models\Inventory;

$app = new \Slim\App();

$app -> get('/inventory', function($request, $response, $args){
    $inventory = Inventory::all();

    $payload = [];

    foreach ($inventory as $_inv) {
        $payload [$_inv->id] = [
            'productID' => $_inv->productID,
            'brandID' => $_inv->brandID,
            'frameName' => $_inv->frameName,
            'price' => $_inv->price,
            'source' => $_inv->source
        ];
    }
    return $response->withStatus(200)->withJson($payload);
});

$app->run();
