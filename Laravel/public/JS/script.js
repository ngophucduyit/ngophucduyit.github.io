$(window).on('load', main());

function main() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#search').keyup(function () {
		var qr = $("#search").val();
		if (qr == '')
			$('#list_rs').html('').removeClass('list-rs-show');
		else
			$.get('live_search/' + qr, function (data) {
				$('#list_rs').html(data).addClass('list-rs-show');
			});
	});
	try {

		var h = $('.msc').width() * 9 / 16;
		$('.msc').css({
			"height": h + 'px'
		});

		//  $('#hinhtren').css({
		// 	height: '100%'
		// })
		// $('#hinhduoi').css({
		// 	height: '100%'
		// })

		$(window).resize(function () {
			var h = $('.msc').width() * 9 / 16;
			$('.msc').css({
				"height": h + 'px'
			});

		});
	}
	catch (e) {
		console.log(e)
	}

	if ($(window).width() > 991) {
		var h = $('.col-lg-3').width() * 109 / 60 - 42;
		$('.tab-pane').css({
			"height": h
		});
	} else {
		$('.tab-pane').css({
			"height": "auto"
		});
	}
	$(window).resize(function () {
		if ($(window).width() > 991) {
			var h = $('.col-lg-3').width() * 109 / 60 - 42;
			$('.tab-pane').css({
				"height": h
			});
		} else {
			$('.tab-pane').css({
				"height": 'auto'
			});
		}
	});
	$(".user-header").css({ "height": $(document).height() });


	// setTimeout(function(){
	// 	$(".se-pre-con").fadeOut("slow");
	// 	$(".se-pre-con").remove();
	// },3000)


}

function chklgin() {

	var usname = $('#lgName').val();
	var pw = $('#lgpass').val();
	var sve = document.getElementById("sve").checked;
	var tk = document.getElementsByName('_token').value;
	$.post('login', { usname: usname, pw: pw, sve: sve }, function (data) {
		if (data == 'success')
			location.reload();
		else
			$('#mes').html('Tên tài khoản hoặc mật khẩu không chính xác');
	});
	return false;
}

function chkRegex() {
	if (!chkname() || !chkpass() || !chkpassAgain() || !chkDisplayName()) {
		return false;
	}
	else
		return true;
}
function checkDuplicate(){
	$.get('/checkUsername',{username:$('#username').val()},function(data){
		var dt = JSON.parse(data);
		if(dt.status == 'success'){
			$('#erName').html('');
			$('#reg-btn').prop('disabled',false);
		}
		else{
			$('#erName').html('Tài khoản đã tồn tại');
			$('#reg-btn').prop('disabled',true);
		}
	});
}
function chkname() {
	var name = $('#username').val();
	var re = /^[a-zA-Z][a-zA-Z0-9]{5,19}/;
	if (name == '' || name.length > 20) {
		$('#erName').html('Phải từ 6-30 ký tự');
		return false;
	}
	else if (!re.test(name)) {
		$('#erName').html('Không hợp lệ');
		return false;
	}
	else {
		$('#erName').html('');
		return true;
	}
}

function chkpass() {
	var pass = $('#password').val();
	var re = /.{6,30}/;
	if (pass == null || pass.length > 30 || !re.test(pass)) {
		$('#erPass').html('Phải từ 6-30 ký tự');
		return false;
	}
	else {
		$('#erPass').html('');
		return true;
	}
}

function emailExist(){
	$.get('/checkemail',{email:$('#mail').val()},function(data){
		var dt = JSON.parse(data);
		if(dt.status == 'success'){
			$('#erEmail').html('');
			$('#reg-btn').prop('disabled',false);
		}
		else{
			$('#erEmail').html('Email đã tồn tại');
			$('#reg-btn').prop('disabled',true);
		}
	});
}

function chkpassAgain() {
	var pass = $('#password').val();
	var passA = $('#passwordAgain').val();
	if (pass != passA) {
		$('#erPassA').html('2 mật khẩu không khớp')
		return false;
	} else {
		$('#erPassA').html('')
		return true;
	}
}

function chkDisplayName() {
	var name = $('#displayName').val();
	var re = /^[a-zA-Z][a-zA-Z0-9\s]{7,39}/;
	if (name == '' || name.length > 40) {
		$('#erDName').html('Phải từ 8-20 ký tự');
		return false;
	}
	else if (!re.test(name)) {
		$('#erDName').html('Không hợp lệ');
		return false;
	}
	else {
		$('#erDName').html('');
		return true;
	}
}
function chkbirthday() {
	var day = $('#day').val();
	var month = $('#month').val();
	var year = $('#year').val();
	var date = new Date(year, month - 1, day);
	$('#erName').html(date.getDate() + '/' + date.getMonth() + '/' + date.getFullYear());
	$('#day').val(date.getDate());
	$('#month').val(date.getMonth() + 1);
	$('#year').val(date.getFullYear());
}
