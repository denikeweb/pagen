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
		var parent = $(this).prev ('fieldset'),
			login = parent.children ('.control.login').val (),
			pass =  parent.children ('.control.pass').val ();
		pagenAuth(login, pass);
	});
	$('.exit_span').on('click', function (){
		_ajax ("auth\\logout", {}, function (data) {
			if (data == '200 OK') window.location = window.location;
		});
	});
	$('.control.sign_up').on('click', function (){
		var parent = $(this).prev ('fieldset').children ('div'),
			email = parent.children ( '.control.text-email' ).val (),
			name  = parent.children ( '.control.text-name'  ).val (),
			pass  = parent.children ( '.control.text-pass'  ).val (),
			url   = parent.children ( '.control.text-url'   ).val ();
		_ajax ("auth\\sign_up", {email: email, pass: pass, name: name, url: url}, function (data) {
			data = $.parseJSON (data);
			alert (data ['message']);
			if (data ['response'] == true)
				pagenAuth (email, pass);
		});
		return false;
	});
	$('.control.blog_edit').on('click', function (){
		var parent = $(this).prev ('fieldset').children ('div'),
			id    = parent.parent ().children ( '.control.input-id' ).val (),
			url   = parent.children ( '.control.input-url' ).val (),
			desc  = parent.children ( '.control.input-desc'  ).val (),
			title  = parent.children ( '.control.input-title'  ).val (),
			text   = parent.children ( '.control.input-text'   ).val ();
		_ajax ("blog\\edit", {id: id, desc: desc, title: title, url: url, text: text}, function (data) {
			data = $.parseJSON (data);
			alert (data ['message']);
		});
		return false;
	});
	$('.control.blog_add').on('click', function (){
		var parent = $(this).prev ('fieldset').children ('div'),
			url    = parent.children ( '.control.input-url' ).val (),
			desc   = parent.children ( '.control.input-desc' ).val (),
			title  = parent.children ( '.control.input-title' ).val (),
			text   = parent.children ( '.control.input-text' ).val ();
		_ajax ("blog\\add", {desc: desc, title: title, url: url, text: text}, function (data) {
			data = $.parseJSON (data);
			alert (data ['message']);
		});
		return false;
	});
	$('.control.blog_delete').on('click', function (){
		if (confirm("Удалить заметку?")) {
			var id = $(this).prev('div').children('.control.text-id').text();
			_ajax("blog\\delete", {id: id}, function (data) {
				data = $.parseJSON(data);
				alert(data ['message']);
				if (data ['response'])
					$(this).prev('div').css({'opacity': '0.4'});
			});
		}
		return false;
	});
	$('.control.show_more_users').on('click', function (){
		var last_id   = $( '.control.last_id' ).text ();
		_ajax ("users_actions\\show_more", {last_id: last_id}, function (data) {
			data = $.parseJSON (data);
			var has_more = data ['has_more'],
				last_id  = data ['last_id'],
				contents = data ['contents'];
			$('.control.users_container').append(contents);
			$('.control.last_id').text(last_id);
			if (!has_more) $('.control.show_more_users').hide ();
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
