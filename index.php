<?php

require_once 'install.php';

if ($user->is_loggedin() === true)
{
	$_SESSION['page'] = 'content.php';
}
else if (isset($_GET['login']))
	$_SESSION['page'] = 'login.php';
else if (isset($_GET['joined']))
    $_SESSION['page'] = 'joined.php';
else
	$_SESSION['page'] = 'sign-in.php';
?>

<html>

<?php include_once 'Header.php'; ?>

<body>

	<?php include_once 'side_bar.php'; ?>

	<?php include_once $_SESSION['page'];?>

</body>
</html>
