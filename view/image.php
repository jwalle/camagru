<?php
    $auth->restrict();
    $user_id = $_SESSION['auth']['user_id'];
    $gallery = App::getGallery();
    if (!$_GET["image"] || $gallery->get_image($_GET["image"])['img_name'] == NULL) {
        App::redirect("index.php");
        echo "wtf =" . $gallery->get_image($_GET["image"])['img_name']; //TODO : gestion erreur
    }
    else {
        $image = App::getImage($_GET['image']);
        $img_user = $image->get_user();
        $user_vote = $image->getUserVote();
    }
?>
<script src="script/vote.js"></script>
<div class="wrapper">
    <h2>Bienvenue !</h2>
    <div class="image border">
        <div class="upper_info">
            <div id="upper_user"><p>Image taken by <?= $img_user['user_name'] ?></p></div>
            <?php if ($_SESSION['auth']['user_name'] == $img_user['user_name']) : ?>
                <div id="del_pic" class="del_pic" data-img_id="<?= $_GET["image"] ?>"></div>
            <?php endif; ?>
        </div>
        <div class="vote" id="vote" data-vote="<?= $user_vote ?>" data-image="<?= $_GET["image"] ?>" data-user="<?= $user_id ?>">
            <div id="upvotes"><i class="up"></i></div>
            <div id="sumVote" data-value="<?= $image->getSumVote() ?>"></div>
            <div id="dvote"><i class="down"></i></div>
        </div>
        <img src="<?= $image->getImage()['img_name'] ?>"/>
    </div>
    <div class="comments">
        <?php foreach ($image->getComments() as $value) : ?>
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
                    <div class="msg"> <img src="../img/alert-icon-1575.png" class="glyphicon"/> &nbsp;  <?= $error; ?> </div>
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