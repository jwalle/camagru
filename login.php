<?php

if (isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txt_uname']);
	$umail = trim($_POST['txt_umail']);
    $upass = trim($_POST['txt_upass']);
    $upass_conf = trim($_POST['txt_upass_conf']);

	if ($umail == "" || !filter_var($umail, FILTER_VALIDATE_EMAIL))
		$error[] = "Rajouter une adresse email valide.";

	else if ($uname == "" || !preg_match('/^[a-zA-Z0-9_]+$/', $uname))
		$error[] = "Rajouter a un nom d'utilisateur valide.";

	else if ($upass == "")
		$error[] = "Rajouter mot de passe.";

    else if ($upass != $upass_conf)
        $error[] = "Le mot de passe de confirmation ne correspond pas.";

	else if (strlen($upass) < 6)
		$error[] = "Le mot de passe doit faire au moins 6 caracteres.";

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
                    $user->redirect("index.php?joined");
            }

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
	}
}
}

?>

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
                Confirmation du Mot de passe: <input type="password" class="css-input" name="txt_upass_conf" placeholder="Mot de passe" value="" />

        <input type="submit" class="btn" name="btn-signup" value="OK"/>
			</br>
		</form>
	</div>
	
</div>
