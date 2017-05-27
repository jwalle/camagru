(function() {

    function startup() {
        wrapper = elClass('wrapper');
        voteDiv = elId('vote');
        upvote  = elId('upvotes');
        dvote   = elId('dvote');
        sumVote = elId('sumVote');
        sum     = parseInt(sumVote.innerHTML);
        delCom  = elClass('delete');
        delImg = elId('del_pic');
        postCom = elId('postCom');

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
        var formData = new FormData;
        formData.append('comId', this.dataset.comid);
        formData.append("imgId", this.dataset.imgid);
        sendRequest('post/deleteComment.php', formData, function (ajax) {
            console.log(ajax.responseText);
            location.reload();
        })
    }

    function delImage() {
        var formData = new FormData;
        formData.append("img_id", this.dataset.img_id);
        sendRequest('post/deleteImage.php', formData, function (ajax) {
            console.log(ajax.responseText);
            location.reload();
        })
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

    function updateVote(image) {
        var formData = new FormData;
        formData.append('image', image);
        sendRequest('post/getVotes.php', formData, function (ajax) {
           sumVote.innerHTML = ajax.responseText;
           // location.reload();
        });
    }

    function up() { //TODO: user mix-up error to fix
        blockUp();
        vote(1);
    }

    function down() {
        blockDown();
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
        formData.append("voteValue", value);
        formData.append("user", user);
        formData.append("img", img);
        sendRequest('post/vote.php', formData, updateVote, img);
    }

    function sendComment() {
        var formData = new FormData;
        formData.append('image-id', document.getElementsByName('image-id')[0].value);
        formData.append('comment', document.getElementsByName('comment')[0].value);
        sendRequest('post/post-comment.php', formData);
    }
    window.addEventListener('load', startup, false);
})();