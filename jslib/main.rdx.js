/**
 * Created by revelation on 21/03/2020.
 */
//declare vue js here
var vue = new Vue({
    el: '#app',
    data: function () {
        return {info: '', loading: false, page: page_var}
    }
});

//clear notifications
function clear_notifications() {
    axi.post("access/notifications-clear/?agent=axios", {uid: USER_ID})
        .then(function (res) {
            var r = res.data;
            location.reload(true);
        })
        .catch(function (err) {
            //keep it to ur self
        })
}

//start vue actions
function start_loading(msg) {
    vue.$data.info = msg;
    vue.$data.loading = true;
}
function stop_loading(msg) {
    vue.$data.info = msg;
    vue.$data.loading = false;
}

//time ago
function time_ago(ts) {

    var seconds = Math.floor((new Date() - ts) / 1000);

    var interval = Math.floor(seconds / 31536000);

    if (interval > 1) {
        return interval + " years ago";
    }
    interval = Math.floor(seconds / 2592000);
    if (interval > 1) {
        return interval + " months ago";
    }
    interval = Math.floor(seconds / 86400);
    if (interval > 1) {
        return interval + " days ago";
    }
    interval = Math.floor(seconds / 3600);
    if (interval > 1) {
        return interval + " hours ago";
    }
    interval = Math.floor(seconds / 60);
    if (interval > 1) {
        return interval + " minutes ago";
    }
    return Math.floor(seconds) + " seconds ago";
}

//full time stamp
function full_time(ts) {
    return new Date(ts).toDateString();
}

//my boolean converter var to boolean
function vtb(d) {
    return (d === 'true');
}
// int to boolean
function itb(d) {
    return (parseInt(d) === 1);
}
// str to int
function sti(d) {
    return parseInt(d);
}
//get random number
function getRandom(length) {
    return parseInt((Math.random() * length + 1));
}
//get random number
function getRandomChar(length) {
    var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890!+";
    var tLenght = chars.length - 1;
    var res = "";
    for (var i = 0; i <= length; i++) {
        res += chars[parseInt((Math.random() * tLenght + 1))];
    }
    return res;
}

//open separate window
function openWin(url) {
    var w = window.open(url, 'reedax-win', 'width=900, height=600');
    w.focus();
}