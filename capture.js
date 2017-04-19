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
        stamp1 = elId('stamp1');
        frame1 = elId('frame1');
        wrapper = elClass('wrapper');
        upvote = elClass('upvote');
        dvote = elClass('dvote');
        photoshop = elId('photoshop');

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
            clearLayer(layer2);
            layer2.style.display = 'none';
            ev.preventDefault();
        }, false);

        stamp1.addEventListener("click", function (ev) {
            //clearLayer(layer3);
            render(layer3, 'img/Fedora.png');
            dragging('img/Fedora.png');
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
                   console.log("error uploading file");
           }, true);
       }

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
    ajax.open('POST', 'SaveImg.php', false);
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
}

function dragging(img) {
    var ctx3 = layer3.getContext('2d');
    var rect = layer3.getBoundingClientRect();
    var offsetX = rect.left; //nope
    var offsetY = rect.top; //nope
    var isdragging = false;
    var imgDrag = new Image();
    imgDrag.onload = function () {
        ctx3.drawImage(imgDrag, 0, 0);
    }
    imgDrag.src = img;

    function handleMouseDown(e) {
        canMouseX = parseInt(e.clientX-offsetX);
        canMouseY = parseInt(e.clientY-offsetY);
        console.log(e.clientX + "-X-" + offsetX);
        console.log(e.clientY + "-Y-" + offsetY);
        isdragging = true;
    }

    function handleMouseUp(e) {
        canMouseX = parseInt(e.clientX-offsetX);
        canMouseY = parseInt(e.clientY-offsetY);
        isdragging = false;
    }

    function handleMouseOut(e) {
        canMouseX = parseInt(e.clientX-offsetX);
        canMouseY = parseInt(e.clientY-offsetY);
        isdragging = false;
    }
    
    function handleMouseMove(e) {
        canMouseX = parseInt(e.clientX - offsetX);
        canMouseY = parseInt(e.clientY - offsetY);
        if (isdragging) {
            clearLayer(layer3);
            ctx3.drawImage(imgDrag, canMouseX - imgDrag.width/2, canMouseY - imgDrag.height/2);
        }
    }
    layer3.onmousedown = function(e){handleMouseDown(e);};
    layer3.onmouseup = function(e){handleMouseUp(e);};
    layer3.onmouseout = function(e){handleMouseOut(e);};
    layer3.onmousemove = function(e){handleMouseMove(e);};
}
    window.addEventListener('load', startup, false);
})();