<div class="i4-user">
    <label for="us-chk"><i class="fa fa-times" style="font-size: 20px;cursor: pointer;"></i>
    </label>
    <span class="user-name">Chào
        @if(Auth::check())
        {{Auth::user()->displayName}}
        @endif
    </span>
    <nav class="navtab">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" data-toggle="tab" href="#tab-user-info" role="tab" aria-controls="tab-user-info" aria-selected="true">THÔNG TIN</a>
            <a class="nav-item nav-link" data-toggle="tab" href="#tab-announce" role="tab" aria-controls="tab-announce" aria-selected="false">THÔNG BÁO</a>
        </div>
    </nav>
    <div class="avatar-user" style="opacity: 1; overflow: hidden;">
        <img src="@if(Auth::check())
    		{{Auth::user()->avatar}}
    	@endif" alt="" width="100%" height="100%">
        <input type="file" name="">
    </div>
</div>
<div class="tab-content" id="nav-tabContent" style="padding: 10px;">
    <div class="tab-pane fade show active" id="tab-user-info" role="tabpanel">
        @if(Auth::user()->role =='Admin')
            <div>
                <i class="fa fa-user"></i> <a target="_blank" href="/admin/dashboard">Admin</a>
            </div>
        @endif
        <div>
            <i class="fa fa-user"></i> <a href="/profile" title="">Trang cá nhân</a>
        </div>
        <div>
            <i class="fa fa-edit"></i> <a href="/sua-thong-tin" title="">Sửa thông tin</a>
        </div>
        <div>
            <i class="fa fa-lock"></i> <a href="/doi-mat-khau" title="">Đổi mật khẩu</a>
        </div>
        <hr>
        <div>
            <i class="fa fa-film"></i> <a href="/phim-da-xem" title="">Phim đã xem</a>
        </div>
        <div>
            <i class="fa fa-heart"></i> <a href="/phim-da-thich" title="">Phim đã thích</a>
        </div>
        <div>
            <i class="fa fa-bell"></i> <a href="/theo-doi" title="">Phim đang theo dõi</a>
        </div>
        <hr>
        <div>
            <i class="fa fa-power-off"></i> <a id="logout" title="" style="cursor: pointer;">Đăng xuất</a>
        </div>
        
    </div>
    <div class="tab-pane fade show" id="tab-announce" role="tabpanel">

    </div>
</div>


<script>
    $('#logout').click(function() {
        $('.user-header').load('/logout');
        $('.us-group label[for="us-chk"]').html('<i class="fa fa-user-circle" style="color: white;font-size: 40px;display: inline-block;cursor: pointer;"></i>')
        // location.href='/';
    });
</script>