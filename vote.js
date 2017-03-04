(function() {

    function startup(){
        wrapper = elClass('wrapper');
        voteDiv = elId('vote');
        upvote = elId('upvotes');
        dvote = elId('dvote');
        sumVote = elId('sumVote');
        delCom = elId('delete');
        
        sum = parseInt(sumVote.dataset.value);
        sumVote.innerHTML = sum;

        upvote.addEventListener("click", up, false);
        dvote.addEventListener("click", down, false);

        if (delCom)
            delCom.addEventListener("click", delComment, false);
        
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
        com_id = delCom.dataset.com_id;
        console.log("com_id = " + com_id);
        formData.append("com_id", com_id);
        var xmlHttpReq = false;
        var ajax = new XMLHttpRequest();
        ajax.open('POST', 'deleteComment.php', false);
        ajax.onreadystatechange = function () {
            console.log(ajax.responseText);
        }
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
        var formData = new FormData;

        formData.append("voteValue", value);
        formData.append("user", user);
        formData.append("img", img);
        var xmlHttpReq = false;
        var ajax = new XMLHttpRequest();
        ajax.open('POST', 'vote.php', false);
        ajax.onreadystatechange = function () {
            console.log(ajax.responseText);
        }
        ajax.send(formData);
    }
    window.addEventListener('load', startup, false);
})();