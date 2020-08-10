<?php

namespace App\Components;


class App
{
    /**
     * @var App
     */
    protected static $instance;

    /**
     * @var array
     */
    protected $config;
    /**
     * @var Database
     */
    protected $database;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var View
     */
    protected $view;

    /**
     * App constructor.
     */
    public function __construct()
    {
        $this->initConfig();
        $this->initDatabase();
        $this->initRouter();
        $this->initView();
    }

    /**
     * @return App
     */
    public static function instance()
    {
        if (empty(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Run the Application
     */
    public static function run()
    {
        $app = static::instance();

        if ($route = $app->router->getCurrentRoute()) {
            $controller = new $route['controller'];
            $controller->{$route['action']}();
        } else {
            echo 404;
        }
    }

    protected function initConfig()
    {
        $path = basePath('config');

        foreach ($this->getFiles($path) as $file) {
            $this->config[substr($file, 0, -4)] = require_once $path.$file;
        }
    }

    protected function initDatabase()
    {
        $this->database = new Database($this->config['database']);
    }

    protected function initRouter()
    {
        $this->router = Router::instance();

        $path = $this->config['app']['paths']['routes'] ?? basePath('routes');

        foreach ($this->getFiles($path) as $file) {
            require_once $path.$file;
        }
    }

    protected function initView()
    {
        $this->view = new View($this->config['app']['paths']['views'] ?? basePath('views'));
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @return Database
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * @return Router
     */
    public function getRouter(): Router
    {
        return $this->router;
    }

    /**
     * @return View
     */
    public function getView()
    {
        return $this->view;
    }


    /**
     * @param $path
     * @return array
     */
    private function getFiles($path): array
    {
        return array_values(array_filter(scandir($path), function ($file) {
            return !in_array($file, ['.', '..']);
        }));
    }

}