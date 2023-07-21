<?php
    require 'app/init.php';
    require "vendor/autoload.php";

    Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '')->load();

    $app = new App();

