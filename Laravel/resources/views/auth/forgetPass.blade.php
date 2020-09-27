@extends('master.master')
@section('main')
<h3>Quên Mật Khẩu</h3>
@if(isset($status))
<div class="alert alert-primary">{{$status}}</div>
@endif
<form action="" method="post">
	{{csrf_field()}}
	<script type="text/javascript">
		function forget() {
			$.get('/checkUsername', {username: $('#name').val()}, function(data) {
				var dt = JSON.parse(data);
				if (dt.status == 'success') {
					$('#wait').html('Tài khoản không tồn tại');
				} else {
					$('#wait').html('<i id = "waitt">Đang xử lý. Vui lòng chờ...</i>');
					$.get('/mail/' + $('#name').val(), function(data) {
						swal({
							title: "Thành Công!!!",
							text: "Mật khẩu đã gửi qua email đăng ký. Vui lòng kiểm tra lại!!!",
							icon: "success",
							buttons: true,
						}).then((ac) => {
							if (ac) {
								location.href = '/'
							} else {
								location.href = '/'
							}
						});
					});
				}
			});
		}
	</script>
	<div class="container-fluid">
		<div class="row">
			<div class="col-4 item-left">
				<div class="form-group">
					<label for="name">Nhập User Name:</label>
					<input type="text" class="form-control" id="name" placeholder="User Name">
				</div>
				<div>
					<input type="button" value="Xác Nhận" class="btn btn-primary" onclick="forget()">
				</div>
				<span id="wait"></span>
			</div>
		</div>
	</div>
</form>
@endsection