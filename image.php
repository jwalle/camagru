<?php
    $user_id   = $user->get_id($_SESSION['username']);
    $user_vote = $image->get_user_vote($user_id, $_GET["image"]);
    $img_user = $image->get_img_user($_GET['image']);
    if (!$_GET["image"])
        echo "wtf"; //TODO : gestion erreur
?>
<script src="vote.js"></script>
<div class="wrapper">
    <h2>Bienvenue !</h2>
    <p>Image taken by <?= $img_user ?> :</p>
    <div class="image border">
        <div class="vote" id="vote" data-vote="<?= $user_vote ?>" data-image="<?= $_GET["image"] ?>" data-user="<?= $user_id ?>">
            <div id="upvotes"><i class="up"></i></div>
            <div id="sumVote" data-value="<?= $image->get_sum_votes($_GET["image"]) ?>"></div>
            <div id="dvote"><i class="down"></i></div>
        </div>
        <img src="<?= $gallery->get_image($_GET["image"])['img_name'] ?>"/>
    </div>
    <div class="comments">
        <?php foreach ($image->get_comments($_GET["image"]) as $value) : ?>
            <div class="comment">
                <div id="username"><?= $user->get_name($value['user_id']); ?></div>
                <?php if ($value['user_id'] == $user_id) : ?>
                    <div id="delete" class="delete" data-com_id="<?= $value['com_id'] ?>"></div>
                <?php endif; ?>
                <div id="content"><p><?= $value['comment'];?></p></div>
                <div id="date"><?= $value['commented'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="form-container">
        <form method="post" id="postCom">
            <?php if (isset($error)) : ?>
                <div class="alert">
                    <div class="msg"> <img src="img/alert-icon-1575.png" class="glyphicon"/> &nbsp;  <?= $error; ?> </div>
                </div>
            <?php endif; ?>
            <input type="hidden" name="image-id" value="<?= $_GET["image"] ?>">
            <textarea name="comment" id="comment"></textarea>
            <div class="button">
                <input type="submit" class="btn" name="btn-post" value="post"/></br>
            </div>
        </form>
    </div>
</div>