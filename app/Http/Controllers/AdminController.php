<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Configgeojson;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Penduduk;
use App\Models\Opd;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
class AdminController extends Controller
{

    public function __construct()
    {

    }
    function tes(Request $request){
        //dd((Cookie::get('appkemisan')));
        dd(getUserFromCookie(Cookie::get('appkemisan')));
    }
    function index(Request $request){
        return view('layoutbackend');
    }
    function menuKecamatan(Request $request){
        $rows=DB::table('m_kecamatan')->orderBy('nama_kecamatan','asc')->get();
        $data['kecamatan']=$rows;
        return view('admin.kecamatan',$data);
    }
    function menuDesa(Request $request){
        $rows=DB::table('m_desa as md')->join('m_kecamatan as mk','md.idkecamatan','=','mk.id')->orderBy('nama_kecamatan','asc')->orderBy('nama_desa','asc')->select('md.id as iddesa','mk.id as idkecamatan','md.nama_desa','mk.nama_kecamatan')->get();
        $data['desa']=$rows;
        $data['kecamatan']=Kecamatan::orderBy('nama_kecamatan','asc')->get();
        return view('admin.desa',$data);
    }
    function editKecamatan(Request $request){
        $idkecamatan=$request->input('idkecamatan');
        $namakecamatan=$request->input('nama_kecamatan');
        $kecamatan=Kecamatan::where('id',Crypt::decryptString($idkecamatan))->first();
        $kecamatan->nama_kecamatan=$namakecamatan;
        $kecamatan->save();
        session()->flash('success', 'simpan berhasil!');
        return redirect('/admin/kecamatan');
    }
    function hapusKecamatan(Request $request){
        $idkecamatan=$request->input('idkecamatan');
        $kecamatan = Kecamatan::find(Crypt::decryptString($idkecamatan));
        // Jika record ditemukan, hapus data dari database
        if ($kecamatan) {
            $kecamatan->delete();
            return redirect('/admin/kecamatan')->with('success', 'kecamatan berhasil dihapus!');
        } else {
            return redirect('/admin/kecamatan')->with('error', 'kecamatan gagal dihapus!');
        }
    }
    function editDesa(Request $request){
        $idkecamatan=$request->input('idkecamatan');
        $iddesa=$request->input('iddesa');
        $namadesa=$request->input('nama_desa');
        $desa=Desa::find(Crypt::decryptString($iddesa));
        if ($desa) {
            $desa->idkecamatan=Crypt::decryptString($idkecamatan);
            $desa->nama_desa=$namadesa;
            $desa->save();
            return redirect('/admin/desa')->with('success', 'simpan berhasil !');
        } else {
            return redirect('/admin/desa')->with('error', 'simpan gagal !');
        }
    }
    function hapusDesa(Request $request){
        $iddesa=$request->input('iddesa');
        $desa = Desa::find(Crypt::decryptString($iddesa));
        // Jika record ditemukan, hapus data dari database
        if ($desa) {
            $desa->delete();
            return redirect('/admin/desa')->with('success', 'desa berhasil dihapus!');
        } else {
            return redirect('/admin/desa')->with('error', 'desa gagal dihapus!');
        }
    }
    function createKecamatan(Request $request){
        $kecamatan=new Kecamatan();
        $namakecamatan=$request->input('nama_kecamatan');
        $kecamatan->nama_kecamatan=$namakecamatan;
        $kecamatan->save();
        session()->flash('success', 'simpan berhasil!');
        return redirect('/admin/kecamatan');
    }
    function createDesa(Request $request){
        $idkecamatan=$request->input('idkecamatan');
        $desa=new Desa(['idkecamatan'=>Crypt::decryptString($idkecamatan)]);
        $namadesa=$request->input('nama_desa');
        $desa->idkecamatan=Crypt::decryptString($idkecamatan);
        $desa->nama_desa=$namadesa;
        $desa->save();
        session()->flash('success', 'simpan berhasil!');
        return redirect('/admin/desa');
    }
    function showMapConfig(Request  $request){
        $data=[];
        $rows=Kecamatan::leftJoin('m_config_shape_kecamatan as ms','m_kecamatan.id','=','ms.idkecamatan')->select('m_kecamatan.id as idkecamatan','m_kecamatan.nama_kecamatan','ms.id as idconfig','ms.filegeojson','warna')->orderBy('m_kecamatan.nama_kecamatan','asc')->get();
        $data['dataconfig']=$rows;
        return view('admin/settingmap',$data);
    }
    function saveMapConfig(Request $request){
        try{
            $idconfig=$request->input('idconfig');
            $idkecamatan=$request->input('idkecamatan');
            if($idconfig!=''){
                $config=Configgeojson::find(Crypt::decryptString($idconfig));
            }else{
                $config=new Configgeojson();
            }

            $warna=$request->input('warna');
            $config->idkecamatan=Crypt::decryptString($idkecamatan);
            // Mendapatkan objek UploadedFile dari file yang diunggah
            $uploadedFile = $request->file('filegeojson');

            // Mendapatkan nama asli dari file yang diunggah
            $filegeojson = $uploadedFile->getClientOriginalName();
            $config->filegeojson=$filegeojson;
            $config->warna=$warna;
            // Menyimpan file ke folder public/pasuruan dengan menggunakan store
            $file = $uploadedFile->storeAs('pasuruan',$filegeojson,['disk' => 'public']);

            // Periksa apakah proses upload berhasil
            if ($file) {
                // Jika berhasil, lakukan tindakan sesuai kebutuhan
                $config->save();
                session()->flash('success', 'simpan berhasil!');
                return redirect('/admin/settingmap');
            } else {
                // Jika terjadi kesalahan dalam upload
                session()->flash('error', 'error save file.error upload');
                return 'Gagal mengunggah file. Silakan coba lagi.';
            }
        }
        catch(\Throwable $t){
            dd($t);
            session()->flash('error', 'error server'.json_encode($t));
            return redirect('/admin/settingmap');
        }
    }
    function dataKemiskinan(Request $request){
        $data=[];
        return view('admin.datakemiskinan',$data);
    }
    function getDataKemiskinan(Request $request){
        $data=[];
        $limit = $request->input('length');
        $start = $request->input('start');
        $data['data']=[];
        $data['recordsTotal']=Penduduk::join('m_jenis_pekerjaan as mp','m_penduduk.statusbekerja','=','mp.id')->join('m_status_pendidikan as msp','m_penduduk.pendidikan','=','msp.id')->count();
        $data['recordsFiltered']=$data['recordsTotal'];
        $rows=Penduduk::join('m_jenis_pekerjaan as mp','m_penduduk.statusbekerja','=','mp.id')->join('m_status_pendidikan as msp','m_penduduk.pendidikan','=','msp.id')->select('nik','nama','alamat','msp.status_pendidikan','mp.status_jenis_pekerjaan')->limit($limit)->offset($start)->get();
        foreach ($rows as $r){
            $data['data'][]=[$r->nik,$r->nama,$r->alamat,$r->status_jenis_pekerjaan,$r->status_pendidikan,''];
        }
        return response()->json($data);
    }
    function showListOpd(Request $request){
        $data=[];
        $rows=Opd::orderBy('namaopd','asc')->get();
        $data['opd']=$rows;
        return view('admin/opd',$data);
    }
}
