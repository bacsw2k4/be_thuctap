<?php
class App
{
    protected $currentController = 'AuthController';
    protected $currentMethod = 'login';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();
        if (isset($url[0]) && file_exists(APP_PATH . '/controllers/' . ucwords($url[0]) . 'Controller.php')) {
            $this->currentController = ucwords($url[0]) . 'Controller';
            unset($url[0]);
        }
        require_once APP_PATH . '/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;
        $this->currentMethod = 'login';
        if (isset($url[1]) && method_exists($this->currentController, $url[1])) {
            $this->currentMethod = $url[1];
            unset($url[1]);
        }
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $urlParts = explode('?', $url, 2);
            $path = $urlParts[0];
            $url = explode('/', $path);
            return $url;
        }
        return [];
    }
}