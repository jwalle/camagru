<?php
    $i = 0;
    $img_id = $_GET["image"];
    $comments = $image->get_comments($img_id);
    if (!$img_id)
        echo "wtf"; //TODO : gestion erreur
    if (isset($_POST['btn-post']))
    {
        $content = $_POST['comment'];
        $user_id = $user->get_id($_SESSION['username']);
        $date = date("Y-m-d H:i:s");
        $image->add_comment($img_id, $user_id, $content, $date);
        header("Refresh:0");
    }
?>

<div class="wrapper">
    <h2>Bienvenue !</h2>
    <img src="<?= $gallery->get_image($img_id)['img_name']; ?>"/>
    <div class="comments">
        <?php foreach ($comments as $value)
        {
            ?>
            <div class="comment">
                <div id="username"><?= $user->get_name($value['user_id']); ?></div>
                <div id="content"><?= $value['comment'];?></div>
                <div id="date"><?= date($value['date']);?></div>
            </div>
            <?php
        }
        ?>
    </div>
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
                <input type="submit" class="btn" name="btn-post" value="post"/></br>
        </form>
    </div>
</div>