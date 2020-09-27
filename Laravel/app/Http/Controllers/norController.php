<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use \App\anime;
use \App\test;
use \App\user;
use \App\news;

class norController extends Controller
{
	function index()
	{
		$anime = anime::orderBy('update_at', 'desc')->take(12)->get();
		$news = news::orderBy('public_day', 'desc')->take(10)->get();
		// var_dump($anime);
		return view('orther.trangchu', ['title' => 'Trang chủ', 'animes' => $anime, 'news' => $news]);
	}
	public function xemphim($name, $tap)
	{
		$data = anime::where('_id', $name)->get();
		if (Auth::check()) {
			User::where('username', Auth::user()->username)->push(
				'viewed',
				$data[0]->_id,
				true
			);
		}
		anime::where('_id', $data[0]->_id)->increment('view');
		return view('orther.xemphim', ['title' => $data[0]->name, 'data' => $data, 'tap' => $tap, 'name' => $name]);
	}

	public function test(Request $request)
	{
		var_dump(count(anime::all()));
	}
	public function testt()
	{

		// return view('testmongo');
	}

	function live_search($name)
	{
		$dt = anime::where('name', 'like', '%' . $name . '%')->get();


		if ($dt->count() > 0) {
			foreach ($dt as $row) {
				echo '<a href="xem-phim/' . $row->_id . '"><li class="media">
    <img src="' . $row->image . '" class="mr-3" alt="..." width="100px" height="69px" style="margin:5px;">
    <div class="media-body">
      <h6 class="mt-0 mb-1" style="font-size:13px;">' . $row->name . '</h6>
    </div>
  </li></a>';
				// echo "string";
			}
		} else {
			echo 'Không tìm thấy kết quả';
		}
	}
	public function search(Request $request)
	{
		$rq = $request->get('s');
		if (isset($request->type) and $request->type != 'all') {
			$data = anime::where('type', $request->type)->where('name', 'like', '%' . $rq . '%')->paginate(24);
		} else {
			$data = anime::where('name', 'like', '%' . $rq . '%')->paginate(24);
		}
		return view('orther.search', ['title' => 'Kết quả tìm kiếm', 'dt' => $data]);
	}
	public function Postsearch(Request $request)
	{
		$rq = $request->get('s');
		$tp = $request->type;

		// ->paginate(32);
		// return view('testmongo', ['title' => 'Kết quả tìm kiếm', 'dt' => $data]);
	}
	function redirect_xemphim($name)
	{
		$anime = anime::where('_id', $name)->get();
		$tap = $anime[0]->listEp;

		return redirect('xem-phim/' . $name . '/' . $tap[0]['id_ep']);
	}

	function duyml()
	{
		$a = anime::all();
		return view("testmongo", ["duy" => $a]);
	}
}
