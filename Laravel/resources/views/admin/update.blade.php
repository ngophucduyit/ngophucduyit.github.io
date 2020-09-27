<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<base href="{{asset('')}}">
	<link rel="shortcut icon" href="Images/meo.png" type="image/x-icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<link rel="stylesheet" type="text/css" href = "/CSS/fontawesome-free-5.13.0-web/css/fontawesome.min.css">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Latest compiled and minified plotly.js JavaScript -->
	<script src="https://cdn.plot.ly/plotly-latest.min.js" charset="utf-8"></script>

	<!-- OR use a specific plotly.js release (e.g. version 1.52.3) -->
	<script src="https://cdn.plot.ly/plotly-1.52.3.min.js" charset="utf-8"></script>

	<!-- OR an un-minified version is also available -->
	<script src="https://cdn.plot.ly/plotly-latest.js" charset="utf-8"></script>
    </script>
	<script type="text/javascript" src="main.js"></script>
</head>
<body>
<div class="container mt-5 ">
	<div class="row shadow mb-5">
		<div class="col-sm-9 bg-white border rounded">
			<div>
				<h4 class="text-center pt-3">Bảng Xếp Hạng</h4>
				<hr>
			</div>
			<div id="chart">
				<script type="text/javascript">
					$.get('/admin/getdata', function(data){
    					var name = JSON.parse(data).name;
    					var like = JSON.parse(data).like;
    					var view = JSON.parse(data).view;
    					var follow = JSON.parse(data).follow;
    					var img = JSON.parse(data).img;

    					for (var i = 0; i < like.length; i++) {
    						for (var j = i + 1; j < like.length; j++) {
    							if (like[i] < like[j]){
    								[view[i],view[j]] = [view[j],view[i]];
    								[name[i],name[j]] = [name[j],name[i]];
    								[like[i],like[j]] = [like[j],like[i]];
    								[follow[i],follow[j]] = [follow[j],follow[i]];
    								[img[i],img[j]] = [img[j],img[i]];
    							}
    						}
    					}
    					var view = {
						  x: name.slice(0,11),
						  y: view.slice(0,11),
						  type: 'scatter',
						  name: 'View(*1000)'
						};

						var like = {
						  x: name.slice(0,11),
						  y: like.slice(0,11),
						  type: 'scatter',
						  name: 'Like'
						};
						var follow = {
						  x: name.slice(0,11),
						  y: follow.slice(0,11),
						  type: 'scatter',
						  name: 'Follow'
						};
						var dataviz = [view, like, follow];
						var layout = {
							title:'Top 10 bộ phim được yêu thích nhất',
							width: 850,
							height: 500
						};

						Plotly.newPlot('chart', dataviz, layout);
    				})
				</script>
			</div>
		</div>
		<div class="col-sm-3 text-center bg-white border rounded">
			<div>
				<h4 class="text-center pt-3">Xem Nhiều Nhất</h4>
			</div>
			<hr>
			<div>
				<marquee direction = "up" height = '500px' scrollamount = '3' id = 'scroll'>
					<script type="text/javascript">
						$.get('/admin/getdata', function(data){
    					var name = JSON.parse(data).name;
    					var like = JSON.parse(data).like;
    					var view = JSON.parse(data).view;
    					var follow = JSON.parse(data).follow;
    					var img = JSON.parse(data).img;
    					var num_ep = JSON.parse(data).num_ep;
    					var type = JSON.parse(data).type;

    					for (var i = 0; i < view.length; i++) {
    						for (var j = i + 1; j < view.length; j++) {
    							if (view[i] < view[j]){
    								[view[i],view[j]] = [view[j],view[i]];
    								[name[i],name[j]] = [name[j],name[i]];
    								[like[i],like[j]] = [like[j],like[i]];
    								[follow[i],follow[j]] = [follow[j],follow[i]];
    								[img[i],img[j]] = [img[j],img[i]];
    								[num_ep[i],num_ep[j]] = [num_ep[j],num_ep[i]];
    								[type[i],type[j]] = [type[j],type[i]];
    							}
    						}
    					}
    					for (var i = 0; i < name.length; i++) {
    						$('marquee#scroll').append('<div class = "border mb-3 rounded"><p id="name" class=" pt-3 text-center"><b>'+name[i]+'</b></p><hr><div class="row" style="font-size: 13px"><div class="col-sm-6 border-right"><img src = "'+img[i]+'" width="100%"><br>Thể loại: '+ type[i].join(', ') +'</div><div class="col-sm-6"><p>View: '+Intl.NumberFormat().format(view[i])+'</p><p>Like: '+Intl.NumberFormat().format(like[i])+'</p><p>Follow: '+Intl.NumberFormat().format(follow[i])+'</p><p>Thời Lượng: '+num_ep[i]+' tập</p></div></div></div>')
    					}
					})
					</script>
				</marquee>
			</div>
		</div>
	</div>
	<div class="row text-center shadow mb-5">
		<div class="col-sm-3 border rounded">
			<i class="fa fa-paw pt-2" style="font-size: 50px; color: #ff66b3"></i>
			<h5>Anime</h5>
		</div>
		<div class="col-sm-3 border rounded">
			<i class="fa fa-newspaper pt-2" style="font-size: 50px; color: #00ccff"></i>
			<h5>Tin Tức</h5>
		</div>
		<div class="col-sm-3 border rounded">
			<i class="fa fa-users pt-2" style="font-size: 50px; color: #00ff00"></i>
			<h5>User</h5>
		</div>
		<div class="col-sm-3 border rounded">
			<i class="fa fa-edit pt-2" style="font-size: 50px; color: yellow"></i>
			<h5>Update</h5>
		</div>
	</div>
	<div class="row shadow mb-5">
		<div class="col-sm-12 text-center bg-white border rounded">
			<div class="row mt-2">
				<div class="col-sm-6">
					<h4 class="text-left pt-2">Thông tin chi tiết</h4>
				</div>
				<div class="col-sm-6 text-right pt-2">
					<form method="post" id="form_select">
						<input type="text" name="" size="15" list="tech" placeholder="Tìm Kiếm..." id="getval" onfocus="this.select()"  onchange="getinput()">
						<input type="text" id="_id" name="" hidden="">
						<datalist id="tech">
							<option value="">Chọn Anime</option>
							<option value="" disabled="disabled">-------------</option>
							<?php
							foreach ($animes as $i) {
								echo '<option id = "'.$i['_id'].'" value ="'.$i['name'].'"></option>';
							}
							?>
						</datalist>
						<script type="text/javascript">
							function getinput(){
								$('input#_id').val($('datalist option[value ="' + $('input#getval').val() + '"]').attr('id'));
								var val = $('input#_id').val();
								$.get('admin/getdefault/'+ val, function(data)
								{
									var name = JSON.parse(data).name;
			    					var like = JSON.parse(data).like;
			    					var des = JSON.parse(data).des;
			    					var view_am = JSON.parse(data).view;
			    					var follow = JSON.parse(data).follow;
			    					var img = JSON.parse(data).img;
			    					var num_ep = JSON.parse(data).num_ep;
			    					var name_ep = JSON.parse(data).name_ep;
			    					var view_ep = JSON.parse(data).view_ep;
			    					var type = JSON.parse(data).type;

			    					var view = {
										x: name_ep,
										y: view_ep,
										type: 'bar',
										text: view_ep.map(String),
  										textposition: 'outside',
									};
									dataviz = [view];
									var layout = {
										title:'Thống kê lượt xem từng tập',
										width: 1120,
										height: 500,
										"titlefont": {
											"size": 25
											},
									};
									Plotly.newPlot('viz_default', dataviz, layout);
									$('div').remove('#img_df');
									$('div').remove('#text');
									$('div#default').append('<div class="col-sm-4 border-right text-left" id="img_df"><img src = "'+ img +'" width ="100%"><br>Thể Loại: '+type.join(', ')+'</div>');
									$('div#default').append('<div class="col-sm-8 text-left" id="text"><h4>'+ name +'</h4><p>'+ des +'</p><p>Lượt xem: '+ Intl.NumberFormat().format(view_am) +'</p><p>Like: '+ Intl.NumberFormat().format(like) +'</p><p>Follow: '+ Intl.NumberFormat().format(follow) +'</p><p>Thời Lượng: '+ num_ep +' tập</p></div>');
			    				});
							}
						</script>
					</form>
				</div>
			</div>
		<hr>
			<div class="row" id="default">
				<div class="col-sm-4" id="img_df" style="height: 200px">Không có thông tin</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div id="viz_default"></div>
				</div>
			</div>
			</div>
	</div>
</div>
</body>
</html>