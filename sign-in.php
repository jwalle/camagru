<?php

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
<label>Tu n'a pas encore de compte ?
         <a href="index.php?login" class="button">INSCRIT TOI</a>
</label>
</form>
        </div>
<?php echo '<p>Hello World</p>'; ?>
</header>