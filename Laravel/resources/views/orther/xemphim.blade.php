@extends('master.master')
@section('main')
<div class="row">
	@foreach($data as $dt)
	<?php $vd = $dt->listEp; ?>
	<div class="col-lg-9 col-sm-12">
		@foreach($vd as $dl)
		@if($dl['id_ep'] == $tap)

		<video width="100%" height="auto" controls autoplay>
			<source src="{{$dl['link_video']}}" type="video/mp4">
		</video>
		<div class="row">
			<div class="col">
				<h4>{{$dt->name}} {{$dl['title']}}</h4>
			</div>

		</div>
		<?php break; ?>
		@endif
		@endforeach
	</div>
	<div class="col-lg-3 col-sm-12 border-bottom">
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" data-toggle="tab" href="#tab-ep" role="tab" aria-controls="tap-ep" aria-selected="true">Danh sách tập</a>
				<a class="nav-item nav-link tab-i4" data-toggle="tab" href="#tab-info" role="tab" aria-controls="tab-info" aria-selected="false">Thông tin</a>
				<a class="nav-item nav-link" data-toggle="tab" href="#tab-comment" role="tab" aria-controls="tab-comment" aria-selected="false">Bình luận</a>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="tab-ep" role="tabpanel">
				<ul class="list-unstyled">
					@foreach($vd as $value)
					@if($value['id_ep']==$tap)
					<a href="{{$value['link_ep']}}" class="selected">
						@else
						<a href="{{$value['link_ep']}}">
							@endif

							<li class="media">

								<img src="{{$value['image']}}" class="" alt="..." width="106px" height="60px" style="margin:5px;">
								<div class="media-body">
									<h6 class="" style="font-size:13px;">{{$value['title']}}</h6>
									<p style="font-size: 11px;">{{number_format($value['num_view'])}} lượt xem</p>
								</div>
							</li></a>
						@endforeach
				</ul>

			</div>
			<div class="tab-pane fade" id="tab-info" role="tabpanel" style="height: 0;">

			</div>
			<div class="tab-pane fade" id="tab-comment" role="tabpanel">
				<!-- <form action="" method="get" accept-charset="utf-8"> -->
				<input type="text" name="" id="cmtText" style="width: 100%;border-radius: 3px;margin-top: 5px;border: solid 1px #f1f1f1;width: 79%;">
				<input type="submit" id="cmtbtn" name="" style="width: 19%; text-align: center;padding-left: 0;outline: none;border: none;border-radius: 0 3px 3px 0;">
				<!-- </form> -->
				<hr>
				<ul class="list-unstyled">
					<?php
					if (isset($dt->cmt)) {
					?>
						@foreach(array_reverse($dt->cmt) as $value)
						<li class="media">
							<img src="{{$value['avatar']}}" class="mr-3" alt="..." width="40px" height="40px" style="margin:5px;">
							<div class="media-body">
								<h6 class="mt-0 mb-1" style="font-size:13px;">{{$value['displayName']}}</h6>
								<p style="font-size: 13px;">{{$value['content']}}</p>
								<span class="time"></span>
							</div>

						</li>
						<hr>
						@endforeach
					<?php } ?>
				</ul>
			</div>

		</div>
	</div>



	<style type="text/css" media="screen">
		#nav-tab a {
			color: black;
		}
	</style>
	@endforeach
</div>
<div class="row">
	<div class="col">
		<div class="border-circle" id="border-heart">
			<div class="fa fa-heart" id="like"></div>
		</div>
		<span id="numlike">{{number_format($data[0] -> like)}}</span>
		<div class="border-circle" id="border-bell">
			<div class="fa fa-bell" id="follow"></div>
		</div>


		<span id="numfl">{{number_format($data[0] -> follow)}}</span>
	</div>
</div>
<div class="row">
	<div class="col">
		Thể loại:
		@foreach($dt->type as $type)
		<a href="" title="">{{$type}}</a>&nbsp;
		@endforeach
		<br>
		Lượt xem: {{number_format($dt->view)}}
		<br>
		{{$data[0]->info}}
	</div>
</div>
@endsection

@section('script')
<style type="text/css">
	a {
		color: black;
		text-decoration: none;
	}

	a:hover {
		color: red;
		text-decoration: none;
	}
</style>
<script>
	// if ($(window).width() > 991) {
	// 	var h = $('.col-lg-3').width() * 109 / 60 - 42;
	// 	$('.tab-pane').css({
	// 		"height": h
	// 	});
	// } else {
	// 	$('.tab-pane').css({
	// 		"height": "auto"
	// 	});
	// }
	// $(window).resize(function() {
	// 	if ($(window).width() > 991) {
	// 		var h = $('.col-lg-3').width() * 109 / 60 - 42;
	// 		$('.tab-pane').css({
	// 			"height": h
	// 		});
	// 	} else {
	// 		$('.tab-pane').css({
	// 			"height": 'auto'
	// 		});
	// 	}
	// });

	$(document).resize(function() {
		$(".user-header").css({
			"height": $(document).height()
		});
	});
	$('#like').click(function() {
		$.post('/like', function(data) {
			var dataJson = JSON.parse(data);
			swal(dataJson.status);
			$('#border-heart').css(JSON.parse(dataJson.css));
			$('#border-heart~#numlike').html(dataJson.like);
			// console.log(dataJson.like);
		});
	});
	$('#follow').click(function() {
		$.post('/follow', function(data) {
			var dataJson = JSON.parse(data);
			swal(dataJson.status);
			$('#border-bell').css(JSON.parse(dataJson.css));
			$('#border-bell~#numfl').html(dataJson.follow);
		});
	});
	@if(Auth::check())
	$('#cmtbtn').click(function() {
		$('#tab-comment .list-unstyled').prepend($('<li class="media">							<img src="{{Auth::user()->avatar}}" class="mr-3" alt="..." width="40px" height="40px" style="margin:5px;">							<div class="media-body">								<h6 class="mt-0 mb-1" style="font-size:13px;">{{Auth::user()->displayName}}</h6>								<p style="font-size: 13px;">' + $('#cmtText').val().replace(/<\/?[^>]+(>|$)/g, "") + '</p>								<span class="time"></span>							</div>						</li> <hr>'));
		$.post('/comment', {
			content: $('#cmtText').val()
		});
		$('#cmtText').val("");
	});
	@else
	$('#cmtText').focusin(function() {
		alert('Vui lòng đăng nhập để thực hiện chức năng này')
		$('#cmtText').blur()
	});


	@endif
</script>
@endsection