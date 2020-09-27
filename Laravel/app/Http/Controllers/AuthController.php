<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\User;
use App\anime;
use Mail;
class AuthController extends Controller
{


	public	function chekus(Request $request)
	{
		$usname = $request['usname'];
		$pass = $request['pw'];
		// $user= User::where('username',$usname)->where('password',bcrypt($pass));
		// Auth::login($user);
		// echo 'success';
		if (Auth::attempt(['username' => $usname, 'password' => $pass], $request->sve)) {
			echo "success";
		} else
			// return view('testmongo',['title'=>'test','s'=>'err']);
			echo "error";
	} // 
	function forget(){
    	return view('auth.forgetPass',['title'=>'Quên mật khẩu']);
    }
	function dhb()
	{
		$ckieN = cookie('username', Auth::user()->displayName, 60);
		$ckieI = cookie('at', Auth::user()->avartar, 60);
		View::share('user', Auth::user());
		return Response()->view('auth.userdashboar', ['user' => Auth::user()])->withCookie($ckieN)->withCookie($ckieI);
	}
	function logout()
	{
		Auth::logout();
		$ckie = cookie('username', '1', -60);
		return Response()->view('auth.login')->withCookie($ckie);
	}
	function register(Request $request)
	{
		$newUser = new User;
		$newUser->username = $request->username;
		$newUser->password = bcrypt($request->password);
		$newUser->email = $request->email;
		$newUser->displayName = $request->displayName;
		$newUser->gender = $request->gender;
		$newUser->birthday = $request->day . '/' . $request->month . '/' . $request->year;
		$newUser->avatar = '/Avatar/default.jpg';
		$newUser->role = 'User';
		$newUser->save();
		Auth::attempt(['username' => $request->username, 'password' => $request->password]);
		return redirect('/');
	}
	function getDoiPass()
	{
		return view('auth.changePass', ['title' => 'Đổi mật khẩu']);
	}

	function postDoiPass(Request $request)
	{
		$validate = $this->validate($request, [
			'curentPassword' => 'required | min:6 | max:30',
			'newPassword' => 'required | min:6 | max:30 | different:curentPassword',
			'newPassword_confirmation' => 'required | min:6 | max:30 | same:newPassword'
		], [
			'required' => ':attribute không được để trống',
			'min' => ':attribute tối thiểu :min',
			'max' => 'Độ dài tối đa lầ :max ký tự',
			'different' => ':attribute phải khác mật khẩu',
			'same' => ':attribute phải giống :same'
		], [
			'curentPassword' => 'Mật khẩu',
			'newPassword' => 'Mật khẩu mới',
			'newPassword_confirmation' => 'Xác nhận mật khẩu'
		]);
		$cp = user::where('username', Auth::user()->username)->update(['password' => bcrypt($request->newPassword)]);
		if ($cp) {
			return view('auth.changePass', ['annou' => 'Đổi mật khẩu thành công']);
		} else {
			return view('auth.changePass ', ['annou' => 'Đổi mật khẩu thất bại']);
		}
	}
	function like(Request $request)
	{
		$url = $_SERVER['HTTP_REFERER'];
		$i = 0;
		$splitUrl[$i] = '';
		for ($j = 0; $j < strlen($url); $j++) {
			if ($url[$j] != '/')
				$splitUrl[$i] .= $url[$j];
			else {
				$i++;
				$splitUrl[$i] = '';
			}
		}

		$anime = anime::find($splitUrl[4]);
		if (Auth::check() == 0)
			echo '{"status":"Chức năng dành cho thành viên đã đăng nhập"}';
		else {

			$like =	User::where('username', Auth::user()->username)->push(
				'liked',
				$anime->_id,
				true
			);
			if ($like) {
				anime::where('_id', $splitUrl[4])->increment('like');
				$anime = anime::find($splitUrl[4]);
				echo json_encode([
					'status' => 'Bạn đã thích ' . $anime->name,
					'css' => '{"background" : "#ff0066","color":"white"}',
					'like' => number_format($anime->like)
				]);
			} else {

				User::where('username', Auth::user()->username)->pull(
					'liked',
					$anime->_id
				);
				anime::where('_id', $splitUrl[4])->decrement('like');
				$anime = anime::find($splitUrl[4]);
				echo json_encode(['status' => 'Bạn đã bỏ thích ' . $anime->name, 'css' => '{"background" : "white","color":"#ff0066"}', "like" => number_format($anime->like)]);
			}
		}
	}
	function follow(Request $request)
	{
		$url = $_SERVER['HTTP_REFERER'];
		$i = 0;
		$splitUrl[$i] = '';
		for ($j = 0; $j < strlen($url); $j++) {
			if ($url[$j] != '/')
				$splitUrl[$i] .= $url[$j];
			else {
				$i++;
				$splitUrl[$i] = '';
			}
		}

		$anime = anime::find($splitUrl[4]);
		if (Auth::check() == 0)
			echo 'Chức năng dành cho thành viên đã đăng nhập';
		else {
			$like =	User::where('username', Auth::user()->username)->push(
				'followed',
				$anime->_id,
				true
			);
			if ($like) {
				anime::where('_id', $splitUrl[4])->increment('follow');
				$anime = anime::find($splitUrl[4]);
				echo json_encode(['status' => 'Bạn đã theo dõi ' . $anime->name, 'css' => '{"background" : "#00cc00","color":"white"}', "follow" => number_format($anime->follow)]);
			} else {
				User::where('username', Auth::user()->username)->pull(
					'followed',
					$anime->_id
				);
				anime::where('_id', $splitUrl[4])->decrement('follow');
				$anime = anime::find($splitUrl[4]);
				echo json_encode(['status' => 'Bạn đã bỏ theo dõi ' . $anime->name, 'css' => '{"background" : "white","color":"#00cc00"}', "follow" => number_format($anime->follow)]);
			}
		}
	}

