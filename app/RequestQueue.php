<?php

namespace App;

use App\Lagu;
use Illuminate\Database\Eloquent\Model;

class RequestQueue extends Model
{
    protected $table ='request_queue';

    public function lagus(){
        return $this->hasMany(Lagu::class, 'music_id');
    }
}
