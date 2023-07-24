<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Kecamatan extends Model
{
    protected $table = 'm_kecamatan';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public function __construct(array $attributes = array())
    {
        $jmlKecamatan=DB::table('m_kecamatan')->select(DB::raw('MAX(CAST(id AS SIGNED)) AS max_id'))->value('max_id');
        $this->setRawAttributes(array('id'=>($jmlKecamatan+1)), true);
        parent::__construct($attributes);
    }

    // Kolom yang bisa diisi secara massal (fillable)
    protected $fillable = [
        ''
    ];

    // Fungsi-fungsi, relasi, atau konfigurasi lain bisa ditambahkan sesuai kebutuhan
}
