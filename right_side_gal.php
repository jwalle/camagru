<?php
	
	if (1)
		$row = $gallery->last_three($_SESSION['user_session']);
	if (!$row)
		return;
	//echo $row[0]['img_name'];
	//echo $row[1]['img_name'];
	//echo $row[2]['img_name'];

?>

<div class="right_side">

<?php
	
	$i = 0;
	while ($i <= 2)
	{
		if ($row[$i])
			echo "<img src=" . $row[$i]['img_name'] . ">";
		$i++;
	}
?>

</div>

