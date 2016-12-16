<?php require_once 'install.php'; ?>

<html>

<?php include_once 'Header.php'; ?>

<body>

<?php include_once 'side_bar.php'; ?>

<script src="capture.js">

</script>

<!-- php : GD and image fuctions. image create from string -->

<div class ="header">

    <div class="left">
        <label><a href="https://www.reddit.com/">Reddit !!</a></label>
    </div>

    <div class="right">
        <label><a href="logout.php?logout=true"><i class="glyphicon"></i>logout</a></label>
    </div>

    <div class="vid">
        <video id="video">Video stream not found.</video>
        <button id="snap">Take photo !</button>
    </div>

    <canvas id="canvas"></canvas>
    <div class="output">
        <img id="photo" alt="L'image capture apparaitra dans cette boite">
    </div>

</div>

</body>

</html>