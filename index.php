<?php
session_start();

require __DIR__ . '/autoloader.php';

require __DIR__ . '/src/Shortifyer/Views/header.php';

use Shortifyer\Router\Router;

Router::route($_SERVER['REQUEST_URI'], $_REQUEST);

require __DIR__ . '/src/Shortifyer/Views/footer.php';
?>