<?php

spl_autoload_register('ft_autoload');

function ft_autoload($class) {
    require "class/$class.php";
}