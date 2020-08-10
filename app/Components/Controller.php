<?php

namespace App\Components;


class Controller
{
    /**
     * @var array
     */
    private $requestParams;

    /**
     * @param string $name
     * @return mixed|null
     */
    protected function get(string $name)
    {
        if (is_null($this->requestParams)) {
            $this->requestParams = array_merge($_GET, $_POST);
        }

        return $this->requestParams[$name] ?? null;
    }

}