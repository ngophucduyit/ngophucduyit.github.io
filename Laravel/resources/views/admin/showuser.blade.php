<!DOCTYPE html>
<html>
<head>
	<title>User</title>
	<meta name = 'csrf-token' content="{{csrf_token() }}">
	<base href="{{asset('')}}">
	<link rel="shortcut icon" href="Images/Layout/unnamed.png" type="image/x-icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<link rel="stylesheet" type="text/css" href = "/CSS/fontawesome-free-5.8.2-web/css/fontawesome.min.css">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Latest compiled and minified plotly.js JavaScript -->
	<script src="https://cdn.plot.ly/plotly-latest.min.js" charset="utf-8"></script>

	<!-- OR use a specific plotly.js release (e.g. version 1.52.3) -->
	<script src="https://cdn.plot.ly/plotly-1.52.3.min.js" charset="utf-8"></script>

	<!-- OR an un-minified version is also available -->
	<script src="https://cdn.plot.ly/plotly-latest.js" charset="utf-8"></script>
	<script type="text/javascript">
		$.get('/admin/getuser', function(data){
			var roles = JSON.parse(data).roles;
			for (var i = 0; i < roles.length; i++) {
				$('ul#type').append('<li><a class="shownews" onclick="shownewsra(this);">'+ roles[i] +'</a></li><hr>')
			}
		});
		$.get('/admin/getdatauser/Tất Cả', function(data){
				var big = JSON.parse(data);
				var username = big.username;
				var display = big.display;
				var gender = big.gender;
				var birthday = big.birthday;
				var role = big.role;
				var avt = big.avt;
				var email = big.email;
				var roles = big.roles;
				$('li').remove('#page-item');
				for (var i = 2; i <= ((Math.floor(roles.length/12) == roles.length/12) ? roles.length/12 : roles.length/12 + 1); i++) {
					$('ul#page').append("<li class='page-item' id = 'page-item'><a onclick ='getpage(this)' class='page-link'>"+i+"</a></li>")
				}
				$('div').remove('#df');
				for (var i = 0; i < username.length; i++) {
					$('div#show').append("<div class='row shadow text-left mb-3 pt-2 border rounded' id='df'><div class='col-4 border-right'><img src='"+ avt[i] +"'width='100%''><br>Quyền hạn: "+role[i]+"</div><div class='col-8'><div class ='row pt-2'><div class='col-10'><h5>"+ display[i] +"</h5></div><div class='col-2 text-right'><i><a class='edit' data-id = '"+ username[i] +"' data-toggle='modal' data-target='#form' onclick='edit(this)'><u>Sửa</u></a> | <a data-id = '"+username[i]+"' class='del' onclick='dele(this)'><u>Xóa</a></u></i></div></div><hr></p><p>Tên đăng nhập: "+ username[i] +"</p><p>Giới tính: "+ gender[i] +"</p><p>Ngày sinh:"+birthday[i]+"</p><p>Email:"+email[i]+"</p></div></div>");
				}
			});
		function shownewsra(a){
			var val = a.innerText;
			$('a.shownews').attr('class','shownews')
			$('a#page-link-main').attr('class','page-link select-page text-white');
			$.get('/admin/getdatauser/' + val, function(data){
				var big = JSON.parse(data);
				var username = big.username;
				var display = big.display;
				var gender = big.gender;
				var birthday = big.birthday;
				var role = big.role;
				var avt = big.avt;
				var email = big.email;
				var roles = big.roles;
				$('li').remove('#page-item');
				for (var i = 2; i <= ((Math.floor(roles.length/12) == roles.length/12) ? roles.length/12 : roles.length/12 + 1); i++) {
					$('ul#page').append("<li class='page-item' id = 'page-item'><a onclick ='getpage(this)' class='page-link'>"+i+"</a></li>")
				}
				$('div').remove('#df');
				for (var i = 0; i < username.length; i++) {
					$('div#show').append("<div class='row shadow text-left mb-3 pt-2 border rounded' id='df'><div class='col-4 border-right'><img src='"+ avt[i] +"'width='100%''><br>Quyền hạn: "+role[i]+"</div><div class='col-8'><div class ='row pt-2'><div class='col-10'><h5>"+ display[i] +"</h5></div><div class='col-2 text-right'><i><a class='edit' data-id = '"+ username[i] +"' data-toggle='modal' data-target='#form' onclick='edit(this)'><u>Sửa</u></a> | <a data-id = '"+username[i]+"' class='del' onclick='dele(this)'><u>Xóa</a></u></i></div></div><hr></p><p>Tên đăng nhập: "+ username[i] +"</p><p>Giới tính: "+ gender[i] +"</p><p>Ngày sinh:"+birthday[i]+"</p><p>Email:"+email[i]+"</p></div></div>");
				}
			});
			a.setAttribute('class',a.getAttribute('class') + ' text-danger');
		}
		function dele(a){
			var val = a.getAttribute('data-id');
			swal({
				  title: "Xác Nhận Xóa?",
				  text: "Sau khi xóa sẽ không thể khôi phục. Tiếp tục?",
				  icon: "warning",
				  buttons: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
				  	$.get('/admin/deleteuser/'+ val);
				    swal("Thành công!!!", {
				      icon: "success",
				      buttons: true,
				    }).then((ac) => {
				    	if(ac){
				    		location.reload()
				    	}
				    	else{
				    		location.reload()
				    	}
				    });
				  } 
				  else {
				    swal("Đã hủy!!!");
				  }
				});
		}
		function getpage(a){
			$('a.page-link').attr('class','page-link');
			a.setAttribute('class','page-link select-page text-white');
			var val = $('a.text-danger').text()
			$.get('/admin/getdatauser/' + val + '?page=' + $('a.select-page').text(), function(data){
				var big = JSON.parse(data);
				var username = big.username;
				var display = big.display;
				var gender = big.gender;
				var birthday = big.birthday;
				var role = big.role;
				var avt = big.avt;
				var email = big.email;
				var roles = big.roles;
				$('div').remove('#df');
				for (var i = 0; i < username.length; i++) {
					$('div#show').append("<div class='row shadow text-left mb-3 pt-2 border rounded' id='df'><div class='col-4 border-right'><img src='"+ avt[i] +"'width='100%''><br>Quyền hạn: "+role[i]+"</div><div class='col-8'><div class ='row pt-2'><div class='col-10'><h5>"+ display[i] +"</h5></div><div class='col-2 text-right'><i><a class='edit' data-id = '"+ username[i] +"' data-toggle='modal' data-target='#form' onclick='edit(this)'><u>Sửa</u></a> | <a data-id = '"+username[i]+"' class='del' onclick='dele(this)'><u>Xóa</a></u></i></div></div><hr></p><p>Tên đăng nhập: "+ username[i] +"</p><p>Giới tính: "+ gender[i] +"</p><p>Ngày sinh:"+birthday[i]+"</p><p>Email:"+email[i]+"</p></div></div>");
				}
			});
		}
	</script>
