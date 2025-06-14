<?php
// public/index.php

// Mulai session untuk semua halaman
if (!session_id()) {
    session_start();
}

// Muat file inisialisasi
require_once '../app/init.php';

// --- ROUTING LOGIC ---
$controllerName = 'HomeController';
$methodName = 'index';
$params = [];

// Parsing URL
if (isset($_GET['url'])) {
    $url = rtrim($_GET['url'], '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $url = explode('/', $url);

    // Menentukan Controller
    if (isset($url[0])) {
        $controllerCandidate = ucfirst($url[0]) . 'Controller';
        if (file_exists('../app/controllers/' . $controllerCandidate . '.php')) {
            $controllerName = $controllerCandidate;
            unset($url[0]);
        }
    }

    // Menentukan Method
    if (isset($url[1])) {
        if (method_exists(new $controllerName, $url[1])) {
            $methodName = $url[1];
            unset($url[1]);
        }
    }
    
    // Menentukan Parameter
    if (!empty($url)) {
        $params = array_values($url);
    }
}

// Memuat dan menginstansiasi Controller
require_once '../app/controllers/' . $controllerName . '.php';
$controller = new $controllerName;

// Memanggil method dengan parameter
call_user_func_array([$controller, $methodName], $params);

?>