<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public $person = [];

    public function __construct()
    {

    }
    public function index(){
        $data=[];
        $kecamatan=array(array('id'=>'1','nama'=>'bangil','filegeojson'=>'pasuruan/bangil.geojson','sumdata'=>''));
        $data['fileKecamatan']=$kecamatan;
        return view('main',$data);
    }
}
