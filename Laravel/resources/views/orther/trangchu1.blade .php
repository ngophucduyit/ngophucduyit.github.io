@extends('master.master')
@section('main')
<style type="text/css" media="screen">
	.main_live {
		width: 74%;
		position: relative;
		height: 100px;
	}

	.live_item {
		width: 24%;
		/* height: 200px; */
		/*height:auto;*/
	}

	.live_img {
		margin: 0.5%;
		/*border: solid 1px;*/
		float: left;
	}

	.live_img img {
		width: 100%;
		height: auto;

	}

	#hinhduoi {
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		z-index: 0;
	}

	#hinhtren {
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		z-index: 1;
	}

	.class1 {
		animation-name: exampleTwo;
		animation-duration: 0s;
	}

	.class2 {
		animation-name: example;
		animation-duration: 1s;
	}

	@keyframes example {
		from {
			opacity: 0;
		}

		to {
			opacity: 1;
		}
	}

	@keyframes exampleTwo {
		from {
			opacity: 0;
		}

		to {
			opacity: 1;
		}
	}

	.live_img_hover:hover {
		transition: 0.5s;
		opacity: 0.8;
	}
</style>

<div class="row">
	<!-- chỗ này là lideshow nha -->
	<div class="col-12">
		<div class="main_live live_img" id='big'>
			<img id="hinhduoi" src="Images/Plunderer/6a8fde64c7ecddab_c8bd9bfc1d7af8ef_232849158124852439674.jpg" alt="">
			<img id="hinhtren" src="Images/Kimetsu_no_Yaiba/logo.jpg" alt="">
		</div>
		<div class="live_item live_img live_img_hover">
			<img src="Images/Kimetsu_no_Yaiba/logo.jpg" onmouseover="wrap_img(this);">
		</div>
		<div class="live_item live_img live_img_hover">
			<img src="Images/Boruto/logo_boruto.jpg" alt="" onmouseover="wrap_img(this);">
		</div>
		<div class="live_item live_img live_img_hover">
			<img src="Images/Iruma-kun/logo_irumakun.jpg" alt="" onmouseover="wrap_img(this);">
		</div>
		<div class="live_item live_img live_img_hover">
			<img src="Images/Plunderer/logo_plunderer.jpg" alt="" onmouseover="wrap_img(this);">
		</div>
		<div class="live_item live_img live_img_hover">
			<img src="Images/Nanatsu_no_Taizai/logo_tdt.jpg" alt="" onmouseover="wrap_img(this);">
		</div>
		<div class="live_item live_img live_img_hover">
			<img src="Images/slide1.jpg" alt="" onmouseover="wrap_img(this);">
		</div>
		<div class="live_item live_img live_img_hover">
			<img src="Images/slide6.jpg" alt="" onmouseover="wrap_img(this);">
		</div>
	</div>

	<!--A --- --------------------------------------------- -->
</div>
<h3>
	<a href="" title="" style="text-decoration: none;color: #333;">
		Tập Mới Nhất <i class="fa fa-angle-right"></i>
	</a>
</h3>
<div class="row" style="margin-left: 5px">

	<!-- ---------------------------- -->
	@foreach($animes as $anime)
	<?php $list = $anime->listEp;
	$ep = end($list); ?>
	<div class="msc">
		<a href="{{$ep['link_ep']}}" title="">
			<div class="anime-i4">
				<div class="anime-name">
					{{$anime->name}}
				</div>
				<div class="anime-title">
					{{$ep['title']}}
				</div>

			</div>

			<img src="{{$ep['image']}}" alt="" height="auto" width="100%">
		</a>

	</div>
	@endforeach
	<!-- ---------------------------- -->
</div>
<h3>
	<a href="http://tinanime.com" title="" style="text-decoration: none;color: #333;">
		Tin Tức Anime<i class="fa fa-angle-right"></i>
	</a>
</h3>

