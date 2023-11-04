<?php
require __DIR__ . '/vendor/autoload.php';

use App\Controllers\AirlinesController;
use App\Controllers\LoginController;
use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;
use App\Controllers\HotelsController;

App::run();

Router::get('/', function ()
{
    $container = App::getContainer();
    $hotelsService = $container->resolve('Services\HotelsService');
    $hotelsController = new HotelsController($hotelsService);
    $hotelsController->indexAction(); 
});

Router::get('/api/hotels', function (Request $req, Response $res)
{
    $container = App::getContainer();
    $hotelsService = $container->resolve('Services\HotelsService');
    $hotelsController = new HotelsController($hotelsService);
    $res->toJSON($hotelsController->getAvailableHotels($req->params)); 
});

Router::get('/post/([0-9]*)', function (Request $req, Response $res)
{
    $res->toJSON([
        'post' =>  ['id' => $req->params[0]],
        'status' => 'ok'
    ]);
});

Router::get('/login', function (Request $req, Response $res)
{
    $container = App::getContainer();
    $loginService = $container->resolve('Services\LoginService');
    $loginController = new LoginController($loginService);
    $loginController->login();
});

Router::post('/logintest', function (Request $req, Response $res)
{
    $container = App::getContainer();
    $loginService = $container->resolve('Services\LoginService');
    $loginController = new LoginController($loginService);

    $parameters = $req->getJSON();
    $res->toJSON($loginController->loginTest($parameters));
});

Router::get('/airlines/names', function (Request $req, Response $res)
{
    $container = App::getContainer();
    $airlinesService = $container->resolve('Services\AirlinesService');
    $airlinesController = new AirlinesController($airlinesService);
    $airlinesController->getAirlinesNames();
});
