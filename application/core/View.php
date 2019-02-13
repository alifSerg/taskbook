<?php
//Класс View отвечает за все шаблоны и вью
namespace application\core;

class View {
//Путь к виду
    public $path;

    public $route;
//Шаблон
    public $layout = 'default';
//В конструкторе принимаем данные из класса Controller
    public function __construct($route) {
        $this->route = $route;
        //Формируем путь
        $this->path = $route['controller'].'/'.$route['action'];
        //debug($this->route);
    }
    //необходимо получить маршруты, чтобы понимать из какой папки загружать виды
    //функция загружает содержимое страницы
    //$vars - переменная, которой будет передаваться вид
    public function render($title, $vars = []) {
        //Подключаем default
        //функция extract распакует массив $vars в переменные
        extract($vars);
        $path = 'application/views/'.$this->path.'.php';
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_contents();
//            require 'application/views/layouts/'.$this->layout.'.php';
        } else {
            echo '<p>View not found: '.$this->path.'</p>';

        }
    }
//отображение ошибок пользователю
    public static function errorCode($code) {
        http_response_code($code);
        $path = 'application/views/errors/'.$code.'.php';
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }

    public function redirect($url) {
        header('location: '.$url);
        exit;
    }
}