<?php require_once 'install.php'; ?>

<html>

<?php include_once 'Header.php'; ?>

<body>

<?php include_once 'side_bar.php'; ?>

<script src="capture.js">

</script>

<!-- php : GD and image fuctions. image create from string -->

<div class ="wrapper">

    <div class="stream">
        <video id="video">Video stream not found.</video>
        <button id="snap">Take photo !</button>
        <input name="textbox1" id="textbox1" type="text"/>
        <button id="text">add text</button>

    </div>

    <canvas id="canvas"></canvas>
	
	<?php include_once 'right_side_gal.php'; ?>

</div>

</body>

</html>