<div class ="wrapper">
<h1>
    Hi <?php echo $_SESSION['user_name'];?>, You can't access this page because you are already connected.
    You will be automatically redirected in 5s.
    If you are not, please click <a href="../index.php">here.</a>
</h1>
</div>
<?php
    header('Refresh: 5;index.php');
?>