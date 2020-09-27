<!DOCTYPE html>
<html>
<head> 
	<title>Anime</title>
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
		$.get('/admin/getdata', function(data){
			var types = JSON.parse(data).type;
			var type = new Array();
			for (var i = 0; i < types.length; i++) {
				for (var j = 0; j < types[i].length; j++) {
					if (!type.includes(types[i][j]))
						type.push(types[i][j]);
				}
			}
			for (var i = 0; i < type.length; i++) {
				$('ul#type').append('<li><a class="showanime" onclick="showra(this);">'+ type[i] +'</a></li><hr>')
			}
		});
		$.get('/admin/getanime/Tất Cả', function(data){
				var _id = JSON.parse(data)._id;
				var name = JSON.parse(data).name;
				var like = JSON.parse(data).like;
				var des = JSON.parse(data).des;
				var view = JSON.parse(data).view;
				var follow = JSON.parse(data).follow;
				var img = JSON.parse(data).img;
				var type = JSON.parse(data).type;
				var num_ep = JSON.parse(data).num_ep;
				var len = JSON.parse(data).num;
				$('li').remove('#page-item');
				for (var i = 2; i <= ((Math.floor(len/12) == len/12) ? len/12 : len/12 + 1); i++) {
					$('ul#page').append("<li class='page-item' id = 'page-item'><a onclick ='getpage(this)' class='page-link'>"+i+"</a></li>")
				}
				var link_am = JSON.parse(data).link_am;
				$('div').remove('#df');
				for (var i = 0; i < name.length; i++) {
					$('div#show').append("<div class='row shadow text-left mb-3 pt-2 border rounded' id='df'><div class='col-4 border-right'><img src='"+ img[i] +"'width='100%''><br>Thể Loại: "+type[i].join(', ')+"</div><div class='col-8'><div class ='row pt-2'><div class='col-10'><h5><a href ='"+link_am[i]+"' class='mlem' target='_blank'>"+ name[i] +"</a></h5></div><div class='col-2 text-right'><i><a class='edit' data-id = '"+ _id[i] +"' data-toggle='modal' data-target='#form' onclick='edit(this)'><u>Sửa</u></a> | <a data-id = '"+ _id[i] +"' class='del' onclick='dele(this)'><u>Xóa</a></u></i></div></div><hr><p><span id = 'des"+i+"' data-content ='"+des[i]+"'>"+ des[i].split('.')[0] +"...</span><span id='hiden"+i+"' class='showtext' onclick = 'showmore(this)'><i><a id='hiden"+i+"' class='hiden' >Đọc Thêm</a></i></span></p><p>Lượt Xem: "+ Intl.NumberFormat().format(view[i]) +"</p><p>Like: "+ Intl.NumberFormat().format(like[i]) +"</p><p>Follow: "+ Intl.NumberFormat().format(follow[i]) +"</p><p>Thời Lượng: "+ num_ep[i] +" Tập</p></div></div>");
				}
			});
		function showra(a){
			var val = a.innerText;
			$('a.showanime').attr('class','showanime')
			$('a#page-link-main').attr('class','page-link select-page text-white');
			$.get('/admin/getanime/' + val, function(data){
				var _id = JSON.parse(data)._id;
				var name = JSON.parse(data).name;
				var like = JSON.parse(data).like;
				var des = JSON.parse(data).des;
				var view = JSON.parse(data).view;
				var follow = JSON.parse(data).follow;
				var img = JSON.parse(data).img;
				var type = JSON.parse(data).type;
				var num_ep = JSON.parse(data).num_ep;
				var len = JSON.parse(data).num;
				$('li').remove('#page-item');
				for (var i = 2; i <= ((Math.floor(len/12) == len/12) ? len/12 : len/12 + 1); i++) {
					$('ul#page').append("<li class='page-item' id = 'page-item'><a onclick ='getpage(this)' class='page-link'>"+i+"</a></li>")
				}
				var link_am = JSON.parse(data).link_am;
				$('div').remove('#df');
				for (var i = 0; i < name.length; i++) {
					$('div#show').append("<div class='row shadow text-left mb-3 pt-2 border rounded' id='df'><div class='col-4 border-right'><img src='"+ img[i] +"'width='100%''><br>Thể Loại: "+type[i].join(', ')+"</div><div class='col-8'><div class ='row pt-2'><div class='col-10'><h5><a href ='"+link_am[i]+"' class='mlem' target='_blank'>"+ name[i] +"</a></h5></div><div class='col-2 text-right'><i><a class='edit' data-id = '"+ _id[i] +"' data-toggle='modal' data-target='#form' onclick='edit(this)'><u>Sửa</u></a> | <a data-id = '"+ _id[i] +"' class='del' onclick='dele(this)'><u>Xóa</a></u></i></div></div><hr><p><span id = 'des"+i+"' data-content ='"+des[i]+"'>"+ des[i].split('.')[0] +"...</span><span id='hiden"+i+"' class='showtext' onclick = 'showmore(this)'><i><a id='hiden"+i+"' class='hiden' >Đọc Thêm</a></i></span></p><p>Lượt Xem: "+ Intl.NumberFormat().format(view[i]) +"</p><p>Like: "+ Intl.NumberFormat().format(like[i]) +"</p><p>Follow: "+ Intl.NumberFormat().format(follow[i]) +"</p><p>Thời Lượng: "+ num_ep[i] +" Tập</p></div></div>");
				}
			});
			a.setAttribute('class',a.getAttribute('class') + ' text-danger');
		}
		function showmore(a){
			var val = a.getAttribute('id').match(/\d/g);
			if (a.getAttribute('class') == 'showtext'){
				$('span#des'+val).text($('span#des'+val).attr('data-content'));
				$('a#hiden'+val).text('Thu Gọn');
				a.setAttribute('class','hidentext');
			}
			else{
				$('span#des'+val).text(($('span#des'+val).attr('data-content')).split('.')[0]+'...');
				$('a#hiden'+val).text('Đọc Thêm');
				a.setAttribute('class','showtext');
			}
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
				  	$.get('/admin/deleteAM/'+ val);
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
			$.get('/admin/getanime/' + val + '?page=' + $('a.select-page').text(), function(data){
				var _id = JSON.parse(data)._id;
				var name = JSON.parse(data).name;
				var like = JSON.parse(data).like;
				var des = JSON.parse(data).des;
				var view = JSON.parse(data).view;
				var follow = JSON.parse(data).follow;
				var img = JSON.parse(data).img;
				var type = JSON.parse(data).type;
				var num_ep = JSON.parse(data).num_ep;
				var len = JSON.parse(data).num;
				var link_am = JSON.parse(data).link_am;
				$('div').remove('#df');
				for (var i = 0; i < name.length; i++) {
					$('div#show').append("<div class='row shadow text-left mb-3 pt-2 border rounded' id='df'><div class='col-4 border-right'><img src='"+ img[i] +"'width='100%''><br>Thể Loại: "+type[i].join(', ')+"</div><div class='col-8'><div class ='row pt-2'><div class='col-10'><h5><a href ='"+link_am[i]+"' class='mlem' target='_blank'>"+ name[i] +"</a></h5></div><div class='col-2 text-right'><i><a class='edit' data-id = '"+ _id[i] +"' data-toggle='modal' data-target='#form' onclick='edit(this)'><u>Sửa</u></a> | <a data-id = '"+ _id[i] +"' class='del' onclick='dele(this)'><u>Xóa</a></u></i></div></div><hr><p><span id = 'des"+i+"' data-content ='"+des[i]+"'>"+ des[i].split('.')[0] +"...</span><span id='hiden"+i+"' class='showtext' onclick = 'showmore(this)'><i><a id='hiden"+i+"' class='hiden' >Đọc Thêm</a></i></span></p><p>Lượt Xem: "+ Intl.NumberFormat().format(view[i]) +"</p><p>Like: "+ Intl.NumberFormat().format(like[i]) +"</p><p>Follow: "+ Intl.NumberFormat().format(follow[i]) +"</p><p>Thời Lượng: "+ num_ep[i] +" Tập</p></div></div>");
				}
			});
		}
	</script>
