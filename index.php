<?php

require_once 'install.php';

if ($user->is_loggedin() === true)
{
	$_SESSION['page'] = 'content.php';
}
if (isset($_GET['login']))
	$_SESSION['page'] = 'login.php';
else
	$_SESSION['page'] = 'sign-in.php';

if (isset($_POST['btn-signup']))
{
	$uname = $_POST['txt_uname_mail'];
	$umail = $_POST['txt_uname_mail'];
	$upass = $_POST['txt_upass'];
	if ($user->login($uname, $umail, $upass))
	{
		$_SESSION['page'] = 'content.php';
	}
	else
		$error = "Mauvais detail !";
}
?>

<html>

<?php include_once 'Header.php'; ?>

<body>

	<?php include_once 'side_bar.php'; ?>

	<?php include_once $_SESSION['page'];?>

</body>
</html>
