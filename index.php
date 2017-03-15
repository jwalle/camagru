<?php

session_start();

if(!isset($user))
    require 'install.php';
if (isset($_GET['page']))
    $page = $_GET['page'];
else
    $page = 'home';

ob_start();

switch ($page) {
    case 'home':
        require 'Home.php';
        break;
    case 'register':
        if (isset($_SESSION['username']) && isset($_SESSION['connected']))
            require 'alreadyconnected.php';
        else
            require 'register.php';
        break;
    case 'sign-in':
        if (isset($_SESSION['username']) && isset($_SESSION['connected']))
            require 'alreadyconnected.php';
        else
            require 'sign-in.php';
        break;
    case 'content':
        if (isset($_SESSION['username']) && isset($_SESSION['connected']))
            require 'content.php';
        else
            require 'notconnected.php';
        break;
    case 'image':
        if (isset($_SESSION['username']) && isset($_SESSION['connected']))
            require 'image.php';
        else
            require 'notconnected.php';
        break;
    case 'gallery':
        if (isset($_SESSION['username']) && isset($_SESSION['connected']))
            require 'Gallery.php';
        else
            require 'notconnected.php';
        break;
    default:
        require 'Home.php';
}

$content = ob_get_clean();

require 'main.php';
