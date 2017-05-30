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
        drag();
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
               sendError("La camera n'est pas disponible");
               // console.log("An error occurred!!!  " + err);
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
               var files = ev.target.files;
               ev.preventDefault();
               if (files && files[0] && files.length > 0 && files[0].size > 0 && files[0].size < 100000)
                   loadImage(files[0]);
               else {
                   sendError("Erreur durant l'envoi du fichier.");
                   location.reload();
               }
           }, true);
       }

        elId('back').addEventListener("click", function (ev) {
            hidePhotoshop();
            clearLayer(layer1);
            ev.preventDefault();
        }, false);

        save.addEventListener("click", function (ev) {
            saveImage();
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
    if (!src.type.match('image.*') || src.length == 0) {
        sendError("Ce fichier n'est pas une image.");
        location.reload();
        // console.log("This file is not an image : ", src.type);
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
    var formdata = new FormData;
    formdata.append('data', 'data');
    sendRequest('view/right_side_gal.php', formdata, function (ajax) {
        miniGal.innerHTML = ajax.responseText;
    });
}

function saveImage() {
    var layer1Data = layer1.toDataURL("image/png");
    var layer2Data = layer2.toDataURL("image/png");
    var layer3Data = layer3.toDataURL("image/png");
    var formData = new FormData;
    formData.append("layer1Data", layer1Data);
    formData.append("layer2Data", layer2Data);
    formData.append("layer3Data", layer3Data);
    sendRequest('post/SaveImg.php', formData, updateMiniGal);
}

    function hidePhotoshop() {
        elId('video').style.display = 'flex';
        elId('layer1').style.display = 'none';
        elId('buttons-pshop').style.display = 'none';
        elId('buttons-snap').style.display = 'flex';
    }

    function hideCam() {
     elId('video').style.display = 'none';
     elId('layer1').style.display = 'flex';
     elId('buttons-pshop').style.display = 'block';
     elId('buttons-snap').style.display = 'none';
    }

    window.addEventListener('load', startup, false);
})();