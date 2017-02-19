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

<!--    <div class="stream border">-->
<!--        <video id="video" width="480px" height="360px" onclick="chg()">Video stream not found.</video>-->
<!--        <div class="buttons border">-->
<!--            <button id="snap">Take a photo !</button>-->
<!--            <h2>  &nbsp; || &nbsp; </h2>-->
<!--            <input type="file" name="file" id="file" class="inputfile"/>-->
<!--            <label for="file">Upload a file...</label>-->
<!--        </div>-->
<!--        <br>-->
<!---->
<!--    </div>-->
    <div class="photoshop border">
        <div class="col1">
            <input name="textbox1" id="textbox1" type="text"/>
        </div>
        <div class="col2">
            <canvas id="canvas" width="480px" height="360px"></canvas>
        </div>
        <div class="col3">
            <button id="text">add text</button>
        </div>
    </div>
    <button id="plop">PLOP !</button><br>

    <button id="save">save !</button>
    <?php include_once 'right_side_gal.php'; ?>

</div>
