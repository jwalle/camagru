<?php
define(rootPath, __DIR__, true);
require 'inc/bootstrap.php';
require 'inc/functions.php';
include_once('config/setup.php');
$db = App::getDatabase();
$auth = App::getAuth();
define('index', 'TRUE');
if (isset($_GET['page']))
    $page = $_GET['page'];
else
    $page = 'home';

ob_start();

if ($auth->user())
{
    switch ($page)
    {
        case 'logout':
            require 'post/logout.php';
            break;
        case 'content':
            require 'view/content.php';
            break;
        case 'image':
            require 'view/image.php';
            break;
        case 'gallery' :
            require 'view/galleryView.php';
            break;
        case 'home' :
            require 'view/Home.php';
            break;
        default :
            require 'view/content.php';
    }
}
else
{
    switch ($page) {
        case 'image':
            require 'view/image.php';
            break;
        case 'gallery' :
            require 'view/galleryView.php';
            break;
        case 'forget':
            require 'view/forget.php';
            break;
        case 'registered':
            require 'view/registered.php';
            break;
        case 'reset':
            require 'view/reset.php';
            break;
        case 'confirm':
            require 'view/confirm.php';
            break;
        case 'register':
            require 'view/register.php'; //Already
            break;
        case 'sign-in':
            require 'view/sign-in.php'; //already
            break;
        case 'home':
            require 'view/sign-in.php';
            break ;
        default:
            require 'view/sign-in.php';

    }
}

$content = ob_get_clean();

if ($content) {
require 'view/main.php';
}