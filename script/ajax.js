function sendRequest(url, postData, callback, arg) {
    var ajax = new XMLHttpRequest();
    if (!ajax)
        return;
    ajax.open('POST', url);
    ajax.onreadystatechange = function () {
        if (ajax.readyState === XMLHttpRequest.DONE && ajax.status === 200){
            if (arg)
                callback(arg);
            else {
                callback ? callback(ajax) : console.log(ajax.responseText);
            }
        }
    }
    ajax.send(postData);
}