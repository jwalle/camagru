<?php
	
	if (1)
		$row = $gallery->last_three($_SESSION['username']);
	if (!$row)
		return;
?>
    <div class="right_side">
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
</div>