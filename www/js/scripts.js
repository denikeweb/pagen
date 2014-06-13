if (self.parent.frames.length != 0) {self.parent.location = window.location;} //iframe defence 
function login_form(tag){
	if (tag == 1) {
		document.getElementById("login_alert").style.display = "none";
		document.getElementById("login_form").style.display = "block";
	} else {
		document.getElementById("login_alert").style.display = "block";
		document.getElementById("login_form").style.display = "none";
	}
}

function login() {
    JsHttpRequest.query(
        '../backend/login.php',
        {
			'login': document.getElementById("login_e").value,
			'pass_out': document.getElementById("pass_out_e").value,
			'rand': Math.random(0,65530)
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
}