<?php namespace App\Lib;

use App\Core\Container;
use App\Services\HotelsService;

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

        static::setcontainer($container);
    }
}