<?php namespace App\Lib;

use App\Core\Container;
use App\Services\AirlinesService;
use App\Services\AuthService;
use App\Services\HotelsService;
use App\Services\LoginService;

class App
{
    protected static $container;

    public static function run()
    {
        static::configureContainer();
        Logger::enableSystemLogs();
    }

    public static function setContainer($container)
    {
        static::$container = $container;
    }

    public static function getContainer()
    {
        return static::$container;
    }

    public static function bind($key, $resolver)
    {
        static::getContainer()->bind($key, $resolver);
    }

    public static function resolve($key)
    {
        return static::getContainer()->resolve($key);
    }

    protected static function configureContainer()
    {
        $container = new Container();

        $container->bind(
            "Services\HotelsService",
            function ()
            {
                return new HotelsService();
            }
        );

        $container->bind(
            "Services\AirlinesService",
            function ()
            {
                return new AirlinesService();
            }
        );

        $container->bind(
            "Services\LoginService",
            function ()
            {
                return new LoginService();
            }
        );

        $container->bind(
            "Services\AuthService",
            function ()
            {
                return new AuthService(Config::get('TOKEN'));
            }
        );

        static::setcontainer($container);
    }
}