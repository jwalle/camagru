<?php
require '../inc/bootstrap.php';
include_once '../config/database.php';
App::getAuth();
App::getDatabase();
$gallery = App::getGallery();
$row = $gallery->last_three();
if (!$row)
    return;
?>
        <div class="mini_gal_upper"><p>- Gallery -</p></div>
        <div class="mini_gal">
        <?php
                $page = "' onclick=\"location.href='index.php?page=image&image=";
                $i = 0;
                while ($i <= 2)
                {
                    if ($row[$i])
                        echo "<img src='" . $row[$i]['img_name'] . $page . $row[$i]['img_id'] . "'\"" . ">";
                    $i++;
                }
            ?>
        </div>