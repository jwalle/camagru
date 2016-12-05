<?php
include_once 'install.php';
if ($user->logout())
{
	echo "TESSSSSSSST";
	$user->redirect('index.php');
}
?>
