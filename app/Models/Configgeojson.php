<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Configgeojson extends Model
{
    // Nama tabel di database (opsional, jika tidak ditentukan, Laravel akan menggunakan huruf kecil dan bentuk jamak dari nama kelas)
    protected $table = 'm_config_shape_kecamatan';
    public $timestamps = false;

    protected $primaryKey = 'id';
    public function __construct(array $attributes = array())
    {
        $maxId = DB::table('m_config_shape_kecamatan')->max('id');
        $this->setRawAttributes(array('id'=>($maxId+1)), true);
        parent::__construct($attributes);
    }

    // Kolom yang bisa diisi secara massal (fillable)
    protected $fillable = [
        ''
    ];

    // Fungsi-fungsi, relasi, atau konfigurasi lain bisa ditambahkan sesuai kebutuhan
}
