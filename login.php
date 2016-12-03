<?php 
require_once 'install.php';

if ($user->is_loggedin() != "")
{
	$user->redirect("home.php");
}

if (isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txt_uname']);
	$umail = trim($_POST['txt_umail']);
	$upass = trim($_POST['txt_upass']);

	if ($umail == "")
		$error[] = "Rajouter un nom d'utilisateur.";

	else if ($uname == "")
		$error[] = "Rajouter une adresse email.";


	//else if (filter_var($umail, FILTER_VALIDATE_EMAIL))
	//	$error[] = "Rajouter une adresse email valide.";

	else if ($upass == "")
		$error[] = "Rajouter mot de passe.";

	else if (strlen($upass) < 6)
		$error[] = "Le mot de passe doit au moins faire 6 caracteres.";
	else
	{
	try
		{
		$stmt = $conn->prepare("SELECT user_name,user_mail FROM users
								WHERE user_name=:uname OR user_mail=:umail");
		$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row['user_name'] == $uname)
			$error[] = "Desole ce nom d'utilisateur est deja pris.";
		else if ($row['user_mail'] == $umail)
			$error[] = "Desole cette adresse mail est deja prise.";
		else
		{
			if ($user->register($uname, $umail, $upass))
				$user->redirect("login.php?joined");
		}

	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}
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
	
		<img id="logo" src="/img/logo.png"></img>
		<img id="chupa-title" src="/img/chupa.png">
	
	<div class="form-container">
		<form method="post">
		<h2>Sign up.</h2><hr />
		<?php
		if (isset($error))
		{
			foreach ($error as $error)
			{
				?>
				<div class="alert">
					<i class="glyphicon"></i> &nbsp; <?php echo $error; ?>
				</div>
				<?php
			}
		}
		else if (isset($_GET['joined']))
		{
			?>
			<div class="alert alert-info">
				<i class="glyphicon"></i>  &nbsp; Succesfuly registered <a href="index.php">login</a> here
			</div>
			<?php
		}
		?>
				Identifiant: <input type="text" class="css-input" name="txt_uname" placeholder="Login" value="" />
				Mail: <input type="text" class="css-input" name="txt_umail" placeholder="email" value="" />
				Mot de passe: <input type="password" class="css-input" name="txt_upass" placeholder="Mot de passe" value="" />
			<input type="submit" class="btn" name="btn-signup" value="OK"/>
			</br>
		</form>
	</div>
	
</div>

</header>
			

			<a class="button3" href="http://local.42.fr:8080/phpmyadmin/" >Accès Admin</a>

</div>

<footer>

</footer>

</body>
</html>
