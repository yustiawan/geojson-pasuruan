<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Penduduk extends Model
{
    protected $table = 'm_penduduk';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public function __construct(array $attributes = array())
    {

        $maxId = DB::table('m_penduduk')->max('id');
        $this->setRawAttributes(array('id'=>($maxId+1)), true);
        parent::__construct($attributes);
    }

    // Kolom yang bisa diisi secara massal (fillable)
    protected $fillable = [
        ''
    ];

    // Fungsi-fungsi, relasi, atau konfigurasi lain bisa ditambahkan sesuai kebutuhan
}
