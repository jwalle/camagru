<?php
if (isset($_POST['btn-signup'])) {
    $uname = $_POST['txt_uname_mail'];
    $umail = $_POST['txt_uname_mail'];
    $upass = $_POST['txt_upass'];
    if ($user = $auth->login($db, $uname, $umail, $upass)) {
        Session::getInstance()->setFlash('success', "Vous etes connecte(e) !");
        App::redirect('index.php?page=content'); // TODO : add connected page
    }
}
?>
<div class="wrapper">
    <h2>Bienvenue !</h2>
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
                <h3>Sign in</h3>
                <p>To an existing Camagru account</p>
                <br>
                <div class="name">
                   <input type="text" class="css-input" name="txt_uname_mail" placeholder="Login ou email" value="" />
                </div>
                <div class="password">
                    <input type="password" class="css-input" name="txt_upass" placeholder="Mot de passe" value="" />
                </div>
                <div class="button">
                  <input type="submit" class="btn" name="btn-signup" value="SIGN IN"/></br>
                </div>
                <br>
                <label for="ask">Click here to create a Camagru account : &nbsp;<a href="index.php?page=register" class="btn">Register</a></label>
                <br />

                <br />
                <label for="ask">Click here if you want to reset your password : &nbsp;<a href="index.php?page=forget" class="btn">Reset Password</a></label>
            </form>
        </div>
</div>