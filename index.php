<?php

session_start();

if(!isset($user))
    require 'install.php';
if (isset($_GET['page']))
    $page = $_GET['page'];
else
    $page = 'home';

ob_start();

if ($page === 'home')
    require 'Home.php';
elseif ($page === 'register')
{
    if (isset($_SESSION['username']) && isset($_SESSION['connected']))
        require 'alreadyconnected.php';
    else
        require 'register.php';
}
elseif ($page === 'logout')
    require 'logout.php';
elseif ($page === 'sign-in')
{
    if (isset($_SESSION['username']) && isset($_SESSION['connected']))
        require 'alreadyconnected.php';
    else
        require 'sign-in.php';
}
elseif ($page === 'content')
{
    if (isset($_SESSION['username']) && isset($_SESSION['connected']))
        require 'content.php';
    else
        require 'notconnected.php';
}
elseif ($page === 'image')
{
    if (isset($_SESSION['username']) && isset($_SESSION['connected']))
        require 'image.php';
    else
        require 'notconnected.php';
}
    else
    require 'Home.php';

$content = ob_get_clean();

require 'main.php';

?>