	function getlike_follow()
	{
		$data = User::where('username', Auth::user()->username)->get();

		$urlCurrent = url()->current();
		if (class_basename($urlCurrent) == 'phim-theo-doi')
			return view('auth.like_follow', ['title' => 'Anime đã thích', 'datas' => anime::whereIn('_id', $data[0]->followed)->get(['name', 'follow', 'image'])]);
		elseif (class_basename($urlCurrent) == 'phim-da-xem')
			return view('auth.like_follow', ['title' => 'Anime đã xem', 'datas' => anime::whereIn('_id', $data[0]->viewed)->get(['name', 'view', 'image'])]);
		else
			return view('auth.like_follow', ['title' => 'Anime đã theo dõi', 'datas' => anime::whereIn('_id', $data[0]->liked)->get(['name', 'like', 'image'])]);
	}
	function comment(Request $request)
	{
		$url = $_SERVER['HTTP_REFERER'];
		$i = 0;
		$splitUrl[$i] = '';
		for ($j = 0; $j < strlen($url); $j++) {
			if ($url[$j] != '/')
				$splitUrl[$i] .= $url[$j];
			else {
				$i++;
				$splitUrl[$i] = '';
			}
		}
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		// echo json_encode($splitUrl);
		anime::where('_id', $splitUrl[4])->push('cmt', [
			'displayName' => Auth::user()->displayName,
			'content' => strip_tags($request->content),
			'avatar' => Auth::user()->avatar,
			'time' => date("Y-m-d H:i:s")
		]);
	}

	function profile()
	{
		return view('auth.profile', ['title' => 'Thông tin cá nhân']);
	}

	function get_Edit_Profile()
	{
		return view('auth.editinfo', ['title' => 'Sửa thông tin']);
	}

	function post_Edit_Profile(Request $request)
	{
		$us = user::where('username', Auth::user()->username)->first();
		$us->displayName = $request->DisplayName;
		$us->gender = $request->gender;
		$us->birthday = $request->day . '/' . $request->month . '/' . $request->year;
		$us->email = $request->email;
		$us->save();
		return view('auth.editinfo', ['title' => 'Sửa thông tin', 'status' => 'Thông tin đã được cập nhật']);
	}
	function checkUsername(Request $request){
		$user = user::where('username',$request->username)->first();
		if(!isset($user->username))
		{
			echo '{"status":"success"}';
		}
		else
			echo '{"status":"error"}';
	}
	public function sendMail($user){
        $users = user::where('username', $user)->first();
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < 6; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    $data = [
        	'name' => $users['displayName'],
        	'pass' => $randomString,
        ];
        $users->password = bcrypt($randomString);
        $users->save();
        Mail::send('email', $data, function($message) use ($users){
            $message->from('crawl.data.1509@gmail.com','Anime World');
            $message->to($users['email'], 'Bé Di');
            $message->subject('Khôi Phục Mật Khẩu');
        });
    }
    function emailExists(Request $request){
		$user = user::where('email',$request->email)->first();
		if(!isset($user->username))
		{
			echo '{"status":"success"}';
		}
		else
			echo '{"status":"error"}';
	}
}
