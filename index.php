<?php

    require 'application/lib/Dev.php';

    use application\core\Router;

    use application\lib\Db;

    spl_autoload_register(function($class) {
        //Замена слешей
        $path = str_replace('\\', '/', $class.'.php');
        //echo $path;
        //Проверка существования файла
        if (file_exists($path)) {
            //Если существует - подключаем
            require $path;
        }
    });

session_start();

$router = new Router;
$router->run();
?>
