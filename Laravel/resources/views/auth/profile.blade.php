@extends('master.master')
@section('main')
<div class="row">
	<div class="col-3" style="border: solid 1px;">
		<img src="{{Auth::user()->avatar}}" alt="" width="100%" height="100%">
	</div>
	<div class="col-9">
		Tên hiển thị:{{Auth::user()->displayName}}

	</div>
</div>
@endsection