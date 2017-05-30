<?php
if (!defined('index'))
    die('Accès interdit');
if (isset($_POST['btn-signup'])) {
    $uname = App::cleanUp($_POST['txt_uname_mail']);
    $umail = App::cleanUp($_POST['txt_uname_mail']);
    $upass = App::cleanUp($_POST['txt_upass']);
    if ($_SESSION['user'] = $auth->login($db, $uname, $umail, $upass)) {
            Session::getInstance()->setFlash('success', "Vous êtes connecté(e) !");
        App::redirect('index.php?page=content'); // TODO : add connected page
    }
}
?>
<div class="wrapper">
    <h2>Bienvenue !</h2>
       <div class="form-container">

           <form method="post">
                <p>Connectez-vous à un compte existant :</p>
                <br>
                <div class="name">
                   <input type="text" class="css-input" name="txt_uname_mail" placeholder="Utilisateur ou e-mail" value="" maxlength="40"/>
                </div>
                <div class="password">
                    <input type="password" class="css-input" name="txt_upass" placeholder="Mot de passe" value="" maxlength="20"/>
                </div>
                <div class="button">
                  <input type="submit" class="btn" name="btn-signup" value="Connexion"/></br>
                </div>
                <br>
                <label for="ask">Créez votre compte Camagru : &nbsp;<a href="index.php?page=register" class="btn">Creer un compte</a></label>
                <br />

                <br />
                <label for="ask">Mot de passe oublié ?&nbsp;<a href="index.php?page=forget" class="btn">Réinitialisation</a></label>
            </form>
        </div>
</div>
