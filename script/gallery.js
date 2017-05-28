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
        wrapper = elClass('wrapper');
        page = elId('page').value;
        getPagesCount();
        updateGallery(page);
        document.addEventListener("scroll", function (ev) {
            if ((document.body.scrollHeight ==
                document.body.scrollTop +
                window.innerHeight) && page < pages - 1) {
                ++page;
                setTimeout(updateGallery, 1000, page); //TODO : timeout
            }
            ev.preventDefault();
        }, false);

    }

    function getPagesCount() {
        sendRequest('post/getPagesCount.php', null, function (ajax) {
            pages = Math.ceil(parseInt(ajax.responseText) / 20);
        })
    }

    function updateGallery(page) {
        var formData = new FormData;
        var ajax = new XMLHttpRequest();
        formData.append('page', page);

        ajax.open('POST', 'post/galleryPage.php');
        ajax.onload = function() {
            var newDiv = document.createElement('div');
            var pageName = document.createElement('h2');
            pageName.innerHTML = 'Page : ' + page;
            // wrapper.querySelector('pages').outerHTML = 'none';
            newDiv.setAttribute('class', 'gallery');
            newDiv.setAttribute('id', 'gallery');
            newDiv.innerHTML = ajax.responseText;
            wrapper[0].appendChild(newDiv);
            displayPagination();
        }
        ajax.send(formData);
    }

    function displayPagination() {
        var xmlHttpReq = false;
        var ajax = new XMLHttpRequest();
        ajax.open('POST', 'post/displayPagin.php');
        ajax.onload = function() {
            var newDiv = document.createElement('div');
            newDiv.setAttribute('class', 'pages');
            newDiv.innerHTML = ajax.responseText;
            wrapper[0].appendChild(newDiv);
        }
        ajax.send();
    }

    window.addEventListener('load', startup, false);
})();