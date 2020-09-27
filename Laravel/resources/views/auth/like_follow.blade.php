@extends('master.master')
@section('main')

<?php
$urlCurrent = class_basename(url()->current());
if ($urlCurrent == 'phim-da-thich') {
	echo '<div class="row"><h3>Anime đã thích</h3></div>';
} elseif ($urlCurrent == 'phim-da-xem') {
	echo '<div class="row"><h3>Anime đã xem</h3></div>';
} else {
	echo '<div class="row"><h3>Anime đang theo dõi</h3></div>';
}
?>

<div class="row">
	@if($datas!=null)
	@foreach($datas as $key => $values)
	<div class="col-12 col-md-6 col-lg-3">
		<div style="width: 106px;height: 73px;float: left;overflow: hidden; margin:0 10px 10px 0;">
			<a href="/xem-phim/{{$values['_id']}}" title="">
				<img src="{{$values['image']}}" width="100%" height="100%">
			</a>
		</div>
		<div class="body">
			<h6><a href="/xem-phim/{{$values['_id']}}" title="">{{$values['name']}}</a></h6>
			<span style="font-size: 12px;">
				@if($urlCurrent=='phim-da-thich')
				{{number_format($values['like'])}} thích
				@elseif($urlCurrent=='phim-da-xem')
				{{number_format($values['view'])}} lượt xem
				@else
				{{number_format($values['follow'])}} theo dõi
				@endif
			</span>
		</div>
	</div>
	@endforeach
	@endif
</div>

@endsection