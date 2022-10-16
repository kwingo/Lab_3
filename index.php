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

//retrieving a single inventory
$app->get('/inventory/{id}', function (Request $request, Response $response,  array $args) {

    $id = $args['id'];

    $inventory = new Inventory();
    $_inv = $inventory->find($id);

    $payload[$_inv->id] = [
        'productID' => $_inv->productID,
        'brandID' => $_inv->brandID,
        'frameName' => $_inv->frameName,
        'price' => $_inv->price,
        'source' => $_inv->source
        ];

    return $response->withStatus(200)->withJson($payload);
});

//deleting a single inventory
$app->delete('/inventory/{id}', function ($request, $response, $args) {
    $id = $args['id'];
    $_inv = Inventory::find($id);
    $_inv->detele();
    if ($_inv->exists) {
        return $response->withStatus(200);
    } else {
        return $_inv->withStatus(204)->getBody()->write("Inventory '/inventory/$id' has been deleted.");
    }
});

$app->run();
