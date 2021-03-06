<?php
if (!defined('index'))
    die('Accès interdit');
?>
<script src="script/capture.js"></script>
<script src="script/drag.js"></script>
<div class="wrapper">
    <div class="photoshop" id="photoshop">
        <h2>Photoshop :</h2>
        <div class="cols">
            <div class="col1">
                <p>Frames :</p>
                <div class="frames">
                    <div id="frame1" class="frame"></div>
                    <div id="frame2" class="frame"></div>
                    <div id="frame3" class="frame"></div>
                    <div id="frame4" class="frame"></div>
                    <div id="frame5" class="frame"></div>
                </div>
            </div>
            <div class="col2">
                <div class="canvasDiv">
                    <video id="video" width="480px" height="360px">Video stream not found.</video>
                    <canvas id="layer1" width="480px" height="360px"></canvas>
                    <canvas id="layer2" width="480px" height="360px"></canvas>
                    <canvas id="layer3" width="480px" height="360px"></canvas>
                </div>
            </div>
            <div class="col3">
                <p>Stamps :</p>
                <div id="stamp1" class="stamp"></div>
                <div id="stamp2" class="stamp"></div>
                <div id="stamp3" class="stamp"></div>
                <div id="stamp4" class="stamp"></div>
                <div id="stamp5" class="stamp"></div>
            </div>
        </div>
        <div id="buttons-snap" class="buttons">
            <button id="snap">Take a photo !</button>
            <input type="file" name="file" id="file" class="inputfile"/>
            <label for="file">Upload a file...</label>
        </div>
        <div id="buttons-pshop">
            <button class="button" id="back" style="vertical-align: middle"><span>Back </span></button>
            <button class="button" id="save" style="vertical-align: middle"><span>Save </span></button>
        </div>
    </div>
    <div class="right_side" id="mini_gal"></div>
</div>