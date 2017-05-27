<?php

if (isset($_GET['id']) && isset($_GET['token'])) {
    $user = $auth->checkResetToken($db, $_GET['id'], $_GET['token']);
    if ($user) {
        if (isset($_POST['btn-reset'])) {
            if (!empty($_POST['password'])) {
                $error = Auth::testPassword($_POST['password'], $_POST['password_confirm'], $error);
                if (empty($error)) {
                    $auth->changePassword($db, $_POST['password'], $user['user_id']);
                    $auth->connect($user);
                    App::redirect('index.php');
                }
            }
            else {
                $error[] = "Rajouter mot de passe.";
            }
        }
    }
}
?>
<div class="wrapper">
    <div class="form-container">
        <form method="post">
            <h3>Reinitialisation de votre mot de passe :</h3>
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
            <div class="password">
                <input type="password" class="css-input" name="password" placeholder="Nouveau mot de passe" value="" />
            </div>
            <div class="password_confim">
                <input type="password" class="css-input" name="password_confirm" placeholder="Confirmer le mot de passe" value="" />
            </div>
            <div class="button">
                <input type="submit" class="btn" name="btn-reset" value="Valider"/></br>
            </div>
            <br>
        </form>
    </div>
</div>