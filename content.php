<?php $auth->restrict(); ?>
<script src="capture.js"></script>
<!-- php : GD and image fuctions. image create from string -->
<div class ="wrapper">
    <div class="stream" id="stream">
        <div class ="top_welcome">
            <p>Welcome <?php print($_SESSION['auth']['user_name']); ?> !</p>
        </div>
        <video id="video" width="480px" height="360px">Video stream not found.</video>
        <div class="buttons">
            <button id="snap">Take a photo !</button>
            <h2>  &nbsp; || &nbsp; </h2>
            <input type="file" name="file" id="file" class="inputfile"/>
            <label for="file">Upload a file...</label>
        </div>
    </div>
    <div class="photoshop" id="photoshop">
        <h2>Photoshop :</h2>
        <div class="cols">
            <div class="col1">
    <!--            <input name="textbox1" id="textbox1" type="text"/>-->
                <p>Frames :</p>
                <div class="frames">
                    <div id="frame1" class="frame"></div>
                    <div id="frame2" class="frame"></div>
                    <div id="frame3" class="frame"></div>
                    <div id="frame4" class="frame"></div>
                </div>
            </div>
            <div class="col2">
                <div class="canvasDiv">
                    <canvas id="layer1" width="480px" height="360px"></canvas>
                    <canvas id="layer2" width="480px" height="360px"></canvas>
                    <canvas id="layer3" width="480px" height="360px"></canvas>
                </div>
            </div>
            <div class="col3">
                <p>Stamps :</p>
                <div id="stamp1" class="stamp"></div>
                <div id="stamp1" class="stamp"></div>
            </div>
        </div>
        <button class="button" id="save" style="vertical-align: middle"><span>Save </span></button>
    </div>
    <div class="right_side" id="mini_gal"></div>
</div>