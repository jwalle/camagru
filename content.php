<script src="capture.js"></script>

<!-- php : GD and image fuctions. image create from string -->
<script>
    function chg() {
        video.style.width = '320px';
        video.style.height = '240px';
    }

    function plop() {
        video.style.width = '320px';
        video.style.height = '240px';
    }
</script>

<div class ="wrapper">

    <div class ="top_nav">
        <h1>welcome - <?php print($_SESSION['username']); ?></h1>
    </div>

    <div class="stream border">
        <video id="video" width="480px" height="360px" onclick="chg()">Video stream not found.</video>
        <div class="buttons border">
            <button id="snap">Take a photo !</button>
            <h2>  &nbsp; || &nbsp; </h2>
            <input type="file" name="file" id="file" class="inputfile"/>
            <label for="file">Upload a file...</label>
        </div>
    </div>
    <div class="photoshop border">
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
        <div class="save">
            <button id="save">save !</button>
        </div>
    </div>
    <button id="plop">PLOP !</button>

    <?php include_once 'right_side_gal.php'; ?>

</div>
