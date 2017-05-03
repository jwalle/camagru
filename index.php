<?php
require 'inc/bootstrap.php';
require 'inc/functions.php';
include_once 'config/setup.php';
$db = App::getDatabase();
$auth = App::getAuth();
//if(!isset($user))
//    require 'setup.php';
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
            require 'logout.php';
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
            require 'Home.php';
            break;
        default :
            require 'view/content.php';
    }
}
else
{
    switch ($page) {
        case 'forget':
            require 'view/forget.php';
            break;
        case 'reset':
            require 'view/reset.php';
            break;
        case 'confirm':
            require 'confirm.php';
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
            $auth->restrict();
            require 'view/sign-in.php';
//            App::redirect('index.php');

    }
}

$content = ob_get_clean();

if ($content) {
require 'view/main.php'; }