<?php
require 'inc/bootstrap.php';
require 'inc/functions.php';
include_once("config/database.php");
$db = App::getDatabase($DB_DSN, $DB_USER, $DB_PASSWORD);
$auth = App::getAuth();
if(!isset($user))
    require 'install.php';
if (isset($_GET['page']))
    $page = $_GET['page'];
else
    $page = 'home';
ob_start();
switch ($page) {
    case 'logout':
        require 'logout.php';
        break;
    case 'home':
        require 'Home.php';
        break;
    case 'forget':
        require 'forget.php';
        break;
    case 'reset':
        require 'reset.php';
        break;
    case 'confirm':
        require 'confirm.php';
        break;
    case 'register':
            require 'register.php'; //Already
        break;
    case 'sign-in':
            require 'sign-in.php'; //already
        break;
    case 'content':
            require 'content.php';
        break;
    case 'image':
            require 'image.php';
        break;
    case 'gallery':
            require 'Gallery.php';
        break;
    default:
        require 'Home.php';
}

$content = ob_get_clean();

require 'main.php';
