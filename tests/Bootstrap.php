<?php

/*
 * Set error reporting to the level to which Zend Framework code must comply.
 */
error_reporting(E_ALL | E_STRICT);

chdir(dirname(__DIR__));

/*
 * autoload the application
 */
include __DIR__ . '/../init_autoloader.php';

Zend\Mvc\Application::init(include 'config/application.config.php');