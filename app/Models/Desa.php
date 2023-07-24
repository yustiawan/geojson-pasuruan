<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Desa extends Model
{
    protected $table = 'm_desa';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public function __construct(array $attributes = array())
    {

        if(array_key_exists('idkecamatan',$attributes)){
            $jmlDesa=DB::table('m_desa')->select(DB::raw('MAX(CAST(id AS SIGNED)) AS max_id'))->where('idkecamatan',$attributes['idkecamatan'])->value('max_id');
            $id=($jmlDesa+1);
            $this->setRawAttributes(array('id'=>$id), true);
        }else{
            $this->setRawAttributes(array(), true);
        }

        parent::__construct($attributes);
    }

    // Kolom yang bisa diisi secara massal (fillable)
    protected $fillable = [
        ''
    ];

    // Fungsi-fungsi, relasi, atau konfigurasi lain bisa ditambahkan sesuai kebutuhan
}
