<?php

namespace App;

use App\Lagu;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'album';

    public function lagus(){
        return $this->hasMany(Lagu::class, 'album_id');
    }
}
