<script src="capture.js"></script>

<!-- php : GD and image fuctions. image create from string -->

<div class ="wrapper">

    <div class ="top_nav">
        <h1>welcome - <?php print($_SESSION['username']); ?></h1>
    </div>

    <div class="stream">
        <video id="video">Video stream not found.</video>
        <button id="snap">Take photo !</button>
        OR
        <input type="file" id="uploadPath" size="65"/>
        <button id="buttonUpload">Upload !</button>
        <br>

        <input name="textbox1" id="textbox1" type="text"/>
        <button id="text">add text</button>

    </div>
	    <canvas id="canvas"></canvas>
	    <button id="save">save !</button>
	
	<?php include_once 'right_side_gal.php'; ?>

</div>
