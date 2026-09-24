<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Opd extends Model
{
    //
    protected $table = 'opd';
    protected $fillable = ['id', 'opd', 'acronym', 'alias', 'jenis_opd', 'ref_kecamatan', 'status_opd_active'];
    public $timestamps = false;

}
