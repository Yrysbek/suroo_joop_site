<?php
/**
 * Main Application
 */
class Bootstrap{
    /**
     * get instance of controller and call method by $GET['url']
     */
    function __construct()
    {
        $url = $_GET['url'];
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        if($url[0] == '')
            $url[0] = 'suroojoop';

        $file =  'controllers/'.$url[0].'.php';
        if(file_exists($file))
        {
            require $file;
        }
        else
        {
            exit("<div style=\"border: 1px solid #000000; padding: 5px;\">Controller <b>{$url[0]}</b> does not exists.</div>");
        }
        $controller = new $url[0];

        if(!method_exists($controller, $url[1]))
        {
            $url[1] = 'index';
        }

        if(isset($url[2]))
        {
            $controller->{$url[1]}($url[2]);
        }
        else
        {
            if(isset($url[1]))
            {
                $controller->{$url[1]}();
            }
        }
    }
}