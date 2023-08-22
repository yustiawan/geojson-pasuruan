<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Configgeojson;
use App\Models\Login;
use Illuminate\Support\Facades\Storage;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\Key;

class LoginController extends Controller
{

    public function __construct()
    {

    }
    function login(Request $request){
        return view('login');
    }
    public function loginUser(Request $request){

        $username=$request->input('username');
        $password=$request->input('password');
        $pass=md5($password);
        $user=DB::table('m_user')->where('username',$username)->where('password',$pass)->first();
        if($user!=null){
            $token=$this->generateToken($user);
            $expireTimeInMinutes = 480; // 8 jam dalam menit
            $user->token=$token;
            $this->saveLogin($user);
            return redirect('admin/home')->withCookie(cookie('appkemisan',$token,$expireTimeInMinutes));
        }else{
            session()->flash('error', 'username atau password tidak sesuai!');
            return redirect('/login');
        }

    }
    private function generateToken($user){
        $data_login=[];
        $data_login['username']=$user->username;
        $data_login['nama']=$user->nama;
        $data_login['jenisuser']=$user->jenisuser;
        $data_login['iat']=strtotime("now");
        $data_login['exp']=strtotime("+8 hours");
        return JWT::encode($data_login, env('jwt_key'),'HS256');
    }
    private function saveLogin($user){
        $login=new Login();
        $login->username=$user->username;
        $login->jenisuser=$user->jenisuser;
        $login->token=$user->token;
        $login->loginat=date('Y-m-d h:i:s');
        $login->save();
    }
}
