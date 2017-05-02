<?php

spl_autoload_register('ft_autoload');

function ft_autoload($class) {
    require $_SERVER['DOCUMENT_ROOT'] . "/camagru/class/$class.php";
}