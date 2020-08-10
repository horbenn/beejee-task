<?php


namespace App\Components;


class View
{
    /**
     * @var string
     */
    protected $path;

    /**
     * View constructor.
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @param $filename
     * @param array $parameters
     * @return string
     */
    public function loadFile($filename, $parameters = [])
    {
        extract($parameters);

        require $this->path.$filename.'.php';
    }

}