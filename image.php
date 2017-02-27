<?php
    $img_id = $_GET["image"];
    if (!$img_id)
        echo "wtf"; //TODO : gestion erreur
?>
<div class="wrapper">
    <h2>Bienvenue !</h2>
    <img src="<?= $gallery->get_image($img_id)['img_name']; ?>"/>
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
            <textarea name="comment" id="comment"></textarea>
            <div class="button">
                <input type="submit" class="btn" name="btn-signup" value="post"/></br>
        </form>
    </div>
</div>