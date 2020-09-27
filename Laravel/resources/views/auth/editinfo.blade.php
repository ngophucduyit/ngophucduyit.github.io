@extends('master.master')
@section('main')
<h3>Thay đổi thông tin</h3>
@if(isset($status))
<div class="alert alert-primary">{{$status}}</div>
@endif
<form action="" method="post">
	{{csrf_field()}}
	<table>

		<tr>
			<td>Tên tài khoản</td>
			<td><input type="text" name="UserName" disabled value="{{Auth::user()->username}}"></td>
		</tr>
		<tr>
			<td>Tên hiển thị</td>
			<td><input type="text" name="DisplayName" value="{{Auth::user()->displayName}}"></td>
		</tr>
		<tr>
			<td>Giới tính</td>
			<td>
				<input type="radio" name="gender" value="Nam" {{isset(Auth::user()->gender)?(Auth::user()->gender=='Nam'? 'checked' : ''): checked}}> Nam
				<input type="radio" name="gender" value="Nữ" {{Auth::user()->gender=='Nữ'? 'checked' : ''}}> Nữ
			</td>
		</tr>
		<tr>
			<td>Ngày sinh</td>
			<td>
				<input type="text" name="day" value="{{isset(Auth::user()->birthday)? explode('/',Auth::user()->birthday)[0]:'1'}}" size="3">
				<input type="text" name="month" value="{{isset(Auth::user()->birthday)? explode('/',Auth::user()->birthday)[1]:'1'}}" size="3">
				<input type="text" name="year" value="{{isset(Auth::user()->birthday)? explode('/',Auth::user()->birthday)[2]:'1970'}}" size="6"></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="text" name="email" value="{{Auth::user()->email}}"></td>
		</tr>
		<tr>
			<td></td>
			<td><button type="" class="btn btn-outline-primary">Sửa thông tin</button></td>
		</tr>
</form>
</table>
@endsection