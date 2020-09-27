@extends('master.master')
@section('main')
<div class="row">
	<div class="col-12">
		@if(isset($annou))
		<div class="alert alert-success">{{$annou}}</div>
		@endif
	</div>
	<div class="col-12">
		<form action="/doi-mat-khau" method="post" accept-charset="utf-8">
			{{csrf_field()}}
			<table>
				<tr>
					<th colspan="2">
						<h6>SỬA THÔNG TIN</h6>
						Vui lòng nhập đầy đủ thông tin bên dưới
					</th>
				</tr>
				<tr>
					<td>Mật khẩu cũ</td>
					<td><input type="password" name="curentPassword"></td>
					<td style="color: red;">{{$errors->has('curentPassword')!=null?$errors->first('curentPassword'): ''}}</td>
				</tr>
				<tr>
					<td>Mật khẩu mới</td>
					<td><input type="password" name="newPassword"></td>
					<td style="color: red;">{{$errors->has('newPassword')!=null?$errors->first('newPassword'): ''}}</td>
				</tr>
				<tr>
					<td>Nhập lại mật khẩu</td>
					<td><input type="password" name="newPassword_confirmation"></td>
					<td style="color: red;">{{$errors->has('newPassword_confirmation')!=null?$errors->first('newPassword_confirmation'): ''}}</td>
				</tr>
				<tr>
					<td colspan="2"><button class="btn btn-danger">Đổi mật khẩu</button></td>
				</tr>
			</table>
		</form>
	</div>

</div>

<style>
	td {
		padding-top: 5px;
	}
</style>
@endsection