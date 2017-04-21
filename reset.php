<?php

if (isset($_GET['id']) && isset($_GET['token'])) {
    $user = $auth->checkResetToken($db, $_GET['id'], $_GET['token']);
}
if ($user) {
    if (!empty($_POST)) {
        if (!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']) {
            $auth->changePassword($db, $_POST['password'], $user['user_id']);
            $auth->connect($user);
            App::redirect('index.php');
        }
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
            <h3>Reinitialisation</h3>
            <p>de votre mot de passe :</p>
            <br>
            <div class="password">
                <input type="password" class="css-input" name="password" placeholder="Nouveau mot de passe" value="" />
            </div>
            <div class="password_confim">
                <input type="password" class="css-input" name="password_confirm" placeholder="Confirmer le mot de passe" value="" />
            </div>
            <div class="button">
                <input type="submit" class="btn" name="btn-reset" value="SEND"/></br>
            </div>
            <br>
        </form>
    </div>
</div>