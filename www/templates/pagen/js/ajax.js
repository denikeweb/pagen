var ajax_contents;
//if (self.parent.frames.length != 0) self.parent.location = window.location;

(function () {
	var url = '//' + document.domain + '/packages/Controllers/Ajax/index.php';
	$.ajaxSetup({
		url: url,
		type: 'POST',
		timeout: 5000
	});

	_ajax = function (file, args, func) {
		var success_func, myData, sArgs = '';
		if (func === undefined) {
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
})();