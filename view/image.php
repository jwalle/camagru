<?php
    if (!defined('index'))
        die('Accès interdit');
    $user_id = $_SESSION['auth']['user_id'];
    $gallery = App::getGallery();
    App::getAuth()->user() ? $grey = "" : $grey = "grey";
    if (!$_GET["image"] || $gallery->get_image($_GET["image"])['img_name'] == NULL) {
        Session::getInstance()->setFlash('danger', "Cette image n'existe pas.");
        App::redirect("index.php");
    }
    else {
        $image = App::getImage($_GET['image']);
        $img_user = $image->getImageUser();
        $user_vote = $image->getUserVote();
    }
?>
<?php if (App::getAuth()->user()) : ?>
<script src="script/vote.js"></script>
<?php endif; ?>
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
            <div id="upvotes"><i class="up <?= $grey ?>"></i></div>
            <div id="sumVote"><?= $image->getSumVote() ?></div>
            <div id="dvote"><i class="down <?= $grey ?>"></i></div>
        </div>
        <img src="<?= $image->getImage()['img_name'] ?>"/>
    </div>
    <div class="comments">
        <?php foreach ($image->getComments() as $value) : ?>
            <div class="comment">
                <div id="username"><?= $user->get_name($value['user_id']); ?></div>
                <?php if ($value['user_id'] == $user_id) : ?>
                    <div id="delete" class="delete" data-comId="<?= $value['com_id'] ?>" data-imgId="<?= $value['img_id']   ?>"></div>
                <?php endif; ?>
                <div id="content"><p><?= $value['comment'];?></p></div>
                <div id="date"><?= $value['commented'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php if (App::getAuth()->user()) : ?>
    <div class="form-container">
        <form method="post" id="postCom">
            <?php if (isset($error)) : ?>
                <div class="alert">
                    <div class="msg"> <img src="../img/alert-icon-1575.png" class="glyphicon"/> &nbsp;  <?= $error; ?> </div>
                </div>
            <?php endif; ?>
            <input type="hidden" name="image-id" value="<?= $_GET["image"] ?>">
            <textarea name="comment" id="comment" maxlength="9000"></textarea>
            <div class="button">
                <input type="submit" class="btn" name="btn-post" value="post"/></br>
            </div>
        </form>
    </div>
        <?php else: ?>
        <div id="noCom">
            <p>Vous devez créer un compte et être connecté pour poster un commentaire.</p>
        </div>
    <?php endif; ?>
</div>