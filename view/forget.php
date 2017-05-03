<?php
if (isset($_POST['btn-forget'])) {
    if ($user = $auth->resetPass($db, $_POST['umail'])) {
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
            <h3>Reinitialisation</h3>
            <p>de votre mot de passe :</p>
            <br>
            <div class="name">
                <input type="text" class="css-input" name="umail" placeholder="email" value="" />
            </div>
            <div class="button">
                <input type="submit" class="btn" name="btn-forget" value="SEND"/></br>
            </div>
            <br>
        </form>
    </div>
</div>
