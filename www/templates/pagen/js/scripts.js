$(function (){
	pagenAuth = function (login, pass) {
		_ajax ("auth\\login", {login: login, pass: pass}, function (data) {
			data = $.parseJSON (data);
			alert (data ['message']);
			if (data ['response'] == true)
				window.location = window.location;
		});
	};

	$('.control.sign_in').on('click', function (){
		var parent = $(this).prev ().prev ('fieldset'),
			login = parent.children ('.control.login').val (),
			pass =  parent.children ('.control.pass').val ();
		pagenAuth(login, pass);
		/*_ajax ("auth\\login", {login: login, pass: pass}, function (data) {
			data = $.parseJSON (data);
			alert (data ['message']);
			if (data ['response'] == true)
				window.location = window.location;
		});*/
	});
	$('.exit_span').on('click', function (){
		_ajax ("auth\\logout", {}, function (data) {
			if (data == '200 OK') window.location = window.location;
		});
	});
	$('.control.sign_up').on('click', function (){
		var parent = $(this).prev ('fieldset'),
			email = parent.children ('div').children ( '.control.text-email' ).val (),
			name  = parent.children ('div').children ( '.control.text-name'  ).val (),
			pass  = parent.children ('div').children ( '.control.text-pass'  ).val (),
			url   = parent.children ('div').children ( '.control.text-url'   ).val ();
		_ajax ("auth\\sign_up", {email: email, pass: pass, name: name, url: url}, function (data) {
			data = $.parseJSON (data);
			alert (data ['message']);
			if (data ['response'] == true)
				pagenAuth (email, pass);
		});
		return false;
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
