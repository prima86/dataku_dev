<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Elibrary extends Model
{
    //
    protected $table = 'elibrary';
    protected $fillable = ['id', 'judul_file', 'file_pdf', 'cover'];
    public $timestamps = false;

}
