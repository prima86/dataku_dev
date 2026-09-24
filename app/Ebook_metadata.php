<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ebook_metadata extends Model
{
    //
    protected $table = 'ebook_metadata';
    protected $fillable = ['id', 'judul_file', 'file', 'cover'];
    public $timestamps = false;

}
