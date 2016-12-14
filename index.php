<?php

require_once 'install.php';

if ($user->is_loggedin())
{
	$_SESSION['page'] = 'content.php';
}
else
    $user->redirect('sign-in.php');
?>

<html>

<?php include_once 'Header.php'; ?>

<body>

	<?php include_once 'side_bar.php'; ?>

	<?php include_once $_SESSION['page'];?>

</body>
</html>
