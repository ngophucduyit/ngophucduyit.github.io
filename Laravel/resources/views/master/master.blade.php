<!doctype html>
<html lang="en">

<head>
  <title>{{$title ?? ''}}</title>
  <base href="{{asset('')}}">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="shortcut icon" href="Images/Layout/unnamed.png" type="image/x-icon">
  <!-- css -->
  <link rel="stylesheet" type="text/css" href="CSS/header.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./CSS/bootstrap-4.5.0/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- owl-carousel -->
  <link rel="stylesheet" type="text/css" href="./CSS/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="./CSS/owl.theme.default.css">
  <!-- script -->
  <script src="./JS/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="./CSS/bootstrap-4.5.0/dist/js/bootstrap.min.js"></script>
  <script src="JS/owl.carousel.js" type="text/javascript"></script>
  <!-- <script src="JS/script.js" type="text/javascript"></script> -->
  <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
  <script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style type="text/css" media="screen">
    .no-js #loader {
      display: none;
    }

    .js #loader {
      display: block;
      position: absolute;
      left: 100px;
      top: 0;
    }

    .se-pre-con {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url(./Images/Layout/Preloader_11.gif) center no-repeat #fff;
    }
  </style>
</head>

<body>
  <div class="se-pre-con"></div>

  <!-- thanh menu -->
  <div class="container-fluid">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="/"><img src="Images/lolo.png" style="height: 30px; width: 100px; padding-bottom: 10px;"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation" style="border: none;">
        <span class="fa fa-bars"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Anime <span class="sr-only"></span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="navDropdown" role="button" data-toggle="dropdown">Tin Tức </a>
            <div class="dropdown-menu" aria-labelledby="navDropdown">
              <a class="dropdown-item" href="https://tinanime.com/the-loai/tin-tuc-anime">Tin Tức</a>
              <a class="dropdown-item" href="https://tinanime.com/">Thông tin Anime</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/ranking">Bảng Xếp Hạng</a>
          </li>
          <li class="nav-item" style="position: relative;">
            <form class="form-inline " action="/search">
              <input id="search" type="text" class="form-control mr-sm-2" name="s" placeholder="Search" autocomplete="off">
              <button class="btn btn-primary sbtn" type="submit"><span>Tìm</span></button>

            </form>
            <ul class="list-unstyled" id="list_rs" style="position: absolute;background: white;width: 100%;">
            </ul>
          </li>
        </ul>
      </div>
      <div class="us-group" style="width: 80px;top:8px;height: 40px;line-height: 40px;">
        <a class="fa fa-info" style="color: white;font-size: 24px;text-decoration: none;display: inline-block;margin-right: 10px;" title="Chính sách" href="chinh-sach"></a>
        <label for="us-chk">
          @if(Auth::check())
          <div class="user-circle">
            <img src="{{Auth::user()->avatar}}" alt="">
          </div>
          @else
          <i class="fa fa-user-circle" style="color: white;font-size: 40px;display: inline-block;cursor: pointer;"></i>
          @endif
        </label>
      </div>
      <input type="checkbox" name="" id="us-chk">
      <div class="user-header">
        @if(!Auth::check())
        {{view('auth.login')}}
        @else
        {{view('auth.userdashboar')}}
        @endif
      </div>
    </nav>
  </div>
  <hr>
  <div class="container-fluid" style="margin-top: 55px;background: white;">
    @yield('main')
  </div>
  <!-- footer -->
  <hr>
  <footer>
    <div class="container-fluid">
      <div class="row">
        <div class="col col-md-6 ft">
          <h5 style="color: white; font-size: 24px;transform: uppercase;">Thông tin</h5>
          <ul class="list-unstyled">
            <li>
              <a href="#" data-toggle="modal" data-target="#FormDK">Liên hệ</a>
            </li>
            <li>
              <a href="#">Trung tâm hỗ trợ</a>
            </li>
            <li>
              <a href="#">Hướng dẫn người dùng</a>
            </li>
            <li>
              <a href="#">Chính sách bảo mật</a>
            </li>
          </ul>
        </div>
        <div class="col col-md-6 ft">
          <h5 class="text-uppercase" style="color: white; font-size: 24px;">Kết nối với chúng tôi</h5>
          <h5 style="color: white; font-size: 20px;">Trần Long Hải - 18001841</h5>
          <h5 style="color: white; font-size: 20px;">Ngô Phúc Duy - 18006471</h5>
        </div>
      </div>
      <div class="row">
        <div class=" col col-md-12 ft">
          © 2019 Copyright:
          <a href="https://vuighe.net/" style="color: wheat">Vuighe.net</a>
        </div>
      </div>
    </div>
  </footer>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="JS/script.js" type="text/javascript"></script>
  @yield('script')

  <script type="text/javascript">
    setTimeout(function() {
      $(".se-pre-con").fadeOut("slow");
      $(".se-pre-con").remove();
    }, 3000)
    // $.ajaxSetup({
    //   headers:{
    //     'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    //   }
    // });
    // $('#search').keyup(function() {
    //   var qr = $("#search").val();
    //   if (qr == '')
    //     $('#list_rs').html('').removeClass('list-rs-show');
    //   else
    //     $.get('live_search/' + qr, function(data) {
    //       $('#list_rs').html(data).addClass('list-rs-show');
    //     });
    // });
    // $(".user-header").css({"height":$(document).height()});
    // $(window).on('load',function(){
    //     $(".se-pre-con").fadeOut("slow");
    // });
  </script>
</body>

</html>