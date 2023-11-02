<?php
require __DIR__ . '/vendor/autoload.php';

use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;
use App\Controllers\HotelsController;

App::run();

Router::get('/', function () {
    $container = App::getContainer();
    $hotelsService = $container->resolve('Services\HotelsService');
    $home = new HotelsController($hotelsService);
    $home->indexAction(); 
});

Router::get('/post/([0-9]*)', function (Request $req, Response $res) {
    $res->toJSON([
        'post' =>  ['id' => $req->params[0]],
        'status' => 'ok'
    ]);
});
