<?php
if (!defined('index'))
    die('Accès interdit');
?>
<div class ="wrapper">
    <div id="registered">
        <p>Bonjour <?php echo $_GET['username'];?>, votre compte a bien été créé !</p>
        <p>Un mail de confirmation vous a été envoyé,</p>
        <p>vous serez redirigé vers <a href="index.php">l'acceuil</a> dans 5 secondes.</p>
    </div>
</div>
<?php
header('Refresh: 5;index.php');
?>