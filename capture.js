(function() {

    var width = 320;
    var height = 0;

    var streaming = false;

    var video = null;
    var canvas = null;
    var snap = null;


    function startup() {
        video = document.getElementById('video');
        canvas = document.getElementById('canvas');
        snap = document.getElementById('snap');
        save = document.getElementById('save');
        text = document.getElementById('text');

//        function getImageDataURL(img) {
//            var canvas = document.getElementById('canvas');
//            canvas.width = img.width;
//            canvas.height = img.height;
//            var context = canvas.getContext('2d');
//            context.drawImage(img, 0, 0);
//            var dataURL = canvas.toDataURL('image/png');
//            return dataURL;
//        }

        navigator.getMedia = (navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia);

        navigator.getMedia(
            {
                video: true,
                audio: false
            },
            function (stream) {
                if (navigator.mozGetUserMedia) {
                    video.mozSrcObject = stream;
                } else {
                    var vendorURL = window.URL || window.webkitURL;
                    video.src = vendorURL.createObjectURL(stream);
                }
                video.play();
            },
            function (err) {
                console.log("An error occured!!!  " + err);
            }
        );

        video.addEventListener('canplay', function (ev) {
            if (!streaming) {
                height = video.videoHeight / (video.videoWidth / width);
                video.setAttribute('width', width);
                video.setAttribute('height', height);
                canvas.setAttribute('width', width);
                canvas.setAttribute('height', height);
                streaming = true;
            }
        }, false);

        snap.addEventListener("click", function (ev) {
            takepicture();
            getCanvas();
            console.log("plop");
            ev.preventDefault();
        }, false);

        save.addEventListener("click", function (ev) {
            saveImage();
            ev.preventDefault();
        }, false);

        text.addEventListener("click", function (ev) {
            text_value = document.getElementById('textbox1').value;
            addText(text_value);
            ev.preventDefault();
        }, false);
        clearphoto();
    }   

function clearphoto(){
    var context = canvas.getContext('2d');
    context.fillStyle = "#AAA";
    context.fillRect(0, 0, canvas.width, canvas.height);

    var data = canvas.toDataURL('image/png');
}

function takepicture() {
    var context = canvas.getContext('2d');
    console.log(width);
    console.log(height);

    if (width && height) {
        canvas.width = width;
        canvas.height = height;
        context.drawImage(video, 0, 0, width, height);
    } else {
        clearphoto();
    }
}

function addText(text) {
    var context = canvas.getContext('2d');
    context.font="40px Georgia";
    context.fillText(text, 10, 50);
}

function getCanvas() {
    var canvasData = canvas.toDataURL("image/png");
    var xmlHttpReq = false;
    var ajax = new XMLHttpRequest();
    console.log("plop");
    ajax.open('POST', 'getCanvas.php', false);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function() {
        console.log(ajax.responseText);
    }
    ajax.send("imgData="+canvasData);
}

function saveImage() {
    var canvasData = canvas.toDataURL("image/png");
    var xmlHttpReq = false;
    var ajax = new XMLHttpRequest();
    ajax.open('POST', 'SaveImg.php', false);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function() {
       console.log(ajax.responseText);
    }
    ajax.send("imgData="+canvasData);
}

    window.addEventListener('load', startup, false);
})();