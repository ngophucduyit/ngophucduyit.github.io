<div class="i4-user">
	<label for="us-chk"><i class="fa fa-times" style="font-size: 20px;cursor: pointer;"></i>
	</label>
	<span class="user-name">Chào khách!</span>
	<nav class="navtab">
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" data-toggle="tab" href="#tab-login" role="tab" aria-controls="tab-login" aria-selected="true">ĐĂNG NHẬP</a>
			<a class="nav-item nav-link" data-toggle="tab" href="#tab-regs" role="tab" aria-controls="tab-regs" aria-selected="false">ĐĂNG KÝ</a>
		</div>
	</nav>
	<div class="avatar-user">
	</div>
</div>
<div class="tab-content" id="nav-tabContent" style="padding: 10px;">
	<div class="tab-pane fade show active" id="tab-login" role="tabpanel">
		<form action="" method="post" onsubmit="return chklgin();">
			{{csrf_field()}}
			Tên đăng nhập
			<input type="text" name="usname" id="lgName">
			<i class="fa fa-user lgi"></i>
			<br>
			Mật khẩu
			<input type="password" name="pw" id="lgpass">
			<i class="fa fa-lock lgi"></i>
			<br>
			<input type="checkbox" name="cbsve" id="sve"> <label for="sve">Ghi nhớ</label>
			<a href="/forgetpass" title="" style="position: absolute;right: 10px;color: black;">Quên mật khẩu</a>
			<br>
			<button type="" class="login">Đăng nhập</button>
		</form>
		<span id="mes"></span>
		<hr>

		<div>
			<div class="social" style="width: 50px;height: 50px;float:left; ">
				<a href="/auth/google" title="">

					<img src="Images/Layout/fbicon-removebg-preview.png" alt="" width="80px" height="80px" style="position: absolute;top: -15px;left: -15px">
				</a>
			</div>


			<div class="social" style="width: 50px;height: 50px;float: left;">
				<a href="/auth/google" title="">

					<img src="Images/Layout/ggicon-removebg-preview.png" alt="" width="80px" height="80px" style="position: absolute;top: -15px;left: -15px">
				</a>
			</div>
		</div>


	</div>


	<div class="tab-pane fade show" id="tab-regs" role="tabpanel">
		<form action="/" method="post" onsubmit="return chkRegex();">
			{{csrf_field()}}
			Tên đăng nhập <span style="float: right;color: red;" id="erName"></span>
			<input type="text" name="username" id="username" onblur="checkDuplicate()" onkeyup="chkname()" >
			<i class="fa fa-user lgi"></i>
			<br>
			Mật khẩu<span style="float: right;color: red;" id="erPass"></span>
			<input type="password" name="password" id="password" onblur="chkpass()">
			<i class="fa fa-lock lgi"></i>
			<br>
			Nhập lại mật khẩu<span style="float: right;color: red;" id="erPassA"></span>
			<input type="password" name="passwordAgain" id="passwordAgain" onblur="chkpassAgain()">
			<i class="fa fa-lock lgi"></i>
			<br>
			Tên hiển thị <span style="float: right;color: red;" id="erDName"></span>
			<input type="text" name="displayName" id="displayName" onblur="chkDisplayName();">
			<i class="fa fa-comments lgi"></i>
			<br>
			Email <span style="float: right;color: red;" id="erEmail"></span>
			<input type="email" name="email" id="mail" onkeyup="emailExist()" required>
			<i class="fa fa-envelope lgi"></i>
			<br>
			Giới tính <br>
			<input type="radio" name="gender" checked value="Nam"> Nam
			<input type="radio" name="gender" style="margin-left:40px; " value="Nữ"> Nữ <br>
			<label>Ngày sinh</label>
			<label style="margin-left: 28px;">Tháng sinh</label>
			<label style="margin-left: 23px;">Năm sinh</label> <br>
			<input type="number" name="day" id="day" style="width: 80px" onchange="chkbirthday()" value="1">
			<input type="number" name="month" id="month" style="width: 80px" onchange="chkbirthday()" value="1">
			<input type="number" name="year" id="year" style="width: 80px" onchange="chkbirthday()" value="1970">
			<br><br>
			<button type="" style="width: 100%;height: 30px;border: none;background: #8c8c8c" id="reg-btn">Đăng ký</button>
		</form>

	</div>
</div>
<style type="text/css" media="screen">
	button {
		outline: none;
	}

	button.login {
		width: 100%;
		height: 30px;
		border: none;
		background: #8c8c8c;
	}

	button.login:hover {
		background: #ff3300;
	}
</style>