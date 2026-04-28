<?php

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // Controller
        if ($url && file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Params
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // Jalankan controller & method, serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        $url = [];
        if (isset($_GET['url'])) {
            $url = trim($_GET['url'], '/');
        } else {
            // Fallback ke REQUEST_URI jika .htaccess tidak mem-passing parameter 'url'
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            
            // Cari base path (folder project)
            $script_name = dirname($_SERVER['SCRIPT_NAME']);
            $script_name = str_replace('\\', '/', $script_name); // Fix untuk windows
            $script_name = rtrim($script_name, '/');
            
            // Hapus base path dari URI jika ada
            if ($script_name !== '' && strpos($uri, $script_name) === 0) {
                $uri = substr($uri, strlen($script_name));
            }
            
            $url = trim($uri, '/');
        }

        if (!empty($url)) {
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $url = array_filter($url);
            return array_values($url);
        }
        
        return [];
    }
}
