$(function (){
	$('.log_button').on('click', function (){
		var parent = $(this).prev ().prev ('fieldset'),
			login = parent.children ('.control.login').val (),
			pass =  parent.children ('.control.pass').val ();
		_ajax ("auth\\login", {login: login, pass: pass}, function (data) {
			data = $.parseJSON (data);
			alert (data ['message']);
			if (data ['response'] == true)
				window.location = window.location;
		});
	});
	$('.exit_span').on('click', function (){
		_ajax ("auth\\logout", {}, function (data) {
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
