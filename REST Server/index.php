<?php
require __DIR__.'/vendor/autoload.php';
include_once 'app/RouteAction.php';
include_once 'app/PDOFactory.php';
$app = new \Slim\App;
// $app->get('/',function($request,$response,$args){
//     // return $response->write("<h1>welcome to rest server</h1>");

// });
$container = $app->getContainer();
$container['RouteAction'] = function($c){
    return new RouteAction();
};
$app->get('/',\RouteAction::class.":index");

$app->get('/ebookings',\RouteAction::class.":viewRecords");
$app->get("/ebookings/keyword/{keyword}",\RouteAction::class.":searchRecords");
$app->get("/ebookings",\RouteAction::class.":addRecord");
$app->get('/ebookings/{id}',\RouteAction::class.":deleteRecord");
$app->get("/ebookings/{id}",\RouteAction::class.":editRecord");
$app->run();
// $p = new PDOFactory();
// $p->deleteRecord(108);


