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
    if (isset($url[0])) {
      if (file_exists('../app/controllers/' . $url[0] . '.php')) {
        $controller = $url[0];

        $this->controller = $controller;
        unset($url[0]);
      }
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

    // Parameters
    if (!empty($url[2])) {
      $this->params = array_values($url);
    }

    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  public function parseURL()
  {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);

      return $url;
    }
  }
}
