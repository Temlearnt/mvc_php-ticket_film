<?php

class Controller
{
    // Method untuk memuat file view
    public function view($view, $data = [])
    {
        require_once './app/views/' . $view . '.php';
    }

    public function service($service)
    {
        $serviceClass = './app/services/' . $service . '.php';

        // Pastikan file ada
        if (file_exists($serviceClass)) {
            require_once $serviceClass;
            $className = 'App\\Services\\' . $service;
            return new $className();
        } else {
            throw new Exception("Service file $serviceClass not found.");
        }
    }


    // Mendefinisikan fungsi swal() sebagai metode dalam kelas
    public function swal($title, $text, $icon, $redirectUrl, $delay)
    {
        $url = BASEURL . $redirectUrl;
        echo "<html>
        <head>
        ";
        echo "<link href='".BASEURL."public/assets/css/sweetalert.css' rel='stylesheet' type='text/css'>";
        echo "<script src='".BASEURL."public/assets/js/sweetalert.min.js'></script>";
        echo "</head>";
        echo "<body>";
        echo "<script language='javascript'>swal('$title', '$text', '$icon');</script>";
        echo '<meta http-equiv="refresh" content="'.$delay.'; url='.$url.'">';    
        echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";
        echo "<script src='http://code.jquery.com/jquery-3.0.0.min.j'></script>";
        echo "</body>";
        echo "</html>";
    }

    function checkLogin($key, $redirectUrl = 'auth/login')
    {
        // Mulai sesi jika belum dimulai
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Pastikan pengguna sudah login berdasarkan key sesi
        if (!isset($_SESSION[$key])) {
            header('Location: ' . BASEURL . $redirectUrl);
            exit();
        }
    }
}
