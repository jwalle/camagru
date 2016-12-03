<?php
include_once 'install.php';
if ($user->logout())
{
	$user->redirect('index.php');
}
?>
