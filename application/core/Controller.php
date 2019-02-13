<?php

namespace application\core;

use application\core\View;

class Controller
{

    public $route;

    public $view;

    public $conf;

    public function __construct($route)
    {
        //echo '<p>Config controller: ' . '<b>successful</b><p/>';
        $this->route = $route;
        $_SESSION['admin'] = true;
        if (!$this->checkAccess()) {
            View::errorCode(403);
        }
        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
        //debug($route);
    }

//Models autoloading method

    public function loadModel($name)
    {
        $path = 'application\models\\'.ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
    }

    public function checkAccess() {
        $this->conf = require 'application/access/'.$this->route['controller'].'.php';
        if ($this->isConf('all')) {
            return true;
        }
        elseif (isset($_SESSION['authorize']['id']) and $this->isConf('authorize')) {
            return true;
        }
        elseif (!isset($_SESSION['authorize']['id']) and $this->isConf('guest')) {
            return true;
        }
        elseif (isset($_SESSION['admin']) and $this->isConf('admin')) {
            return true ;
        }
        return false;
    }

    public function isConf($key) {
        return in_array($this->route['action'], $this->conf[$key]);

    }

//КОНЕЦ
//.$this->route['controller'].'.php'
}