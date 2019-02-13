<?php

return [
//MainController
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],
//Маршруты about
    'about' => [
        'controller' => 'main',
        'action' => 'about',
    ],
//Маршрут главной страницы
    'post' => [
        'controller' => 'main',
        'action' => 'post',
    ],
//Маршрут для страницы контактов
//Отвечает main controller
    'contact' => [
        'controller' => 'main',
        'action' => 'contact',
    ],
//ADMIN CONTROLLER
    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login',
    ],
    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout',
    ],
    'admin/add' => [
        'controller' => 'admin',
        'action' => 'add',
    ],
    'admin/edit' => [
        'controller' => 'admin',
        'action' => 'edit',
    ],
    'admin/delete' => [
        'controller' => 'admin',
        'action' => 'delete',
    ],

];