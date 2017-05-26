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
    var stamp1 = null;
    var stream = null;
    var photoshop = null;
    var miniGal = null;

    function elId(elem) {
        return document.getElementById(elem);
    }

    function elClass(elem) {
        return document.getElementsByClassName(elem);
    }

    function startup() {
        video = elId('video');
        stream = elId('stream');
        canvasDiv = elId('canvasDiv');
        snap = elId('snap');
        save = elId('save');
        text = elId('text');
        upload = elId('file');
        plop = elId('plop');
        layer1 = elId('layer1');
        layer2 = elId('layer2');
        layer3 = elId('layer3');
        frame1 = elId('frame1');
        wrapper = elClass('wrapper');
        upvote = elClass('upvote');
        dvote = elClass('dvote');
        photoshop = elId('photoshop');
        miniGal = elId('mini_gal');
        stamps = [];

        updateMiniGal();

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
               video.setAttribute('width', width);
               video.setAttribute('height', height);
               console.log("An error occurred!!!  " + err);
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
                takepicture();
                hideCam();
                ev.preventDefault();
            }, false);
        }

        frame1.addEventListener("click", function (ev) {
            layer2.style.display = 'block';
            clearLayer(layer2);
            render(layer2, 'img/frame.png');
            ev.preventDefault();
        }, false);

        frame2.addEventListener("click", function (ev) {
            layer2.style.display = 'block';
            clearLayer(layer2);
            render(layer2, 'img/frameFlower.png');
            ev.preventDefault();
        }, false);

        frame3.addEventListener("click", function (ev) {
            layer2.style.display = 'block';
            clearLayer(layer2);
            render(layer2, 'img/frameFlower2.png');
            ev.preventDefault();
        }, false);

        frame4.addEventListener("click", function (ev) {
            layer2.style.display = 'block';
            clearLayer(layer2);
            render(layer2, 'img/frameStar.png');
            ev.preventDefault();
        }, false);

        frame5.addEventListener("click", function (ev) {
            clearLayer(layer2);
            layer2.style.display = 'none';
            ev.preventDefault();
        }, false);

       if (upload)
       {
           upload.addEventListener("change", function (ev) {
               console.log('coucou');
               var files = ev.target.files;
               ev.preventDefault();
               if (files)
                   loadImage(files[0]);
               else
                   console.log("error uploading file");
           }, true);
       }

        elId('back').addEventListener("click", function (ev) {
            hidePhotoshop();
            clearLayer(layer1);
            clearLayer(layer2);
            clearLayer(layer3);
            ev.preventDefault();
        }, false);

        save.addEventListener("click", function (ev) {
            saveImage();
            updateMiniGal();
            ev.preventDefault();
        }, false);

        clearphoto();
        hidePhotoshop();
    }

    function clearLayer(layer){
        var context = layer.getContext('2d');
        context.clearRect(0, 0, layer1.width, layer1.height);
    }

function clearphoto(){
    var context = layer1.getContext('2d');
    context.fillStyle = "#AAA";
    context.fillRect(0, 0, layer1.width, layer1.height);
}

function takepicture() {
    var context = layer1.getContext('2d');
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
        hideCam();
    };
    reader.readAsDataURL(src);
}

function updateMiniGal() {
    var xmlHttpReq = false;
    var ajax = new XMLHttpRequest();
    ajax.open('POST', 'view/right_side_gal.php', false);
    ajax.onreadystatechange = function() {
        miniGal.innerHTML = ajax.responseText;
    }
    ajax.send();
}

function saveImage() {
    var layer1Data = layer1.toDataURL("image/png");
    var layer2Data = layer2.toDataURL("image/png");
    var layer3Data = layer3.toDataURL("image/png");
    var formData = new FormData;
    formData.append("layer1Data", layer1Data);
    formData.append("layer2Data", layer2Data);
    formData.append("layer3Data", layer3Data);
    var xmlHttpReq = false;
    var ajax = new XMLHttpRequest();
    ajax.open('POST', 'post/SaveImg.php', false);
    ajax.onreadystatechange = function() {
       console.log(ajax.responseText);
    }
    ajax.send(formData);
}

    function hidePhotoshop() {
        stream.style.display = 'flex';
        photoshop.style.display = 'none';
    }

    function hideCam() {
     stream.style.display = 'none';
     photoshop.style.display = 'flex';
     drag();
}

    window.addEventListener('load', startup, false);
})();