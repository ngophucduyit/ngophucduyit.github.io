<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\anime;
use App\news;
use Mail;
class AdminController extends Controller
{
    //
    function dashboard(){
    	$anime = anime::all();
    	return view('admin.index',['animes'=>$anime]);
    }

    function showanime(){
        $anime = anime::all();
        return view('admin.showanime',['animes'=>$anime]);
    }

    function showuser(){
        $anime = anime::all();
        return view('admin.showuser',['animes'=>$anime]);
    }

    function shownews(){
        $anime = anime::all();
        return view('admin.shownews',['animes'=>$anime]);
    }

    function update(){
        $anime = anime::all();
        return view('admin.update',['animes'=>$anime]);
    }

    function getanime($key,Request $request){
        // $anime = anime::all();
        $num = 1;
        if($key != 'Tất Cả'){
            $num = count(anime::where('type', $key)->get());
            if(isset($request->page))
                $anime = anime::where('type', $key)->skip(12*($request->page - 1))->take(12)->get();
            else
                $anime = anime::where('type', $key)->take(12)->get();
        }
        else{
            $num = count(anime::all());
            if(isset($request->page))
                $anime = anime::skip(12*($request->page - 1))->take(12)->get();
            else
                $anime = anime::take(12)->get();
        }
        $_id = array();
        $name = array();
        $like = array();
        $des = array();
        $view = array();
        $follow = array();
        $img = array();
        $num_ep = array();
        $types = array();
        $link_am = array();
        if ($key == 'Tất Cả'){
            foreach ($anime as $i) {
                $type = array();
                array_push($_id, $i['_id']);
                array_push($name, $i['name']);
                array_push($like, $i['like']);
                array_push($des, $i['info']);
                array_push($view, $i['view']);
                array_push($follow, $i['follow']);
                array_push($img, $i['image']);
                array_push($num_ep, $i['num_ep']);
                array_push($link_am, $i['listEp'][0]['link_ep']);
                foreach ($i['type'] as $j) {
                    array_push($type, trim($j));
                }
                array_push($types, $type);
                }
            }
        else{
            foreach ($anime as $i) {
                $type = array();
                $flag = 0;
                foreach ($i['type'] as $j) {
                    if ($key == trim($j)){
                        $flag = 1;
                        break;
                    } 
                }
                if ($flag){
                    array_push($_id, $i['_id']);
                    array_push($name, $i['name']);
                    array_push($like, $i['like']);
                    array_push($view, $i['view']);
                    array_push($des, $i['info']);
                    array_push($follow, $i['follow']);
                    array_push($img, $i['image']);
                    array_push($num_ep, $i['num_ep']);
                    array_push($link_am, $i['listEp'][0]['link_ep']);
                    foreach ($i['type'] as $j) {
                        array_push($type, trim($j));
                    }
                    array_push($types, $type);
                }
            }
        }
        $json_array = array('_id' => $_id,'name' => $name,'like' => $like, 'view' => $view, 'follow' => $follow, 'img' => $img, 'num_ep' => $num_ep, 'type' => $types, 'des' => $des, 'num' => $num,'link_am' => $link_am);
        echo json_encode($json_array, JSON_UNESCAPED_UNICODE);
    }

