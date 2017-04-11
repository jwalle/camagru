<script src="capture.js"></script>

<!-- php : GD and image fuctions. image create from string -->
<div class ="wrapper">

    <div class ="top_welcome">
        <h1>Welcome <?php print($_SESSION['username']); ?> !</h1>
    </div>

    <div class="stream" id="stream">
        <video id="video" width="480px" height="360px">Video stream not found.</video>
        <div class="buttons">
            <button id="snap">Take a photo !</button>
            <h2>  &nbsp; || &nbsp; </h2>
            <input type="file" name="file" id="file" class="inputfile"/>
            <label for="file">Upload a file...</label>
        </div>
        <div id="upper_gal"><h1>- Gallery -</h1></div>
    </div>
    <div class="photoshop" id="photoshop">
        <h2>Photoshop :</h2>
        <div class="cols">
            <div class="col1">
    <!--            <input name="textbox1" id="textbox1" type="text"/>-->
                <p>Choose a frame :</p>
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
                <div id="stamp1" class="stamp"></div>
                <div id="stamp1" class="stamp"></div>
            </div>
        </div>
        <div class="save" id="save">
            <div id="save_it">
                <h3>Save</h3>
            </div>
        </div>
    </div>
    <?php include_once 'right_side_gal.php'; ?>
</div>
