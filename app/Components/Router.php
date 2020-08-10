<?php

namespace App\Components;


class Router
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';
    const METHOD_ANY = 'ANY';

    /**
     * @var static
     */
    protected static $instance;

    /**
     * @var string
     */
    protected $requestMethod;
    /**
     * @var string
     */
    protected $requestUri;
    /**
     * @var string
     */
    protected $queryString;

    /**
     * @var array
     */
    protected $routes = [];

    public function __construct()
    {
        $this->initServersVars();
    }

    /**
     * @return static
     */
    public static function instance(): self
    {
        if (!static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }


    protected function initServersVars()
    {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];

        $queryStringStarts = strpos($_SERVER['REQUEST_URI'], '?');
        $this->requestUri = $queryStringStarts === false ? $_SERVER['REQUEST_URI'] : substr($_SERVER['REQUEST_URI'], 0,
            $queryStringStarts);

        $this->queryString = $_SERVER['QUERY_STRING'];
    }

    /**
     * @param string $method
     * @param string $pattern
     * @param string $controller
     * @param string $action
     */
    public function add(string $method, string $pattern, string $controller, string $action)
    {
        $this->routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'controller' => $controller,
            'action' => $action,
        ];
    }

    /**
     * @return array|null
     */
    public function getCurrentRoute()
    {
        foreach ($this->routes as $route) {

            if ($this->requestMethod != self::METHOD_ANY && $this->requestMethod != $route['method']) {
                continue;
            }

            if (preg_match('$'.$route['pattern'].'$', $this->requestUri)) {
                return $route;
            }
        }

        return null;
    }

    /**
     * @param string $pattern
     * @param string $controller
     * @param string $action
     */
    public static function get(string $pattern, string $controller, string $action)
    {
        self::instance()->add(self::METHOD_GET, $pattern, $controller, $action);
    }

    /**
     * @param string $pattern
     * @param string $controller
     * @param string $action
     */
    public static function post(string $pattern, string $controller, string $action)
    {
        self::instance()->add(self::METHOD_POST, $pattern, $controller, $action);
    }

    /**
     * @param string $pattern
     * @param string $controller
     * @param string $action
     */
    public static function put(string $pattern, string $controller, string $action)
    {
        self::instance()->add(self::METHOD_PUT, $pattern, $controller, $action);
    }

    /**
     * @param string $pattern
     * @param string $controller
     * @param string $action
     */
    public static function delete(string $pattern, string $controller, string $action)
    {
        self::instance()->add(self::METHOD_DELETE, $pattern, $controller, $action);
    }

    /**
     * @param string $pattern
     * @param string $controller
     * @param string $action
     */
    public static function any(string $pattern, string $controller, string $action)
    {
        self::instance()->add(self::METHOD_ANY, $pattern, $controller, $action);
    }

}