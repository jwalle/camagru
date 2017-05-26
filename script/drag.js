function drag() {
    var canvas = elId('layer3');
    var ctx = canvas.getContext('2d');
    var bound = canvas.getBoundingClientRect();
    var offsetX = bound.left;
    var offsetY = bound.top;
    var width = canvas.width;
    var height = canvas.height;


    var canDrag = false;
    var startX;
    var startY;
    var stamps = [{},{},{},{},{}];

    addStamp(0, 'fedora', 'img/Fedora.png');
    addStamp(1, 'catEars', 'img/catEars.png');
    addStamp(2, 'dog', 'img/dog.png');
    addStamp(3, 'bald', 'img/bald.png');
    addStamp(4, 'glasses', 'img/glasses.png');


    canvas.onmousedown = mouseDown;
    canvas.onmouseup = mouseUp;
    canvas.onmousemove = mouseMove;
    elId('stamp1').addEventListener("click", function (ev) {
        switchStamp(0);
        draw();
        ev.preventDefault();
    }, false);

    elId('stamp2').addEventListener('click', function (ev) {
        switchStamp(1);
        draw();
        ev.preventDefault();
    }, false);

    elId('stamp3').addEventListener('click', function (ev) {
        switchStamp(2);
        draw();
        ev.preventDefault();
    }, false);

    elId('stamp4').addEventListener('click', function (ev) {
        switchStamp(3);
        draw();
        ev.preventDefault();
    }, false);

    elId('stamp5').addEventListener('click', function (ev) {
        switchStamp(4);
        draw();
        ev.preventDefault();
    }, false);


    draw();

    function switchStamp(index) {
        stamps[index].isOn ? stamps[index].isOn = false : stamps[index].isOn = true;
    }

    function clear() {
        ctx.clearRect(0, 0, width, height);
    }

    function draw() {
        clear();
        for (var i = 0; i < 5; i++){
            stp = stamps[i];
            if (stp.isOn)
                ctx.drawImage(stp.img, stp.x, stp.y);
        }
    }

    function mouseDown(e) {
        e.preventDefault();
        e.stopPropagation();

        var mx = parseInt(e.clientX - offsetX);
        var my = parseInt(e.clientY - offsetY);

        canDrag = false;
        for (var i = 0; i < 5; i++) {
            var stp = stamps[i];
            // console.log('mx = ' + mx + ' stp.x = ' + stp.x);
            if (mx > stp.x && mx < stp.x + stp.img.width &&
                my > stp.y && my < stp.y + stp.img.height && stp.isOn) {
                canDrag = true;
                stp.isDragging = true;
            }
        }
        startX = mx;
        startY = my;
    }

    function mouseUp(e) {
        e.preventDefault();
        e.stopPropagation();

        canDrag = false;
        for (var i = 0; i < 5; i++) {
            stamps[i].isDragging = false;
        }
    }

    function mouseMove(e) {
        if (canDrag) {
            e.preventDefault();
            e.stopPropagation();

            var mx = parseInt(e.clientX - offsetX);
            var my = parseInt(e.clientY - offsetY);

            var dx = mx - startX;
            var dy = my - startY;

            for (var i = 0; i < 5; i++) {
                var stp = stamps[i];
                if (stp.isDragging) {
                    stp.x += dx;
                    stp.y += dy;
                }
            }
            draw();

            startX = mx;
            startY = my;
        }
    }

    function addStamp(index, name, url) {
        stamps[index].x = 0;
        stamps[index].y = 0;
        stamps[index].z = 0;
        stamps[index].name = name;
        stamps[index].img = new Image();
        stamps[index].img.src = url;
        stamps[index].isDragging = false;
        stamps[index].isOn = false;
    }

    function elId(elem) {
        return document.getElementById(elem);
    }
}