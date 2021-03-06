<?php

namespace Core;

class Template
{

    private $template;
    private $controller;
    private $layouts;
    private $vars = array();

    public function setTemplate($template)
    {
        $this->layouts = $template;
        return $this;
    }

    public function render()
    {
        return '<html></html>';
    }

    public function setParameters($params)
    {
        return $this;
    }


    public function __construct($layouts, $controllerName)
    {
        $this->layouts    = $layouts;
        $arr              = explode('_', $controllerName);
        $this->controller = strtolower($arr[1]);
    }

    // установка переменных, для отображения
    public function vars($varname, $value)
    {
        if (isset($this->vars[$varname]) == true) {
            trigger_error('Unable to set var `'.$varname.'`. Already set, and overwrite not allowed.', E_USER_NOTICE);
            return false;
        }
        $this->vars[$varname] = $value;
        return true;
    }

    // отображение
    public function view($name)
    {
        $pathLayout  = SITE_PATH.'views'.DS.'layouts'.DS.$this->layouts.'.php';
        $contentPage = SITE_PATH.'views'.DS.$this->controller.DS.$name.'.php';
        if (file_exists($pathLayout) == false) {
            trigger_error('Layout `'.$this->layouts.'` does not exist.', E_USER_NOTICE);
            return false;
        }
        if (file_exists($contentPage) == false) {
            trigger_error('Template `'.$name.'` does not exist.', E_USER_NOTICE);
            return false;
        }

        foreach ($this->vars as $key => $value) {
            $$key = $value;
        }
    }
}