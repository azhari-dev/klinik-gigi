<?php
class Controller
{
  public function view($view, $data = [])
  {
    $file = __DIR__ . '/../views/' . $view . '.php';

    if (file_exists($file)) {
      require_once __DIR__ . '/../helpers/helpers.php';
      require_once $file;
    } else {
      die("View '$view' tidak ditemukan.");
    }
  }

  public function model($model)
  {
    $file = __DIR__ . '/../models/' . $model . '.php';

    if (file_exists($file)) {
      require_once $file;
      return new $model;
    } else {
      die("Model '$model' tidak ditemukan.");
    }
  }
}
