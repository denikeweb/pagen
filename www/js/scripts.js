var ajax_contents;
(function (){
    if (self.parent.frames.length != 0) {self.parent.location = window.location;} //iframe deffence
    function getSiteName () {
        var url = window.location.href;
        var count = 0;
        var n = url.length;
        var urlSlashEnd = 3;
        var thisUrl = '';
        for (var i = 0; i < n && count != urlSlashEnd; i ++) {
            if (url [i] == '/') {
                count ++;
            }
            thisUrl += url [i];
        }
        //!!!!!!!!!!!!!!!!!!!!!!!!!
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

        var i = 0;
        args.forEach(function (){
            sArgs += '&'+ /**/i/**/ + '=' + args [i];
            i ++;
        });
        //!!!!!!!!!!!!!!!!!!!!!!!!! + assoc array
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
        _ajax ('auth/login', [login, pass], function (data) {alert(data)});
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
/*
function login() {
    JsHttpRequest.query(
        '../backend/login.php',
        {
			'login': document.getElementById("login_e").value,
			'pass_out': document.getElementById("pass_out_e").value,
			'rand': Math.random(0, 65530)
        }, 
        function(result, errors) {
            document.getElementById("debug").innerHTML = errors; 
            if (result) {
				bool = result["bool"];
				if (bool === true) {window.location = window.location;}
				if (result["errors"].length > 0) {alert(result["errors"]);}
			}
        },
        false
    );
}

function exit() {
        JsHttpRequest.query(
            '../backend/exit.php',
            {
					'rand': Math.random(0,65530)
            }, 
            function(result, errors) {
                document.getElementById("debug").innerHTML = errors; 
                if (result) {
					window.location = window.location;
					}
            },
            false
        );
}*/