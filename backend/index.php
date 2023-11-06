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

Router::get(
    '/api/hotels',
    function (Request $req, Response $res)
    {
        $container = App::getContainer();
        $hotelsService = $container->resolve('Services\HotelsService');
        $authService = $container->resolve('Services\AuthService');

        $hotelsController = new HotelsController($hotelsService, $authService);
        $res->toJSON($hotelsController->getAvailableHotels($req->params)); 
    }
);

Router::post(
    '/api/login',
    function (Request $req, Response $res)
    {
        $container = App::getContainer();
        $loginService = $container->resolve('Services\LoginService');
        $authService = $container->resolve('Services\AuthService');
        $loginController = new LoginController($loginService, $authService);

        $parameters = $req->getJSON();
        $res->toJSON($loginController->loginTest($parameters));
    }
);

Router::get(
    '/api/airlines/names',
    function (Request $req, Response $res)
    {
        $container = App::getContainer();
        $airlinesService = $container->resolve('Services\AirlinesService');
        $airlinesController = new AirlinesController($airlinesService);
        $res->toJSON($airlinesController->getAirlinesNames());
    }
);
