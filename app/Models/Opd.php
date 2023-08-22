<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Opd extends Model
{
    protected $table = 'm_opd';
    public $timestamps = false;
    protected $primaryKey = 'id';
    public function __construct(array $attributes = array())
    {

        parent::__construct($attributes);
    }

    // Kolom yang bisa diisi secara massal (fillable)
    protected $fillable = [
        ''
    ];

    // Fungsi-fungsi, relasi, atau konfigurasi lain bisa ditambahkan sesuai kebutuhan
}