</head>
<body>
<div class="container mt-5 border rounded">
	<div class="row shadow text-center">
		<div class="col-2 border-right">
			<h5 class="pt-2">Thể Loại</h5>
			<hr>
			<div class="row text-left">
				<ul id="type" type="none">
					<li><a class="showanime text-danger" id="all" onclick="showra(this)">Tất Cả</a></li><hr>
				</ul>
			</div>
		</div>

		<div class="col-10 border" id="show">
			<h5 class="pt-2">Thông Tin Anime </h5>
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
<!-- 		<div class="col-2">
			<h5 class="pt-2"> Thao Tác </h5>
			<hr>
		</div> -->
	</div>
</div>
<script type="text/javascript">
	function edit(a){
		var val = a.getAttribute('data-id');
		$.get('admin/getdefault/'+ val, function(data){
			var _id = JSON.parse(data)._id;
			var name = JSON.parse(data).name;
			var like = JSON.parse(data).like;
			var des = JSON.parse(data).des;
			var view_am = JSON.parse(data).view;
			var follow = JSON.parse(data).follow;
			var img = JSON.parse(data).img;
			var num_ep = JSON.parse(data).num_ep;
			var type = JSON.parse(data).type;

			$('#name').attr('value',name);
			$('#name').attr('data-id',_id);
			$('#imgg').text(img);
			$('#intro').text(des);
			$('#view').attr('value',view_am);
			$('#like').attr('value',like);
			$('#follow').attr('value',follow);
			$('#ep').attr('value',num_ep);
			$('#typee').attr('value',type.join(', '));
		});
	}
	function send_update(){
		var data = {
			'_id': $('#name').attr('data-id'),
			'name': $('#name').val(),
			'img': $('#imgg').text(),
			'des': $('#intro').text(),
			'view': $('#view').val(),
			'like': $('#like').val(),
			'follow': $('#follow').val(),
			'num_ep': $('#ep').val(),
			'type': $('#typee').val().split(',')
		}
		if(data.name == ''){
			alert('Tên không được để trống!!!');
			return false;
		}
		if(data.img == ''){
			alert('Link ảnh không được để trống!!!');
			return false;
		}
		if(data.des == ''){
			alert('Description không được để trống!!!');
			return false;
		}
		if(data.view == ''){
			alert('View không được để trống!!!');
			return false;
		}
		if(data.like == ''){
			alert('Like không được để trống!!!');
			return false;
		}
		if(data.follow == ''){
			alert('Follow không được để trống!!!');
			return false;
		}
		if(data.num_ep == ''){
			alert('Số tập không được để trống!!!');
			return false;
		}
		if(data.type == ''){
			alert('Thể loại không được để trống!!!');
			return false;
		}
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
			}
		});
		$.post('/admin/updateAM', data, function(val){
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
				<h5 class="modal-title" id="exampleModalLabel">Cập Nhật Thông Tin Anime</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		  <form>
			<div class="modal-body">
				<div class="form-group">
					<label for="name">Tên Anime:</label>
					<input type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Tên phim">
				</div>
				<div class="form-group">
					<label for="imgg">Link ảnh:</label>
					<textarea class="form-control" id="imgg" rows="2"></textarea>
				</div>
				<div class="form-group">
					<label for="intro">Description:</label>
					<textarea class="form-control" id="intro" rows="8"></textarea>
				</div>
				<div class="form-group">
					<label for="view">Lượt xem:</label>
					<input type="number" class="form-control" id="view" placeholder="Lượt xem">
				</div>
				<div class="form-group">
					<label for="like">Like:</label>
					<input type="number" class="form-control" id="like" placeholder="Like">
				</div>
				<div class="form-group">
					<label for="follow">Follow:</label>
					<input type="number" class="form-control" id="follow" placeholder="Follow">
				</div>
				<div class="form-group">
					<label for="ep">Thời lượng:</label>
					<input type="number" class="form-control" id="ep" placeholder="Số tập">
				</div>
				<div class="form-group">
					<label for="typee" >Thể loại:</label>
					<small class="form-text text-muted">*Cách nhau bằng dấu "," nếu có từ 2 thể loại trở lên.</small>
					<input type="text" class="form-control" id="typee" placeholder="Thể loại">
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