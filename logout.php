<?php
include_once 'install.php';
if ($user->logout())
{
	$page = 'sign-in.php';
}
?>