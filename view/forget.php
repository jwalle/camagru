<?php
if (!defined('index'))
    die('Accès interdit');
if (isset($_POST['btn-forget'])) {
    if ($user = $auth->resetPass($db, App::cleanUp(trim($_POST['umail'])))) {
        App::redirect('index.php?page=sign-in'); // TODO : add connected page
    } else {
        $error = "Cet utilisateur n'existe pas !";
    }
}
?>

<div class="wrapper">
    <div class="form-container">
        <form method="post">
            <?php
            if (isset($error))
            {
                ?>
                <div class="alert">
                    <div class="msg"> <img src="img/alert-icon-1575.png" class="glyphicon"/> &nbsp;  <?php echo $error; ?> </div>
                </div>
                <?php
            }
            ?>
            <p>Réinitialisation de votre mot de passe :</p>
            <br>
            <div class="name">
                <input type="text" class="css-input" name="umail" placeholder="email" value="" maxlength="40"/>
            </div>
            <div class="button">
                <input type="submit" class="btn" name="btn-forget" value="Valider"/></br>
            </div>
            <br>
        </form>
    </div>
</div>
