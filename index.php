<?php

session_start();

if(!isset($conn))
    require 'install.php';
if (isset($_GET['page']))
    $page = $_GET['page'];
else
    $page = 'home';

ob_start();

if ($page === 'home')
    require 'Home.php';
elseif ($page === 'register')
    require 'register.php';
elseif ($page === 'logout')
    require 'logout.php';
elseif ($page === 'sign-in')
    require 'sign-in.php';
elseif ($page === 'content')
    require 'content.php';
else
    require 'Home.php';

$content = ob_get_clean();

require 'main.php';

?>
