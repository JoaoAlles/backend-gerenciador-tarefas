<?php

spl_autoload_register(function ($className) {
    $className = str_replace('app\\', '', $className);
    $file = __DIR__ . '/../' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($file)) {
        require $file;
    } else {
        error_log("Autoloader não encontrou: " . $file);
    }
});