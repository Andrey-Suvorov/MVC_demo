<?php

namespace Core;

class Router
{

    // почитать за RETURN

    private $path;
    private $args = array();

    public function setPath($path)
    {
        $path = rtrim($path, '/\\');
        $path .= DS;
        // если путь не существует, сигнализируем об этом
        if (is_dir($path) == false) {
            throw new Exception ('Invalid controller path: `'.$path.'`');
        }
        $this->path = $path;
    }

    // поситать за амперсанды
    private function getController(&$file, &$action, &$args)
    {
        $route = (empty($_GET['route']))?'':$_GET['route'];
        unset($_GET['route']);
        if (empty($route)) {
            $route = 'index';
        }

        $route = trim($route, '/\\');
        $parts = explode('/', $route);

        $cmd_path = $this->path;
        foreach ($parts as $part) {
            $fullpath = $cmd_path.$part;

            if (is_dir($fullpath)) {
                $cmd_path .= $part.DS;
                array_shift($parts);
                continue;
            }

            if (is_file($fullpath.'.php')) {
                $controller = $part;
                array_shift($parts);
                break;
            }
        }

        if (empty($controller)) {
            $controller = 'index';
        }

        $action = array_shift($parts);
        if (empty($action)) {
            $action = 'index';
        }

        $file = $cmd_path.$controller.'.php';
        $args = $parts;
    }


    public function callAction($controller, $action)
    {
        if (is_callable(array($controller, $action)) == false) {
            // почитать за слеш
            throw new \Exception('404 Not Found');
        }

        return $controller->$action();
    }


    public function start()
    {
        $controller = $this->getController($file, $action, $args);

        $class = 'Controller_'.$controller;
        // почитать за эту штуку
        $controller = new $class();

        try{
            // вывод в браузер
            echo $this->callAction($controller, $action);
            die();
        } catch(\Exception $e){
            echo 'Айайай!!!!';
        }
    }
}
