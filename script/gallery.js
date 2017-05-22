(function() {

    var gallery = null;
    var wrapper = null;
    var page = 0;
    var pages = 0;

    function elId(elem) {
        return document.getElementById(elem);
    }

    function elClass(elem) {
        return document.getElementsByClassName(elem);
    }

    function startup() {
        //gallery = elId('gallery');
        wrapper = elClass('wrapper');
        getPagesCount();
        updateGallery(page);
        document.addEventListener("scroll", function (ev) {
            if (document.body.scrollHeight ==
                document.body.scrollTop +
                window.innerHeight) {
                ++page;
                updateGallery(page);
            }
            ev.preventDefault();
        }, false);

    }

    function getPagesCount() {
        var xmlHttpReq = false;
        var ajax = new XMLHttpRequest();
        ajax.open('POST', 'post/getPagesCount.php', false);
        ajax.onreadystatechange = function() {
            pages = ajax.responseText;
            console.log('nb de page : ' + pages);
        }
        ajax.send();
        }

    function updateGallery(page) {
        var formData = new FormData;
        var xmlHttpReq = false;
        var ajax = new XMLHttpRequest();
        formData.append('page', page);
        ajax.open('POST', 'post/galleryPage.php', false);
        ajax.onreadystatechange = function() {
            var newDiv = document.createElement('div');
            var pageName = document.createElement('h2');
            pageName.innerHTML = 'Page : ' + page;
            newDiv.setAttribute('class', 'gallery');
            newDiv.setAttribute('id', 'gallery');
            newDiv.innerHTML = ajax.responseText;
            // wrapper[0].innerHTML += newDiv.firstChild;

            // console.log(wrapper);
            wrapper[0].appendChild(newDiv);
            // console.log(pageName);
            // wrapper[0].appendChild(pageName);
        }
        ajax.send(formData);
    }

    window.addEventListener('load', startup, false);
})();