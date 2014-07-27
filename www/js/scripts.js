var ajax_contents;
(function (){
    if (self.parent.frames.length != 0) {self.parent.location = window.location;} //iframe deffence
    function getSiteName () {
        var url = window.location.href, count = 0, n = url.length, urlSlashEnd = 3, thisUrl = '';
        for (var i = 0; i < n && count != urlSlashEnd; i ++) {
            if (url [i] == '/') {count ++;}
            thisUrl += url [i];
        }
        return thisUrl;
    }

    var url = getSiteName () + 'controllers/ajax/index.php';
    $.ajaxSetup({
        url: url,
        type: 'POST',
        timeout: 5000
    });

    _ajax = function (file, args, func) {
        var success_func, myData, sArgs = '';
        if (func == false) {
            success_func = function (data, textStatus, jqXHR) {ajax_contents = data};
        } else {
            success_func = func;
        }

	    for (arg in args) {
		    sArgs +=  '&'+ arg + '=' + encodeURIComponent(args [arg]);
	    }
        myData = "f=" + file + sArgs;
        $.ajax({
            data: myData,
            success: success_func
        });
    }
}).call(this);


$(function (){
    $('.log_button').on('click', function (){
        login = $('#login_e').val ();
        pass = $('#pass_out_e').val ();
        _ajax ('auth/login', {login: login, pass: pass}, function (data) {alert(data)});
    });
    $('.exit_span').on('click', function (){
        _ajax ('auth/logout', {}, function (data) {alert(data)});
    });
});

//---------------------------------------------------------------------
function login_form (tag){
    if (tag == 1) {
        document.getElementById("login_alert").style.display = "none";
        document.getElementById("login_form").style.display = "block";
    } else {
        document.getElementById("login_alert").style.display = "block";
        document.getElementById("login_form").style.display = "none";
    }
}