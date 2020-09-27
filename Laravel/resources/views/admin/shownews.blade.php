<!DOCTYPE html>
<html>
<head>
	<title>Tin Tức</title>
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
		$.get('/admin/getnews', function(data){
			var tags = JSON.parse(data).tag;
			var tag = new Array();
			for (var i = 0; i < tags.length; i++) {
					if (!tag.includes(tags[i]))
						tag.push(tags[i]);
				}
			for (var i = 0; i < tag.length; i++) {
				$('ul#type').append('<li><a class="shownews" onclick="shownewsra(this);">'+ tag[i] +'</a></li><hr>')
			}
		});
		$.get('/admin/getdatanews/Tất Cả', function(data){
				var big = JSON.parse(data);
				var url = big.url;
				var _id = big._id;
				var img = big.img;
				var title = big.title;
				var tag = big.tag;
				var view = big.view;
				var des = big.des;
				var public_day = big.public_day;
				var len = big.num;
				$('li').remove('#page-item');
				for (var i = 2; i <= ((Math.floor(len/12) == len/12) ? len/12 : len/12 + 1); i++) {
					$('ul#page').append("<li class='page-item' id = 'page-item'><a onclick ='getpage(this)' class='page-link'>"+i+"</a></li>")
				}
				$('div').remove('#df');
				for (var i = 0; i < title.length; i++) {
					$('div#show').append("<div class='row shadow text-left mb-3 pt-2 border rounded' id='df'><div class='col-4 border-right'><img src='"+ img[i] +"'width='100%''><br>Thể Loại: "+tag[i]+"</div><div class='col-8'><div class ='row pt-2'><div class='col-10'><h5><a class='mlem' href='"+url[i]+"' target ='_blank'>"+ title[i] +"</a></h5></div><div class='col-2 text-right'><i><a class='edit' data-id = '"+ _id[i] +"' data-toggle='modal' data-target='#form' onclick='edit(this)'><u>Sửa</u></a> | <a data-id = '"+_id[i]+"' class='del' onclick='dele(this)'><u>Xóa</a></u></i></div></div><hr><p><span id = 'des"+i+"' data-content ='"+des[i]+"'>"+ des[i].split('.')[0] +"...</span><span id='hiden"+i+"' class='showtext' onclick = 'showmore(this)'><i><a id='hiden"+i+"' class='hiden' >Đọc Thêm</a></i></span></p><p>Lượt Xem: "+ Intl.NumberFormat().format(view[i]) +"</p><p>Ngày đăng: "+ public_day[i] +"</p></div></div>");
				}
			});
		function shownewsra(a){
			var val = a.innerText;
			$('a.shownews').attr('class','shownews')
			$('a#page-link-main').attr('class','page-link select-page text-white');
			$.get('/admin/getdatanews/' + val, function(data){
				var big = JSON.parse(data);
				var url = big.url;
				var _id = big._id;
				var img = big.img;
				var title = big.title;
				var tag = big.tag;
				var view = big.view;
				var des = big.des;
				var public_day = big.public_day;
				var len = big.num;
				$('li').remove('#page-item');
				for (var i = 2; i <= ((Math.floor(len/12) == len/12) ? len/12 : len/12 + 1); i++) {
					$('ul#page').append("<li class='page-item' id = 'page-item'><a onclick ='getpage(this)' class='page-link'>"+i+"</a></li>")
				}
				$('div').remove('#df');
				for (var i = 0; i < title.length; i++) {
					$('div#show').append("<div class='row shadow text-left mb-3 pt-2 border rounded' id='df'><div class='col-4 border-right'><img src='"+ img[i] +"'width='100%''><br>Thể Loại: "+tag[i]+"</div><div class='col-8'><div class ='row pt-2'><div class='col-10'><h5><a class='mlem' target ='_blank' href='"+url[i]+"'>"+ title[i] +"</a></h5></div><div class='col-2 text-right'><i><a class='edit' data-id = '"+ _id[i] +"' data-toggle='modal' data-target='#form' onclick='edit(this)'><u>Sửa</u></a> | <a data-id = '"+_id[i]+"' class='del' onclick='dele(this)'><u>Xóa</a></u></i></div></div><hr><p><span id = 'des"+i+"' data-content ='"+des[i]+"'>"+ des[i].split('.')[0] +"...</span><span id='hiden"+i+"' class='showtext' onclick = 'showmore(this)'><i><a id='hiden"+i+"' class='hiden' >Đọc Thêm</a></i></span></p><p>Lượt Xem: "+ Intl.NumberFormat().format(view[i]) +"</p><p>Ngày đăng: "+ public_day[i] +"</p></div></div>");
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
				  	$.get('/admin/deletenews/'+ val);
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
			$.get('/admin/getdatanews/' + val + '?page=' + $('a.select-page').text(), function(data){
				var big = JSON.parse(data);
				var url = big.url;
				var _id = big._id;
				var img = big.img;
				var title = big.title;
				var tag = big.tag;
				var view = big.view;
				var des = big.des;
				var public_day = big.public_day;
				var len = big.num;
				$('div').remove('#df');
				for (var i = 0; i < title.length; i++) {
					$('div#show').append("<div class='row shadow text-left mb-3 pt-2 border rounded' id='df'><div class='col-4 border-right'><img src='"+ img[i] +"'width='100%''><br>Thể Loại: "+tag[i]+"</div><div class='col-8'><div class ='row pt-2'><div class='col-10'><h5><a class='mlem' target ='_blank' href='"+url[i]+"'>"+ title[i] +"</a></h5></div><div class='col-2 text-right'><i><a class='edit' data-id = '"+ _id[i] +"' data-toggle='modal' data-target='#form' onclick='edit(this)'><u>Sửa</u></a> | <a data-id = '"+_id[i]+"' class='del' onclick='dele(this)'><u>Xóa</a></u></i></div></div><hr><p><span id = 'des"+i+"' data-content ='"+des[i]+"'>"+ des[i].split('.')[0] +"...</span><span id='hiden"+i+"' class='showtext' onclick = 'showmore(this)'><i><a id='hiden"+i+"' class='hiden' >Đọc Thêm</a></i></span></p><p>Lượt Xem: "+ Intl.NumberFormat().format(view[i]) +"</p><p>Ngày đăng: "+ public_day[i] +"</p></div></div>");
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
					<li><a class="shownews text-danger" onclick="shownewsra(this)">Tất Cả</a></li><hr>
				</ul>
			</div>
		</div>

		<div class="col-10 border" id="show">
			<h5 class="pt-2">Thông Tin Tin Tức </h5>
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
		$.get('/admin/getdefaultnews/' + val, function(data){
			var big = JSON.parse(data);
			var _id = big._id;
			var img = big.img;
			var title = big.title;
			var view = big.view;
			var des = big.des;
			var public_day = big.public_day;

			$('#name').text(title);
			$('#name').attr('data-id',_id);
			$('#imgg').text(img);
			$('#intro').text(des);
			$('#view').attr('value',view);
			$('#public').attr('value',public_day);
		});
		$('option').remove('#tag-one');
		$.get('/admin/getnews', function(data){
			var tags = JSON.parse(data).tags;
			for (var i = 0; i < tags.length; i++) {
				$('select#tag').append("<option id='tag-one' value = '"+tags[i]+"'>"+tags[i]+"</option>")
			}
		});
	}
	function send_update(){
		var data = {
			'_id': $('#name').attr('data-id'),
			'title': $('#name').val(),
			'img': $('#imgg').text(),
			'des': $('#intro').text(),
			'view': $('#view').val(),
			'public_day': $('#public').val(),
			'tag': $('#tag').val()
		}
		if(data.title == ''){
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
		if(data.public_day == ''){
			alert('Like không được để trống!!!');
			return false;
		}
		if(data.tag == 'Chọn Thể Loại'){
			alert('Vui lòng chọn thể loại!!!');
			return false;
		}
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
			}
		});
		$.post('/admin/updatenews', data, function(val){
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
					<label for="name">Tiêu đề:</label>
					<textarea class="form-control" id="name" rows="2"></textarea>
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
					<label for="public">Ngày đăng:</label>
					<input type="text" class="form-control" id="public" placeholder="Ngày đăng">
				</div>
				<div class="form-group">
					<label for="tag" >Thể loại:</label>
					<small class="form-text text-muted">*Chọn 1 trong 2 thể loại: Tin Tức Anime hoặc Đề Cử Anime.</small>
					<select class="custom-select" id="tag">
						<option value="Chọn Thể Loại">Chọn Thể Loại</option>
					</select>
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