<?php
	
	if (1)
		$row = $gallery->last_three($_SESSION['username']);
	if (!$row)
		return;
?>
<div class="right_side">
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