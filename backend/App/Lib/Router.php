<?php
namespace App\Lib;

class Router
{
    public static function get($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0)
        {
            return;
        }

        self::on($route, $callback);
    }

    public static function post($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0)
        {
            return;
        }

        self::on($route, $callback);
    }

    public static function on($regex, $cb)
    {
        $url = parse_url($_SERVER['REQUEST_URI']);
        $path = $url['path'];

        $path = (stripos($path, "/") !== 0) ? "/" . $path : $path;
        $regex = str_replace('/', '\/', $regex);
        $is_match = preg_match('/^' . ($regex) . '$/', $path, $matches, PREG_OFFSET_CAPTURE);

        if ($is_match)
        {
            array_shift($matches);
            parse_str($url['query'], $params);

            $cb(new Request($params), new Response());
        }
    }
}