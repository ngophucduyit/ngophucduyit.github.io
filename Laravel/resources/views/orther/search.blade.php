@extends('master.master')
@section('main')
<div class="row">
	<div class="col-8">
		<h3>
			Kết quả tìm kiếm :
			<?php echo $_GET['s'];
			$s = $_GET['s'] ?>
		</h3>
	</div>
	<div class="col-4">
		<form action="./search" method="get" class="float-right">
			<table>
				<tr>
					<td>
						<select name="type" class="custom-select">
							<option value="all"> Tất cả </option>
							<option value="Thể thao"> Thể thao </option>
							<option value="Trường Học"> Trường Học </option>
							<option value="Siêu Nhiên"> Siêu Nhiên </option>
							<option value="Hành Động"> Hành Động </option>
							<option value="Đời Thường"> Đời Thường </option>
							<option value="Giả Tưởng"> Giả Tưởng </option>
							<option value="Phiêu Lưu"> Phiêu Lưu </option>
							<option value="Lãng Mạn"> Lãng Mạn </option>
							<option value="Hài Hước"> Hài Hước </option>
							<option value="Kịch tính"> Kịch tính </option>
							<option value="Viễn Tưởng"> Viễn Tưởng </option>
						</select></td>
					<td width="20px"><button type="" class="btn btn-outline-danger">tìm</button></td>
				</tr>
			</table>
			<input type="hidden" name="s" value="{{$s}}">



		</form>

	</div>

</div>


<div class="row">
	@if(count($dt)>0)
	@foreach($dt as $row)
	<div class="msc">
		<a href="/xem-phim/{{$row->_id}}" title="">
			<div class="anime-i4">
				<div class="anime-name">
					{{$row->name}}
				</div>
				<div class="anime-title">
					<?php $type =$row->type; for($i=0;$i<count($type);$i++) {
					 	echo $i<count($type)-1 ?  $type[$i].',' : $type[$i].'.';
					 } ?>
				</div>

			</div>

			<img src="{{$row->image}}" alt="" height="auto" width="100%">

		</a>
	</div>
	@endforeach
	@else
	Khong tim thay ket qua
	@endif

</div>
<div class="row">
	<div class="col">
		{!!$dt->appends(['s'=>$s])->links()!!}
	</div>

</div>

@endsection


@section('script')
<script>
	var h = $('.msc').width() * 9 / 16;
	$('.msc').css({
		"height": h
	});
	$(window).resize(function() {
		var h = $('.msc').width() * 9 / 16;
		$('.msc').css({
			"height": h
		});
	});
</script>
@endsection