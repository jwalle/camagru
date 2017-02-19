(function() {

    var width = 480;
    var height;
    var streaming = false;
    var video = null;
    var canvas = null;
    var snap = null;
    var upload = null;
    var plop = null;

    function startup() {
        video = document.getElementById('video');
        canvas = document.getElementById('canvas');
        snap = document.getElementById('snap');
        save = document.getElementById('save');
        text = document.getElementById('text');
        upload = document.getElementById('file');
        plop = document.getElementById('plop');
        wrapper = document.getElementsByClassName('wrapper');
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
               video.style.backgroundColor = "#AAA";
                console.log("An error occured!!!  " + err);
            }
        );

        if (video)
        {
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
        }

        if (snap)
        {
            snap.addEventListener("click", function (ev) {
                //video.style.display = 'none';
                takepicture();
                getCanvas();
                console.log("plop");
                ev.preventDefault();
            }, false);
        }

        plop.addEventListener("click", function (ev) {
            render('img/plop.jpg');
            console.log("plop");
            ev.preventDefault();
        }, false);

       /* wrapper.addEventListener("dragover", function(e){e.preventDefault();}, true);
        wrapper.addEventListener("drop", function (e) {
            e.preventDefault();
            loadImage(e.dataTransfer.files[0]);
        }, true);*/

       if (upload)
       {
           upload.addEventListener("change", function (ev) {
               console.log('coucou');
               var files = ev.target.files;
               ev.preventDefault();
               if (files)
                   loadImage(files[0]);
               else
                   console.log("error files");
           }, true);
       }

        save.addEventListener("click", function (ev) {
         //   console.log('save');
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

function render(src) {
    var image = new Image();
    var context = canvas.getContext('2d');
    image.onload = function(){
        context.drawImage(image, 0, 0);
    };
    image.src = src;
}

function loadImage(src) {
    if (!src.type.match(/image.*/)) {
        console.log("This file is not an image : ", src.type);
        return;
    }
    var reader = new FileReader();
    reader.onload = function (e) {
        render(e.target.result);
    };
    reader.readAsDataURL(src);
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