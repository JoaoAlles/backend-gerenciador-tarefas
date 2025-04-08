<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve arquivos estáticos se existirem
if (file_exists(__DIR__ . $path)) {
    return false;
}

// Todas as outras requisições vão para o index.php
require_once __DIR__ . '/index.php';