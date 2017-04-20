<?php
if ($auth->user())
    App::redirect('index.php?page=content');

if (isset($_POST['btn-signup']))
{
//    $mail = mail("punktumg@gmail.com", "test", "message test");
//    if (!$mail)
//        echo "mail not working";
    $uname = trim($_POST['txt_uname']);
	$umail = trim($_POST['txt_umail']);
    $upass = trim($_POST['txt_upass']);
    $upass_conf = trim($_POST['txt_upass_conf']);

	if (empty($uname) || !preg_match('/^[a-zA-Z0-9_]+$/', $uname))
		$error[] = "Rajouter un nom d'utilisateur valide.";
    else if (strlen($uname) > 20)
        $error[] = "Le nom d'utilisateur est trop long (> 20).";
	else {
	    $user_id = $db->query('SELECT user_id FROM users WHERE user_name = ?', [$uname])->fetch();
	    if ($user_id)
            $error[] = "Desole ce nom d'utilisateur est deja pris.";
    }

    if (empty($umail) || !filter_var($umail, FILTER_VALIDATE_EMAIL))
        $error[] = "Rajouter une adresse email valide.";
	else {
	    $mail = $db->query('SELECT user_mail FROM users WHERE user_mail = ?', [$umail])->fetch();
	    if ($mail)
            $error[] = "Desole cette adresse mail est deja prise.";
    }

    if ($upass == "")
		$error[] = "Rajouter mot de passe.";
    else if ($upass != $upass_conf)
        $error[] = "Le mot de passe de confirmation ne correspond pas.";

	else if (strlen($upass) < 6)
		$error[] = "Le mot de passe doit faire au moins 6 caracteres.";
	else
	{
	    $auth = App::getAuth();
	    $auth->register($db, $uname, $upass, $umail);
	    Session::getInstance()->setFlash('success', "Un mail de confirmation vous a ete envoye.");
	    App::redirect("index.php");
	}
}
?>

<div class="wrapper">
<div class="form-container">
	<form method="post">
		<h2>Se creer un compte :</h2>
		<?php
		if (isset($error))
		{
			foreach ($error as $error)
			{
				?>
				<div class="alert">
					<div class="msg"> <img src="img/alert-icon-1575.png" class="glyphicon"></img> &nbsp; <?php echo $error; ?></div>
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
            <div><input type="text" class="css-input" name="txt_uname" placeholder="Login" value="" /></div>
            <div><input type="text" class="css-input" name="txt_umail" placeholder="email" value="" /></div>
            <div><input type="password" class="css-input" name="txt_upass" placeholder="Mot de passe" value="" /></div>
            <div><input type="password" class="css-input" name="txt_upass_conf" placeholder="Retaper le mot de passe" value="" /></div>
            <input type="submit" class="btn" name="btn-signup" value="OK"/>
			</br>
		</form>
	</div>
</div>
