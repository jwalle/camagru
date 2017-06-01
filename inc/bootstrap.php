<?php

spl_autoload_register('ft_autoload');

function ft_autoload($class) {
	define(rootPath, dirname(__DIR__), true);
    require  rootPath . "/class/$class.php";
}