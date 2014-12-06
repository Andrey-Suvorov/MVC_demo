<?php

namespace Core;

/**
 * Class BaseController
 *
 * @package Core
 */
class BaseController
{

    protected $model;

    protected $template;
    protected $layouts;
    public $vars = array();

    /**
     * Constructor
     */
    function __construct()
    {
        $this->template = new Template($this->layouts, get_class($this));
    }

    /**
     *
     */
    public function index()
    {
        throw new \Exception('This method should be override!!!');
    }
}
