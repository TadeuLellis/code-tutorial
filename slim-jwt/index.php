<?php
// requirir script bootstrap.php e index.php somente uma vez (once)
require_once 'bootstrap.php';
require_once 'public/index.php';

// se url for igual a localhost:9090/
if('localhost:9090/' === $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) {   // então
    // redirecionar uma vez para http://localhost:9090/index
    header('Location: http://localhost:9090/index');
}