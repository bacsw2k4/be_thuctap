<?php

class BaseController
{
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) && get_class($this) != 'AuthController') {
            header('Location: ' . BASE_URL . '/public/index.php?url=' . 'auth/login');
            exit;
        }
    }
    public function model($model)
    {
        require_once APP_PATH . '/models/' . $model . '.php';
        return new $model();
    }
    public function redirect($path)
    {
        $fullUrl = BASE_URL . '/public/index.php?url=' . $path;
        header('Location: ' . $fullUrl);
        exit;
    }


    public function view($view, $data = [])
    {
        if (file_exists(VIEWS_PATH . '/' . $view . '.php')) {
            require_once VIEWS_PATH . '/' . $view . '.php';
        } else {
            die('View does not exist: ' . $view);
        }
    }
}