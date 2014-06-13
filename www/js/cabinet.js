function save_cabinet() {
    JsHttpRequest.query(
        '../../../../../../../../backend/cabinet/save_cabinet.php',
        {
				'login': document.getElementById("my_login").value,
                'e_mail': document.getElementById("my_e_mail").value,
                'pass_out': document.getElementById("my_pass").value,
				'rand': Math.random(0,65530)
        }, 
        function(result, errors) {
            document.getElementById("debug").innerHTML = errors; 
            if (result) {
                document.getElementById("errors1").innerHTML = result["errors"];
				document.getElementById("access1").innerHTML = result["access"];
            }
        },
        false
    );
}

function save_pass() {
    JsHttpRequest.query(
        '../../../../../../../../backend/cabinet/save_pass.php',
        {
                'pass_out': document.getElementById("pass_out").value,
                'new_pass': document.getElementById("new_pass").value,
                'repeat_pass': document.getElementById("repeat_pass").value,
				'rand': Math.random(0,65530)
        }, 
        function(result, errors) {
            document.getElementById("debug").innerHTML = errors; 
            if (result) {
                document.getElementById("errors2").innerHTML = result["errors"];
				document.getElementById("access2").innerHTML = result["access"];
            }
        },
        false
    );
}