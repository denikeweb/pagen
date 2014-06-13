function sign_up() {
    JsHttpRequest.query(
        '../../../../../../../../backend/users/sign_up.php',
        {
				'login': document.getElementById("login").value,
                'pass_out': document.getElementById("pass_out").value,
                'repeat_pass': document.getElementById("repeat_pass").value,
                'e_mail': document.getElementById("e_mail").value,
				'rand': Math.random(0,65530)
        }, 
        function(result, errors) {
            document.getElementById("debug").innerHTML = errors; 
            if (result) {
                document.getElementById("errors").innerHTML = result["errors"];
				document.getElementById("access").innerHTML = result["access"];
				if (document.getElementById("access").innerHTML.length > 0) {window.location = '/cabinet';}
            }
        },
        false
    );
}

function remind() {
	JsHttpRequest.query(
		'../../../../../../../../backend/users/remind.php',
		{
				'e_mail': document.getElementById("e_mail").value,
				'rand': Math.random(0,65530)
		}, 
		function(result, errors) {
			document.getElementById("debug").innerHTML = errors; 
			if (result) {
				document.getElementById("errors").innerHTML = result["errors"];
				document.getElementById("access").innerHTML = result["access"];
			}
		},
		false
	);
}