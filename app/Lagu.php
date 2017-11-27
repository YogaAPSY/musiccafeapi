<?php

namespace App;

use App\Album;
use Illuminate\Database\Eloquent\Model;

class Lagu extends Model
{
    protected $table = 'lagu';

    public function albums(){
        return $this->belongsTo(Album::class,'album_id');
    }
}
