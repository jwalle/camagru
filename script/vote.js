(function() {

    function startup() {
        wrapper = elClass('wrapper');
        voteDiv = elId('vote');
        upvote  = elId('upvotes');
        dvote   = elId('dvote');
        sumVote = elId('sumVote');
        sum     = parseInt(sumVote.dataset.value);
        delCom  = elClass('delete');
        delImg = elId('del_pic');
        postCom = elId('postCom');

        sumVote.innerHTML = sum;
        upvote.addEventListener("click", up, false);
        dvote.addEventListener("click", down, false);
        postCom.addEventListener("submit", sendComment);

        if (delCom) {
            [].forEach.call(delCom, function (e) {
                e.addEventListener("click", delComment, false);
            });
        }

        if (delImg) {
            delImg.addEventListener("click", delImage, false);
        }

        userVote = parseInt(voteDiv.dataset.vote);
        if (userVote === -1)
            blockDown();
        else if (userVote === 1)
            blockUp();
    }


    function elId(elem) {
        return document.getElementById(elem);
    }

    function elClass(elem) {
        return document.getElementsByClassName(elem);
    }
    
    function delComment() {
        var formData   = new FormData;
        var xmlHttpReq = false;
        var ajax       = new XMLHttpRequest();

        com_id = this.dataset.com_id;
        formData.append("com_id", com_id);
        ajax.open('POST', 'post/deleteComment.php', false);
        ajax.onreadystatechange = function () {
            console.log(ajax.responseText);
        };
        ajax.send(formData);
        location.reload();
    }

    function delImage() {
        var formData   = new FormData;
        var xmlHttpReq = false;
        var ajax       = new XMLHttpRequest();

        img_id = this.dataset.img_id;
        formData.append("img_id", img_id);
        ajax.open('POST', 'post/deleteImage.php', false);
        ajax.onreadystatechange = function () {
            console.log(ajax.responseText);
        };
        ajax.send(formData);
            location.reload();
    }

    function blockUp() {
        upvote.firstChild.style.borderColor = "#00c500";
        dvote.firstChild.style.borderColor = "darkred";
        upvote.removeEventListener("click", up);
        dvote.addEventListener("click", down, false);
    }

    function blockDown() {
        dvote.firstChild.style.borderColor = "#d90008";
        upvote.firstChild.style.borderColor = "green";
        dvote.removeEventListener("click", down);
        upvote.addEventListener("click", up, false);
    }

    function up() { //TOD: user mix-up error to fix
        blockUp();
        sum += 1;
        sumVote.innerHTML = sum;
        vote(1);
    }

    function down() {
        blockDown();
        sum -= 1;
        sumVote.innerHTML = sum;
        vote(-1);
    }

    function vote(value) {
        img = voteDiv.dataset.image;
        user = voteDiv.dataset.user;
        sendVote(value, user, img);
    }

    function sendVote (value, user, img)
    {
        var formData   = new FormData;
        var ajax       = new XMLHttpRequest();

        formData.append("voteValue", value);
        formData.append("user", user);
        formData.append("img", img);
        ajax.open('POST', 'post/vote.php', false);
        ajax.onreadystatechange = function () {
            console.log(ajax.responseText);
        };
        ajax.send(formData);
    }

    function sendComment(ev) {
        // ev.preventDefault(); TODO : remove comment
        var ajax     = new XMLHttpRequest();
        var formData = new FormData;

        formData.append('image-id', document.getElementsByName('image-id')[0].value);
        formData.append('comment', document.getElementsByName('comment')[0].value);

        ajax.open('POST', 'post/post-comment.php', false);
        ajax.onreadystatechange = function () {
            console.log(ajax.responseText);
        };
        ajax.send(formData);
    }
    window.addEventListener('load', startup, false);
})();