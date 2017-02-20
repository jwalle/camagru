(function() {

    var width = 480;
    var height = 360;
    var streaming = false;
    var video = null;
    var canvasDiv = null;
    var snap = null;
    var upload = null;
    var plop = null;
    var layer1 = null;
    var layer2 = null;
    var layer3 = null;
    var frame1 = null;

    function startup() {
        video = document.getElementById('video');
        canvasDiv = document.getElementById('canvasDiv');
        snap = document.getElementById('snap');
        save = document.getElementById('save');
        text = document.getElementById('text');
        upload = document.getElementById('file');
        plop = document.getElementById('plop');
        layer1 = document.getElementById('layer1');
        layer2 = document.getElementById('layer2');
        layer3 = document.getElementById('layer3');
        frame1 = document.getElementById('frame1');
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
                    layer1.setAttribute('width', width);
                    layer1.setAttribute('height', height);
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
            render(layer1, 'img/plop.jpg');
            console.log(width);
            console.log(height);
            ev.preventDefault();
        }, false);

        frame1.addEventListener("click", function (ev) {
            clearLayer(layer2);
            render(layer2, 'img/frame.png');
            ev.preventDefault();
        }, false);

        frame2.addEventListener("click", function (ev) {
            clearLayer(layer2);
            render(layer2, 'img/frameFlower.png');
            ev.preventDefault();
        }, false);

        frame3.addEventListener("click", function (ev) {
            clearLayer(layer2);
            render(layer2, 'img/frameFlower2.png');
            ev.preventDefault();
        }, false);

        frame4.addEventListener("click", function (ev) {
            clearLayer(layer2);
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

    function clearLayer(layer){
        var context = layer.getContext('2d');
        context.clearRect(0, 0, layer1.width, layer1.height);
    }

function clearphoto(){
    var context = layer1.getContext('2d');
    context.fillStyle = "#AAA";
    context.fillRect(0, 0, layer1.width, layer1.height);

    var data = layer1.toDataURL('image/png');
}

function takepicture() {
    var context = layer1.getContext('2d');
    console.log(width);
    console.log(height);

    if (width && height) {
        layer1.width = width;
        layer1.height = height;
        context.drawImage(video, 0, 0, width, height);
    } else {
        clearphoto();
    }
}

function render(layer, src) {
    var image = new Image();
    var context = layer.getContext('2d');
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
        render(layer1, e.target.result);
    };
    reader.readAsDataURL(src);
}

function addText(text) {
    var context = layer1.getContext('2d');
    context.font="40px Georgia";
    context.fillText(text, 10, 50);
}

function getCanvas() {
    var canvasData = layer1.toDataURL("image/png");
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
    var layer1Data = layer1.toDataURL("image/png");
    var layer2Data = layer2.toDataURL("image/png");
   // var formData = new FormData;
    //formData.append("layer1Data", "prout");
    //formData.append("layer2Data", layer2Data);
    var xmlHttpReq = false;
    var ajax = new XMLHttpRequest();
    ajax.open('POST', 'SaveImg.php', false);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function() {
       console.log(ajax.responseText);
    }
    ajax.send("layer1Data="+layer1Data+"&layer2Data="+layer2Data);
}
    window.addEventListener('load', startup, false);
})();