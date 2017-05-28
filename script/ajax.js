function sendRequest(url, postData, callback, arg) {
    var ajax = new XMLHttpRequest();
    if (!ajax)
        return;
    ajax.open('POST', url);
    ajax.onreadystatechange = function () {
        if (ajax.readyState === XMLHttpRequest.DONE && ajax.status === 200){
            if (callback) {
                if (arg) {
                    callback(arg);
                }
                else
                    callback(ajax);
            }
        }
    }
    ajax.send(postData);
}

//TODO : vote callback casse

function sendError(msg) {
    var formdata = new FormData;
    formdata.append('msg', msg);
    sendRequest('post/errorMsg.php', formdata);
}