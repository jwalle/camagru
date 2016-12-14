<?php require_once 'install.php'; ?>

<html>

<?php include_once 'Header.php'; ?>

<body>

<?php include_once 'side_bar.php'; ?>


<div class ="header">

    <div class="left">
        <label><a href="https://www.reddit.com/">Reddit !!</a></label>
    </div>

    <div class="right">
        <label><a href="logout.php?logout=true"><i class="glyphicon"></i>logout</a></label>
    </div>

    <div class="vid">
        <video id="video" width="640" height="480" autoplay></video>
        <button id="snap">Click !</button>
        <canvas id="canvas" width="640" height="480"></canvas>
    </div>

    <script>
        var video = document.getElementById('video');
        var canvas = document.getElementById('canvas');
        var photo = document.getElementById('photo');
        var context = canvas.getContext('2d');


        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia)
        {
            navigator.mediaDevices.getUserMedia({video : true}).then(function(stream) {
                video.src = window.URL.createObjectURL(stream);
                video.play();
            });
            document.getElementById("snap").addEventListener("click", function () {
                context.drawImage(video, 0, 0, 640, 480);
                var data = canvas.toDataURL('image/png');
                photo.setAttribute('src', data);
            });
        }
    </script>
</div>

</body>

</html>