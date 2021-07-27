<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = '_berita';
    protected $guarded = ['id'];


    public function pny(){
        return $this->belongsTo(Kategori::class,'kategori_id');
    }
}
