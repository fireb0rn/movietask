<?php

spl_autoload_register(function ($className) {
    $filePath = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    if (file_exists($filePath)) {
        require_once $filePath;
        return true;
    }

    throw new Exception("Class Load Error: $className.");
});