</head>
<body>
<div class="container mt-5 border rounded">
	<div class="row shadow text-center">
		<div class="col-2 border-right">
			<h5 class="pt-2">Phân Loại</h5>
			<hr>
			<div class="row text-left">
				<ul id="type" type="none">
					<li><a class="shownews text-danger" onclick="shownewsra(this)">Tất Cả</a></li><hr>
				</ul>
			</div>
		</div>

		<div class="col-10 border" id="show">
			<h5 class="pt-2">Thông Tin User </h5>
			<hr>
			<div class="row mt-2">
				<div class="col-12">
					<nav aria-label="Page navigation example">
						<ul class="pagination" id="page">
							<li class='page-item' id="page-item-main"><a onclick ='getpage(this)' id = 'page-link-main' class='page-link select-page text-white'>1</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
	
</div>
<script type="text/javascript">
	function edit(a){
		var val = a.getAttribute('data-id');
		$.get('/admin/getdefaultuser/' + val, function(data){
			var big = JSON.parse(data);
				var username = big.username;
				var display = big.display;
				var gender = big.gender;
				var birthday = big.birthday;
				var role = big.role;
				var avt = big.avt;
				var email = big.email;

			$('#name').attr('value',display);
			$('#name').attr('data-id',username);
			$('#imgg').attr('value',avt);
			
			$('#em').attr('value',email);
			$('#date').attr('value',birthday);
		});
	}
	function send_update(){
		var data = {
			'username': $('#name').attr('data-id'),
			'display': $('#name').val(),
			'avt': $('#imgg').val(),
			'gender': $('input[name = "gen"]:checked').val(),
			'birthday': $('#date').val(),
			'role': $('#rolee').val(),
			'email': $('#em').val(),
			'reset': $('input[name = "reset"]:checked').val()
		}
		if(data.display == ''){
			alert('Tên không được để trống!!!');
			return false;
		}
		if(data.avt == ''){
			alert('Link ảnh không được để trống!!!');
			return false;
		}
		if(data.birthday == ''){
			alert('Ngày sinh không được để trống!!!');
			return false;
		}
		if(data.email == ''){
			alert('Email lòng chọn thể loại!!!');
			return false;
		}
		if(data.role == 'Chọn Quyền'){
			alert('Vui lòng chọn Quyền Hạn!!!');
			return false;
		}
		console.log(data)
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
			}
		});
		$.post('/admin/updateuser', data, function(val){
			swal("Thành công!!!", {
				icon: "success",
				buttons: true,
			}).then((ac) => {
				if(ac){
					location.reload()
				}
				else{
					location.reload()
				}
				});
		});
	}
</script>
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header border-bottom-2">
				<h5 class="modal-title" id="exampleModalLabel">Cập Nhật Tin Tức</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		  <form>
			<div class="modal-body">
				<div class="form-group">
					<label for="name">Tên hiển thị:</label>
					<input type="text" class="form-control" id="name" placeholder="Tên hiển thị">
				</div>
				<div class="form-group">
					<label for="imgg">Link ảnh đại diện:</label>
					<input type="text" class="form-control" id="imgg" placeholder="Link ảnh đại diện">
				</div>
				<div class="form-group">
					<label for="gen">Giới tính:</label>
					<input type="radio" name="gen" value="Nam" checked>Nam
					<input type="radio" name="gen" value="Nữ">Nữ
				</div>
				<div class="form-group">
					<label for="date">Ngày sinh:</label>
					<input type="text" class="form-control" id="date" placeholder="Ngày sinh">
				</div>
				<div class="form-group">
					<label for="rolee">Quyền hạn:</label>
					<select class="custom-select" id="rolee">
						<option value="Chọn Quyền">Chọn Quyền</option>
						<option value="Admin">Admin</option>
						<option value="User">User</option>
					</select>
				</div>
				<div class="form-group">
					<label for="em">Email:</label>
					<input type="text" class="form-control" id="em" placeholder="Email">
				</div>
				<div class="form-group">
					<label for="reset">Reset Password:</label>
					<input type="radio" name="reset" value="Yes">Yes
					<input type="radio" name="reset" value="No" checked>No
				</div>
			</div>
		    <div class="modal-footer border-top-0 d-flex justify-content-center">
		    	<input type="button" value="Cập Nhật" class="btn btn-success" onclick="return send_update()"></input>
		    </div>
		  </form>
		</div>
	</div>

</div>
</body>
</html>