<?php
require_once 'install.php';

if ($user->is_loggedin() === false)
{
	echo COUCOU;
	//$user->redirect('Home.php');
	echo "DONE";
}

if (isset($_POST['btn-signup']))
{
	$uname = $_POST['txt_uname_mail'];
	$umail = $_POST['txt_uname_mail'];
	$upass = $_POST['txt_upass'];

	if ($user->login($uname, $umail, $upass))
	{
		echo LLLLLLGGGGGGGG;
		$user->redirect('Home.php');
	}
	else
		$error = "Mauvais detail !";
}
?>


<html>
<head>
	<link rel="stylesheet" type="text/css" href="chupa.css">
	<link rel="icon" type="image/png" href="/img/logo.png">
	<title>Camagru</title>	
</head>


<body bgcolor="#A69256">
<div class ="general">
	
	<header class="box">
		<div class="form-container">
			<form method="post">
				<h2>Sign in :</h2><hr />
				<?php
					if (isset($error))
					{
						?>
						<div class="alert">
							<i class="glyphicon"></i> &nbsp; <?php echo $error; ?>
						</div>
						<?php
					}
				?>
				Identifiant ou mail : <input type="text" class="css-input" name="txt_uname_mail" placeholder="Login" value="" />
				Mot de passe: <input type="password" class="css-input" name="txt_upass" placeholder="Mot de passe" value="" />
				<input type="submit" class="btn" name="btn-signup" value="SIGN IN"/>
				</br>
				<label>Tu n'a pas encore de compte ? <a href="login.php">Sign-up</a></label>
			</form>
		</div>
	<?php echo '<p>Hello World</p>'; ?>
	</header>
</div>

<footer>
	<a class="button3" href="http://local.42.fr:8080/phpmyadmin/" >Accès Admin</a>
</footer>

</body>
</html>
