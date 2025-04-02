<?php
// app/autoload.php

spl_autoload_register(function ($class) {
    // Konversi namespace ke path
    $class = str_replace('\\', '/', $class);

    // Tambahkan path berdasarkan struktur direktori
    $file = __DIR__ . '/../' . $class . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
