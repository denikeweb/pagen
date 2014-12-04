$(function (){
	$('.log_button').on('click', function (){
		login = $('#login_e').val ();
		pass = $('#pass_out_e').val ();
		_ajax ("auth\\login", {login: login, pass: pass}, function (data) {
			alert(data);
			if (data == '200 OK') window.location = window.location;
		});
	});
	$('.exit_span').on('click', function (){
		_ajax ("auth\\logout", {}, function (data) {
			alert(data);
			if (data == '200 OK') window.location = window.location;
		});
	});
	login_form = function (tag){
		if (tag == 1) {
			document.getElementById("login_alert").style.display = "none";
			document.getElementById("login_form").style.display = "block";
		} else {
			document.getElementById("login_alert").style.display = "block";
			document.getElementById("login_form").style.display = "none";
		}
	}
});
