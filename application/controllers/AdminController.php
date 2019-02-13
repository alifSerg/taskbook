<?php

namespace application\controllers;

use application\core\Controller;

//use application\lib\Db;

class AdminController extends Controller{

    public function __construct($route) {
        parent::__construct($route);
        $this->view->layout = 'admin';
    }

    public function loginAction() {
        $this->view->render('Вход');
    }

    public function addAction() {
        $this->view->render('Добавить пост');
    }

    public function editAction() {
        $this->view->render('Редактировать пост');
    }

    public function deleteAction() {
       exit('Удаление');
    }

    public function logoutAction() {
        exit('Выход');
    }
}