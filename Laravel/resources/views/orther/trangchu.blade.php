@extends('master.master')
@section('main')
<?php
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'năm',
        'm' => 'tháng',
        'w' => 'tuần',
        'd' => 'ngày',
        'h' => 'giờ',
        'i' => 'phút',
        's' => 'giây',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v; //. ($diff->$k > 1 ? 's' : ''); // 2 years
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' trước' : 'vừa xong';
}
?>

<!-- chỗ này là lideshow nha -->
<div class="rid">
    <div class="main_live live_img">
        <div class="shadow">
            <div class="play_button">
                <i class="fa fa-play"></i>
            </div>
            <div class="slide-info">
                <span id="v"></span>
                <p id="n"></p>
            </div>
        </div>

        <img src="https://i.imacdn.com/vg/2020/04/09/c733224c492410f7_b4ff301085b70111_379906158642052279674.jpg" data-name="Sword Art Online: Alicization" data-view="3,582,627 lượt xem" alt="" style="display: block;">

    </div>
    <div class="live_item live_img">
        <img src="Images/Kimetsu_no_Yaiba/logo.jpg" data-name="Kimetsu no Yaiba" data-view="4,428,37 lượt xem" onmouseover="wrap_img(this);">
    </div>
    <div class="live_item live_img">
        <img src="Images/Boruto/logo_boruto.jpg" data-name="Boruto: Naruto Next Generations" data-view="33,787,507 lượt xem" alt="" onmouseover="wrap_img(this);">
    </div>
    <div class="live_item live_img">
        <img src="Images/iruma-kun/logo_irumakun.jpg" data-name="iruma-kun" data-view="" alt="" onmouseover="wrap_img(this);">
    </div>
    <div class="live_item live_img">
        <img src="Images/Plunderer/logo_plunderer.jpg" data-name="plunderer" data-view="424,349 lượt xem" alt="" onmouseover="wrap_img(this);">
    </div>
    <div class="live_item live_img">
        <img src="Images/Nanatsu_no_Taizai/logo_tdt.jpg" data-name="Nanatsu no Taizai - Thất Đại Tội " data-view="14,006,853 lượt xem" alt="" onmouseover="wrap_img(this);">
    </div>
    <div class="live_item live_img">
        <img src="Images/Kenja_no_Mago/slide1.jpg" data-name="Kenya no Mago" data-view="1,482,949 lượt xem" alt="" onmouseover="wrap_img(this);">
    </div>
    <div class="live_item live_img">
        <img src="Images/slide6.jpg" data-name="i want to eat your pancreas" data-view="231,797 lượt xem" alt="" onmouseover="wrap_img(this);">
    </div>
</div>

<!--A --- --------------------------------------------- -->

<h4>
    <a href="" title="" style="text-decoration: none;color: #333;">
        Tập Mới Nhất &nbsp;&nbsp; <i class="fa fa-angle-right"></i>
    </a>
</h4>
<div class="row" style="margin-left: 5px">

    <!-- ---------------------------- -->
    @foreach($animes as $anime)
    <?php $list = $anime->listEp;
    $ep = end($list); ?>
    <div class="msc">
        <div class="play_button">
            <i class="fa fa-play"></i>
        </div>
        <a href="{{$ep['link_ep']}}" title="">
            <div class="anime-i4">
                <div class="anime-name">
                    {{$anime->name}}
                </div>
                <div class="anime-title">
                    {{$ep['title']}}
                </div>
            </div>

            <img src="{{$ep['image']}}" alt="" height="auto" width="100%">
        </a>

    </div>

    @endforeach
    <!-- ---------------------------- -->
</div>
<h4>
    <a href="http://tinanime.com" title="" style="text-decoration: none;color: #333;">
        Tin Tức Anime &nbsp;&nbsp;<i class="fa fa-angle-right"></i>
    </a>
</h4>

