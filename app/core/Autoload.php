<?php

spl_autoload_register(function ($className) {
    // Remove o namespace principal (app\) se existir
    $className = str_replace('app\\', '', $className);
    $file = __DIR__ . '/../' . str_replace('\\', '/', $className) . '.php';

    if (file_exists($file)) {
        require $file;
    } else {
        // Debug: Mostra o caminho que tentou carregar
        error_log("Autoloader não encontrou: " . $file);
    }
});