    function getdata(){
    	$anime = anime::all();
    	$name = array();
    	$like = array();
    	$view = array();
    	$follow = array();
        $img = array();
        $num_ep = array();
        $types = array();
        $link_am = array();
    	foreach ($anime as $i) {
            $type = array();
    		array_push($name, $i['name']);
    		array_push($like, $i['like']);
    		array_push($view, (int)$i['view']/1000);
    		array_push($follow, $i['follow']);
            array_push($img, $i['image']);
            array_push($num_ep, $i['num_ep']);
            array_push($link_am, $i['listEp'][0]['link_ep']);
            foreach ($i['type'] as $j) {
                array_push($type, $j);
            }
            array_push($types, $type);
    	}
    	$json_array = array('name' => $name,'like' => $like, 'view' => $view, 'follow' => $follow, 'img' => $img, 'num_ep' => $num_ep, 'type' => $types, 'link_am' => $link_am);
    	echo json_encode($json_array, JSON_UNESCAPED_UNICODE);
    }
    function getdefault($name){
        $anime = anime::where('_id', $name) -> get();
        $_id = $anime[0]['_id'];
        $name = $anime[0]['name'];
        $des = $anime[0]['info'];
        $like = $anime[0]['like'];
        $follow = $anime[0]['follow'];
        $view = $anime[0]['view'];
        $img = $anime[0]['image'];
        $num_ep = $anime[0]['num_ep'];
        $view_ep = array();
        $name_ep = array();
        $type = array();
        $link_am = $anime[0]['listEp'][0]['link_ep'];
        foreach ($anime[0]['listEp'] as $i) {
            if (in_array(explode(' -', $i['title'])[0],$name_ep))
                array_push($name_ep, explode(' -', $i['title'])[0].' 2');
            else
                array_push($name_ep, explode(' -', $i['title'])[0]);
            array_push($view_ep, $i['num_view']);
        }
        foreach ($anime[0]['type'] as $i) {
            array_push($type, $i);
        }
        $json_array = array('_id' => $_id, 'name' => $name,'des' => $des, 'like' => $like, 'view' => $view, 'follow' => $follow, 'img' => $img, 'num_ep' => $num_ep, 'view_ep' => $view_ep, 'name_ep' => $name_ep, 'type' => $type, 'link_am' => $link_am);
        echo json_encode($json_array, JSON_UNESCAPED_UNICODE);
    }
    function deleteAM($key){
        $del = anime::find($key);
        $del -> delete();
        return 'Thành công!!!';
    }
    function updateAM(Request $request){
        $anime = anime::find($request->_id);
        $type = $request->type;
        for ($i=0; $i <sizeof($type) ; $i++) { 
            $type[$i] = trim($type[$i]);
        }
        $anime->name = $request->name;
        $anime->image = $request->img;
        $anime->intro = $request->des;
        $anime->view = $request->view;
        $anime->like = $request->like;
        $anime->follow = $request->follow;
        $anime->num_ep = $request->num_ep;
        $anime->type = $type;
        $anime->save();
        // echo $request->name;
    }
    function getnews(){
        $news = news::all();
        $img = array();
        $title = array();
        $tag = array();
        $public_day = array();
        $view = array();
        $des = array();
        $tags = array();
        $tags = array();
        foreach ($news as $i) {
            array_push($img, $i['img']);
            array_push($title, $i['title']);
            array_push($tag, $i['tag']);
            array_push($public_day, $i['public_day']);
            array_push($view, $i['view']);
            array_push($des, $i['description']);
            if(!(in_array($i['tag'], $tags)))
                array_push($tags, $i['tag']);
        }
        $json_array = array('title' => $title, 'view' => $view, 'img' => $img, 'public_day' => $public_day, 'tag' => $tag, 'des' => $des, 'tags' => $tags);
        echo json_encode($json_array, JSON_UNESCAPED_UNICODE);
    }
    function getdatanews($key,Request $request){
        $num = 1;
        if($key != 'Tất Cả'){
            $num = count(news::where('tag', $key)->get());
            if(isset($request->page))
                $news = news::where('tag', $key)->skip(12*($request->page - 1))->take(12)->get();
            else
                $news = news::where('tag', $key)->take(12)->get();
        }
        else{
            $num = count(news::all());
            if(isset($request->page))
                $news = news::skip(12*($request->page - 1))->take(12)->get();
            else
                $news = news::take(12)->get();
        }
        $url = array();
        $_id = array();
        $img = array();
        $title = array();
        $tag = array();
        $public_day = array();
        $view = array();
        $des = array();

        if ($key == 'Tất Cả'){
            foreach ($news as $i) {
                array_push($url, $i['url']);
                array_push($_id, $i['_id']);
                array_push($img, $i['img']);
                array_push($title, $i['title']);
                array_push($tag, $i['tag']);
                array_push($public_day, $i['public_day']);
                array_push($view, $i['view']);
                array_push($des, str_replace("'", '', $i['description']));
            }
        }
        else{
            foreach ($news as $i) {
                if ($i['tag'] == $key){
                    array_push($url, $i['url']);
                    array_push($_id, $i['_id']);
                    array_push($img, $i['img']);
                    array_push($title, $i['title']);
                    array_push($tag, $i['tag']);
                    array_push($public_day, $i['public_day']);
                    array_push($view, $i['view']);
                    array_push($des, str_replace("'", '', $i['description']));
                }
            }
        }
        $json_array = array('_id' => $_id,'url' => $url, 'title' => $title, 'view' => $view, 'img' => $img, 'public_day' => $public_day, 'tag' => $tag, 'des' => $des, 'num' => $num);
        echo json_encode($json_array, JSON_UNESCAPED_UNICODE);
    }
    function getdefaultnews($name){
        $news = news::where('_id', $name) -> first();
        $_id = $news['_id'];
        $title = $news['title'];
        $des = $news['description'];
        $view = $news['view'];
        $img = $news['img'];
        $tag = $news['tag'];
        $public_day = $news['public_day'];
        $json_array = array('_id' => $_id, 'title' => $title,'des' => $des, 'view' => $view, 'img' => $img, 'tag' => $tag, 'public_day' => $public_day);
        echo json_encode($json_array, JSON_UNESCAPED_UNICODE);
    }
    function deletenews($key){
        $del = news::find($key);
        $del -> delete();
        return 'Thành công!!!';
    }
    function updatenews(Request $request){
        $news = news::find($request->_id);
        $news->title = $request->title;
        $news->img = $request->img;
        $news->description = $request->des;
        $news->view = $request->view;
        $news->public_day = $request->public_day;
        $news->tag = $request->tag;
        $news->save();
        // echo $request->name;
    }
    function getuser(){
        $user = user::all();
        $username = array();
        $display = array();
        $gender = array();
        $birthday = array();
        $role = array();
        $roles = array();
        $avt = array();
        $email = array();
        foreach ($user as $i) {
            array_push($username, $i['username']);
            array_push($display, $i['displayName']);
            array_push($gender, $i['gender']);
            array_push($birthday, $i['birthday']);
            array_push($role, $i['role']);
            array_push($avt, $i['avatar']);
            array_push($email, $i['email']);
            if(!(in_array($i['role'], $roles)))
                array_push($roles, $i['role']);
        }
        $json_array = array('username' => $username, 'display' => $display,'gender' => $gender, 'birthday' => $birthday, 'role' => $role, 'avt' => $avt, 'email' => $email, 'roles' => $roles);
        echo json_encode($json_array, JSON_UNESCAPED_UNICODE);
    }
    function getdatauser($key,Request $request){
        $num = 1;
        if($key != 'Tất Cả'){
            $num = count(user::where('role', $key)->get());
            if(isset($request->page))
                $user = user::where('role', $key)->skip(12*($request->page - 1))->take(12)->get();
            else
                $user = user::where('role', $key)->take(12)->get();
        }
        else{
            $num = count(user::all());
            if(isset($request->page))
                $user = user::skip(12*($request->page - 1))->take(12)->get();
            else
                $user = user::take(12)->get();
        }
        $user = user::all();
        $username = array();
        $display = array();
        $gender = array();
        $birthday = array();
        $role = array();
        $roles = array();
        $avt = array();
        $email = array();

        if ($key == 'Tất Cả'){
            foreach ($user as $i) {
                array_push($username, $i['username']);
                array_push($display, $i['displayName']);
                array_push($gender, $i['gender']);
                array_push($birthday, $i['birthday']);
                array_push($role, $i['role']);
                array_push($avt, $i['avatar']);
                array_push($email, $i['email']);
                if(!(in_array($i['role'], $roles)))
                   array_push($roles, $i['role']);
            }
        }
        else{
            foreach ($user as $i) {
                if ($i['role'] == $key){
                    array_push($username, $i['username']);
                    array_push($display, $i['displayName']);
                    array_push($gender, $i['gender']);
                    array_push($birthday, $i['birthday']);
                    array_push($role, $i['role']);
                    array_push($avt, $i['avatar']);
                    array_push($email, $i['email']);
                    if(!(in_array($i['role'], $roles)))
                       array_push($roles, $i['role']);
                }
            }
        }
        $json_array = array('username' => $username, 'display' => $display,'gender' => $gender, 'birthday' => $birthday, 'role' => $role, 'avt' => $avt, 'email' => $email, 'roles' => $roles);
        echo json_encode($json_array, JSON_UNESCAPED_UNICODE);
    }
    function deleteuser($key){
        $del = user::where('username',$key);
        $del -> delete();
        return 'Thành công!!!';
    }
    function getdefaultuser($name){
        $user = user::where('username', $name) -> first();
        $username = $user['username'];
        $display = $user['displayName'];
        $gender = $user['gender'];
        $birthday = $user['birthday'];
        $role = $user['role'];
        $avt = $user['avatar'];
        $email = $user['email'];
        $json_array = array('username' => $username, 'display' => $display,'gender' => $gender, 'birthday' => $birthday, 'role' => $role, 'avt' => $avt, 'email' => $email);
        echo json_encode($json_array, JSON_UNESCAPED_UNICODE);
    }
    function updateuser(Request $request){
        $user = user::where('username',$request->username)->first();
        $user->displayName = $request->display;
        $user->avatar = $request->avt;
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($request->reset == 'Yes')
            $user->password = bcrypt('123456');
        $user->save();
        // echo $request->name;
    }
    public function sendMail(){
        $data = [
            'name'=>'Duy',
            'mssv'=>'18006471'
        ];
        Mail::send('email', $data, function($message){
            $message->from('loghai0210.mnm@gmail.com','Admin');
            $message->to('ngophucduy103@gmail.com', 'Bé Di');
            $message->subject('Gửi để test');
        });
    }
}
