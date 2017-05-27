<?php
if (isset($_POST['btn-signup']))
{
    $uname = App::cleanUp(trim($_POST['txt_uname']));
	$umail = App::cleanUp(trim($_POST['txt_umail']));
    $upass = App::cleanUp(trim($_POST['txt_upass']));
    $upass_conf = App::cleanUp(trim($_POST['txt_upass_conf']));
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
    if (!empty($upass)) {
    $error = Auth::testPassword($upass, $upass_conf, $error);
	} else {
        $error[] = "Rajouter mot de passe.";
	}
    if (empty($error)) {
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
		<?php if (isset($error)) : ?>
            <div class="alert-require">
			<?php foreach ($error as $error) : ?>
					<div class="msg"> <img src="img/alert-icon-1575.png" class="glyphicon"/> &nbsp; <?php echo $error; ?></div>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div id="require">
            <p>Votre mot de passe doit :</p>
            <ul>
                <li>Faire au minimun 6 caracteres.</li>
                <li>Contenir au moins une lettre majuscule.</li>
                <li>Contenir au moins un chiffre.</li>
            </ul>
        </div>
            <div><input type="text" class="css-input" name="txt_uname" placeholder="Login" value="" /></div>
            <div><input type="text" class="css-input" name="txt_umail" placeholder="email" value="" /></div>
            <div><input type="password" class="css-input" name="txt_upass" placeholder="Mot de passe" value="" /></div>
            <div><input type="password" class="css-input" name="txt_upass_conf" placeholder="Retaper le mot de passe" value="" /></div>
            <input type="submit" class="btn" name="btn-signup" value="Valider"/>
			</br>
		</form>
	</div>
</div>
