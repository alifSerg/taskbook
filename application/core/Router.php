<?php

namespace application\core;

use application\core\View;

Class Router {

    protected $routes = [];
    protected $params = [];
// в конструкторе подключаем rotes.php
    function __construct() {
        $arr = require 'application/config/routes.php';
        foreach($arr as $key => $val) {
            $this->add($key, $val);
        }
        //debug($this->routes);
        //echo '<p>'.'Router: <b>successful</b>'.'</p>';
    }
//Функция добавления маршрута
    public function add($route, $params) {
        $route = '#^'.$route.'$#';
        //массив rotes, ключ массива $route, значение $params
        $this->routes[$route] = $params;
    }
//Функция проверки наличия маршрута
//Функция всегда возвращает true или false
    public function match() {
        //1) получить текущий URL
        //2)обрезать слэши в УРЛ при помощи trim
        $url = trim($_SERVER['REQUEST_URI'], '/');
        //в цикле перебираем маршруты
        foreach($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }


        }
        return false;
    }

//Функция запуска роутера
    public function run() {
        if ($this->match()) {
            //echo '<p>controller: <b>'.$this->params['controller'].'</b></p>';
            //echo '<p>action: <b>'.$this->params['action'].'</b></p>';

            //Подключаем контроллер главной страницы
            //для правильного поиска класса контроллера используем ucfirst()
            $path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller';
            //echo $controller;
            //пишем проверку на существование класса контроллера
            if (class_exists($path)) {
                $action = $this->params['action'].'Action';
                //Пишем проверку на существование метода
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    //Вызов методв класса
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }

            } else {
                View::errorCode(404);
            }

        } else {
            View::errorCode(500);
        }
    }
}
