<?php
session_start();
if (isset($_POST['btn-signup']))
{
    $uname = $_POST['txt_uname_mail'];
    $umail = $_POST['txt_uname_mail'];
    $upass = $_POST['txt_upass'];
    if ($user->login($uname, $umail, $upass))
    {
        $_SESSION['page'] = 'content.php';
        $user->redirect("index.php?content");
    }
    else
        $error = "Mauvais detail !";
}
?>

<header class="box">
    <h2>Bienvenue !</h2>

    <div class="form-container">
            <form method="post">
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
                <div class="name">
                   <input type="text" class="css-input" name="txt_uname_mail" placeholder="Login ou email" value="" />
                </div>
                <div class="password">
                    <input type="password" class="css-input" name="txt_upass" placeholder="Mot de passe" value="" />
                </div>
                <div class="button">
                  <input type="submit" class="btn" name="btn-signup" value="SIGN IN"/></br>
                <label for="ask">Tu n'a pas encore de compte ?<a href="index.php?login" class="button">INSCRIT TOI</a></label>
            </form>
        </div>
</header>