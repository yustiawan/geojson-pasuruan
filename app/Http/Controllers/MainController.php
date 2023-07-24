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
use Illuminate\Support\Facades\Storage;
class MainController extends Controller
{

    public function __construct()
    {

    }

    public function index(){
        $data=[];
        $sumKecamatan=[];
        $geo=Configgeojson::join('m_kecamatan','m_config_shape_kecamatan.idkecamatan','=','m_kecamatan.id')->select('m_config_shape_kecamatan.id as idconfig','m_kecamatan.nama_kecamatan','m_config_shape_kecamatan.filegeojson','m_config_shape_kecamatan.warna','m_config_shape_kecamatan.idkecamatan')->get();
        foreach ($geo as $g){
            $jbpnt=DB::table('m_penduduk as mp')->join('tr_penerima_bantuan as tp','mp.id','=','tp.idpenduduk')->where('tp.ispenerima_bpnt',1)->where('mp.idkecamatan',$g->idkecamatan)->count();
            $jbpum=DB::table('m_penduduk as mp')->join('tr_penerima_bantuan as tp','mp.id','=','tp.idpenduduk')->where('tp.ispenerima_bpum',1)->where('mp.idkecamatan',$g->idkecamatan)->count();
            $jbst=DB::table('m_penduduk as mp')->join('tr_penerima_bantuan as tp','mp.id','=','tp.idpenduduk')->where('tp.ispenerima_bst',1)->where('mp.idkecamatan',$g->idkecamatan)->count();
            $jpkh=DB::table('m_penduduk as mp')->join('tr_penerima_bantuan as tp','mp.id','=','tp.idpenduduk')->where('tp.ispenerima_pkh',1)->where('mp.idkecamatan',$g->idkecamatan)->count();
            $jsembako=DB::table('m_penduduk as mp')->join('tr_penerima_bantuan as tp','mp.id','=','tp.idpenduduk')->where('tp.ispenerima_sembako',1)->where('mp.idkecamatan',$g->idkecamatan)->count();
            $jdesa=DB::table('m_desa as md')->join('m_kecamatan as mk','md.idkecamatan','=','mk.id')->where('md.idkecamatan',$g->idkecamatan)->count();

            array_push($sumKecamatan,array('bpnt'=>$jbpnt,'bpum'=>$jbpum,'bst'=>$jbst,'pkh'=>$jpkh,'sembako'=>$jsembako,'namakecamatan'=>$g->nama_kecamatan,'warna'=>$g->warna,'filegeojson'=>$g->filegeojson,'jmldesa'=>$jdesa,'idkecamatan'=>$g->idkecamatan));
        }
        $data['sumKecamatan']=$sumKecamatan;
        return view('main',$data);
    }
    function dashboardDetail(Request $request){
        $data=[];
        $data['jbpnt']=DB::table('m_penduduk as mp')->join('tr_penerima_bantuan as tp','mp.id','=','tp.idpenduduk')->where('tp.ispenerima_bpnt',1)->count();
        $data['jbpum']=DB::table('m_penduduk as mp')->join('tr_penerima_bantuan as tp','mp.id','=','tp.idpenduduk')->where('tp.ispenerima_bpum',1)->count();
        $data['jbst']=DB::table('m_penduduk as mp')->join('tr_penerima_bantuan as tp','mp.id','=','tp.idpenduduk')->where('tp.ispenerima_bst',1)->count();
        $data['jpkh']=DB::table('m_penduduk as mp')->join('tr_penerima_bantuan as tp','mp.id','=','tp.idpenduduk')->where('tp.ispenerima_pkh',1)->count();
        $data['jsembako']=DB::table('m_penduduk as mp')->join('tr_penerima_bantuan as tp','mp.id','=','tp.idpenduduk')->where('tp.ispenerima_sembako',1)->count();
        $data['jall']=DB::table('m_penduduk as mp')->join('tr_penerima_bantuan as tp','mp.id','=','tp.idpenduduk')->count();

        $rows=Kecamatan::orderBy('nama_kecamatan','asc')->get();
        $i=0;
        $labelKecamatan=[];
        $nilaiKecamatan=[];
        $pendudukLakiPerkecamatan=[];
        $pendudukWanitaPerkecamatan=[];
        foreach ($rows as $k) {
            $labelKecamatan[$i]=$k->nama_kecamatan;
            $nilaiKecamatan[$i]=DB::table('m_penduduk as mp')->join('tr_penerima_bantuan as tp','mp.id','=','tp.idpenduduk')->where('mp.idkecamatan',$k->id)->count();
            $pendudukLakiPerkecamatan[$i]=DB::table('m_penduduk as mp')->join('tr_penerima_bantuan as tp','mp.id','=','tp.idpenduduk')->where('mp.idkecamatan',$k->id)->where('jk',1)->count();
            $pendudukWanitaPerkecamatan[$i]=DB::table('m_penduduk as mp')->join('tr_penerima_bantuan as tp','mp.id','=','tp.idpenduduk')->where('mp.idkecamatan',$k->id)->where('jk',2)->count();
            $i++;
        }
        $data['kecamatan']['label']=$labelKecamatan;
        $data['kecamatan']['nilai']=$nilaiKecamatan;
        $data['kecamatan']['laki']=$pendudukLakiPerkecamatan;
        $data['kecamatan']['perempuan']=$pendudukWanitaPerkecamatan;
        $kerja=DB::table('m_penduduk as mp')->join('m_jenis_pekerjaan as mj','mp.statusbekerja','=','mj.id')->select('mj.status_jenis_pekerjaan',DB::raw('COUNT(*) as total'))->groupBy('mj.status_jenis_pekerjaan')->orderBy('status_jenis_pekerjaan','asc')->get();
        $jeniskerja=[];
        $jumlahjeniskerja=[];
        $i=0;
        foreach ($kerja as $k){
            $jeniskerja[$i]=$k->status_jenis_pekerjaan;
            $jumlahjeniskerja[$i]=$k->total;
            $i++;
        }
        $data['jeniskerja']=$jeniskerja;
        $data['jumlahjeniskerja']=$jumlahjeniskerja;
        return view('dashboarddetil',$data);
    }
    function detilKecamatan(Request $request){
        $data=[];

        $idkecamatan=$request->input('idkecamatan');

        $kec=DB::table('m_kecamatan')->where('id',Crypt::decryptString($idkecamatan))->first();
        $data['idkecamatan']=$idkecamatan;
        $data['namakecamatan']=$kec->nama_kecamatan;

        $iddesa=[];
        $namadesa=[];
        $jmlpendudukmiskindesa=[];
        $rows=DB::table('m_desa as md')->join('m_kecamatan as mk','md.idkecamatan','=','mk.id')->select('md.id as iddesa','md.nama_desa')->where('mk.id',Crypt::decryptString($idkecamatan))->get();
        $i=0;
        foreach ($rows as $row) {
            $jml=DB::table('tr_penerima_bantuan as tp')->join('m_penduduk as mp','tp.idpenduduk','=','mp.id')->where('mp.iddesa',$row->iddesa)->count();
            $iddesa[$i]=$row->iddesa;
            $namadesa[$i]=$row->nama_desa;
            $jmlpendudukmiskindesa[$i]=$jml;
            $i++;
        }
        $data['iddesa']=$iddesa;
        $data['namadesa']=$namadesa;
        $data['jmlpendudukmiskindesa']=$jmlpendudukmiskindesa;
        return view('detaildatakecamatanfrommap',$data);
    }
}
