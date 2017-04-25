<?php
include 'inc/bootstrap.php';
include 'install.php';
App::getAuth();
    $row = $gallery->last_three($_SESSION['auth']['user_name']);
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