<div class="row newss">
	<div class="col-md-6 col-sm-12">
		<div class="row">
			<div class=" col-6 col-md-6 col-sm-6">
				<!-- --- --------------------------------------------- -->
				<img src="Images/tap8.jpg" style="float: left; height: auto; width: 100%;">
				<!-- --- --------------------------------------------- -->
			</div>
			<div class="col-6 col-md-6 col-sm-6">

				<a href="TrangThongTin.html" style="text-decoration: none;">
					<h6>Mix Giới Thiệu Thêm Các Nhân Vật Mới</h6>
				</a>
				<p>Vào hôm thứ Sáu, tài khoản Twitter chính thức của bộ anime truyền hình chuyển thể từ
					manga bóng chày Mix của tác giả Mitsuru Adachi vừa giới thiệu đến khán giả 3 diễn
					viên lồng tiếng sẽ góp mặt trong...</p>

			</div>
		</div>

	</div>

	<div class="col-md-6 col-sm-12">
		<div class="row">
			<div class=" col-6 col-md-3 col-sm-6">
				<img src="Images/tap8.jpg" style="float: left; height: auto; width: 100%;">
			</div>
			<div class="col-6 col-md-3 col-sm-6">

				<a href="TrangThongTin.html" style="text-decoration: none;">
					<h6>Mix Giới Thiệu Thêm Các Nhân Vật Mới</h6>
				</a>


			</div>
			<div class="col-6 col-md-3 col-sm-6">
				<img src="Images/tap8.jpg" style="float: left; height: auto; width: 100%;">
			</div>
			<div class="col-6 col-md-3 col-sm-6">

				<a href="TrangThongTin.html" style="text-decoration: none;">
					<h6>Mix Giới Thiệu Thêm Các Nhân Vật Mới</h6>
				</a>


			</div>
		</div>
		<div class="row">
			<div class="col-6 col-md-3 col-sm-6">
				<img src="Images/tap8.jpg" style="float: left; height: auto; width: 100%;">
			</div>
			<div class="col-6 col-md-3 col-sm-6">

				<a href="TrangThongTin.html" style="text-decoration: none;">
					<h6>Mix Giới Thiệu Thêm Các Nhân Vật Mới</h6>
				</a>

			</div>
			<div class="col-6 col-md-3 col-sm-6">
				<img src="Images/tap8.jpg" style="float: left; height: auto; width: 100%;">
			</div>
			<div class="col-6 col-md-3 col-sm-6">

				<a href="TrangThongTin.html" style="text-decoration: none;">
					<h6>Mix Giới Thiệu Thêm Các Nhân Vật Mới</h6>
				</a>


			</div>
		</div>

	</div>
</div>

@endsection

@section('script')
<script>
	var isPause = false;
	var hinhduoi = document.getElementById("hinhduoi");
	var hinhtren = document.getElementById("hinhtren");
	var interval_wrap = window.setInterval(function() {
		if (!isPause) {
			if (typeof pos == 'undefined') {
				var pos = Array(0, 1, 2, 3, 4, 5, 6, 7)
				var link_arr = new Array()
				var position_img = document.querySelectorAll('div.live_img img')
				for (var i = 0; i < 8; i++) {
					link_arr[i] = position_img[i].src
				}
			}
			for (var i = 0; i < 8; i++) {
				pos[i] = (pos[i] + 1) % 8
				position_img[i].src = link_arr[pos[i]]
			}
		}

	}, 3000)

	function wrap_img(a) {
		tmp = hinhduoi.src
		isPause = true
		hinhduoi.src = hinhtren.src;
		hinhtren.classList.remove("class2");
		hinhtren.classList.add("class1");
		hinhtren.src = a.src
		void hinhtren.offsetWidth;
		hinhtren.classList.remove("class1");
		hinhtren.classList.add("class2");
		a.addEventListener('mouseout', function() {
			hinhtren.src = tmp
			isPause = false
		})
	}
	// var h = $('.msc').width() * 9 / 16;
	// $('.msc').css({
	// 	"height": h
	// });
	// var hmain_live = $('.live_item').height() * 3 + parseFloat($('.live_item').css('margin').replace('px',''))*4
	// $('.main_live').css({
	// 	height: hmain_live
	// })
	// $('#hinhtren').css({
	// 	height: hmain_live
	// })
	// $('#hinhduoi').css({
	// 	height: hmain_live
	// })
	// $(window).resize(function(){
	// 	var h = $('.msc').width() * 9 / 16;
	// $('.msc').css({
	// 	"height": h
	// });
	// var hmain_live = $('.live_item').height() * 3 + parseFloat($('.live_item').css('margin').replace('px',''))*4
	// $('.main_live').css({
	// 	height: hmain_live
	// })
	// });
</script>

@endsection