<div class="grid">
    <?php $num = 0; ?>
    @forEach($news as $new)
    <div class="news-item {{$num%5 ==0? 'bigimg' : ''}}">
        <div class="news-img">
            <img src="{{$new->img}}" alt="">
        </div>
        <div class="news-info">
            <span class="{{$new->tag=='Nhân Vật'? 'nhan-vat' : ($new->tag=='Đề Cử Anime'? 'de-cu' :($new->tag=='Tin Tức Anime'? 'tin-tuc' : ($new->tag=='Cosplay'? 'cosplay':($new->tag=='Fanmade'?'fanmade':'review'))))}}">{{$new->tag}}</span>
            <div class="div-title"><a href="{{$new->url}}" title="" style="text-decoration: none;color: #333333;">{{$new->title}}</a>
            </div>
            <span class="time-view">{{time_elapsed_string($new->public_day)}} - {{number_format($new->view)}} lượt xem </span>
            <p>
                {{$new->description}}
            </p>

        </div>
    </div>
    <?php $num += 1; ?>
    @endforeach
</div>

@endsection

@section('script')
<script>
    var position_img = document.querySelectorAll('div.live_img img')
    inneri4()
    var isPause = false
    var interval_wrap = window.setInterval(function() {
        if (!isPause) {
            if (typeof pos == 'undefined') {
                var pos = Array(0, 1, 2, 3, 4, 5, 6, 7)
                var link_arr = new Array()
                var i = 0;
                position_img.forEach(function(el) {
                    link_arr[i] = [el.src, el.dataset.name, el.dataset.view]
                    i++
                })
            }

            for (var i = 0; i < 8; i++) {
                pos[i] = (pos[i] + 1) % 8
                position_img[i].src = link_arr[pos[i]][0]
                position_img[i].dataset.name = link_arr[pos[i]][1]
                position_img[i].dataset.view = link_arr[pos[i]][2]
            }
            inneri4()
        }

    }, 5000)

    function inneri4() {
        document.getElementById('v').innerText = document.querySelector('div.live_img img').dataset.view
        document.getElementById('n').innerText = document.querySelector('div.live_img img').dataset.name
    }

    function swap_attr(src, name, view) {
        document.querySelector('div.main_live img').src = src
        document.querySelector('div.main_live img').dataset.name = name
        document.querySelector('div.main_live img').dataset.view = view
        inneri4()
    }

    function wrap_img(a) {
        var linkmain = document.querySelector('div.main_live img').src
        var namemain = document.querySelector('div.main_live img').dataset.name
        var viewmain = document.querySelector('div.main_live img').dataset.view
        isPause = true
        swap_attr(a.src, a.dataset.name, a.dataset.view)
        a.addEventListener('mouseout', function() {
            swap_attr(linkmain, namemain, viewmain)
            isPause = false
        })
    }
    //  $('.play_button').css({
    //     // 'top': ($('.main_live').height() * 0.65) + 'px',
    //     'font-size': ($('.main_live').height() * 0.3) + 'px'
    // })
    //  $(window).resize(function () {
    //     $('.play_button').css({
    //         // 'top': ($('.main_live').height() * 0.65) + 'px',
    //         'font-size': ($('.main_live').height() * 0.3) + 'px'
    //     })

    // });
    // var h = $('.msc').width() * 9 / 16;
    // $('.msc').css({
    // 	"height": h+'px'
    // });
    // if ($(window).width() > 768) {
    //            var hmain_live = $('.live_item').height() * 3 + parseFloat($('.live_item').css('margin').replace('px', '')) * 4
    //            $('.main_live').css({
    //                height: hmain_live + 'px'
    //            })
    //        }
    //        else {
    //            $('.main_live').css({
    //                height: 'auto'
    //            })
    //        }

    // $(window).resize(function(){
    // 	var h = $('.msc').width() * 9 / 16;
    // $('.msc').css({
    // 	"height": h +'px'
    // });
    // if ($(window).width() > 768) {
    //            var hmain_live = $('.live_item').height() * 3 + parseFloat($('.live_item').css('margin').replace('px', '')) * 4
    //            $('.main_live').css({
    //                height: hmain_live + 'px'
    //            })
    //        }
    //        else {
    //            $('.main_live').css({
    //                height: 'auto'
    //            })
    //        }
    // });
</script>

@endsection