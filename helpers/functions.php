<?php

if (!function_exists('app')) {
    function app()
    {
        return \App\Components\App::instance();
    }
}


if (!function_exists('basePath')) {
    function basePath($name = '')
    {
        return realpath(getcwd().'/../'.$name).'/';
    }
}


if (!function_exists('config')) {
    function config($name = null)
    {
        if (!empty($name)) {
            return app()->getConfig()[$name] ?? null;
        }

        return app()->getConfig();
    }
}


if (!function_exists('db')) {
    function db()
    {
        return app()->getDatabase();
    }
}


if (!function_exists('view')) {
    function view($filename, $parameters = [])
    {
        return app()->getView()->loadFile($filename, $parameters);
    }
}

if (!function_exists('buildHttpQuery')) {
    function buildHttpQuery($parameters = [])
    {
        return http_build_query(array_filter(array_replace($_GET, $parameters)));
    }
}


if (!function_exists('dd')) {
    function dd()
    {
        $args = func_get_args();

        echo '<pre>';
        foreach ($args as $arg) {
            var_dump($arg);
        }
        echo '</pre>';
        exit;
    }
}