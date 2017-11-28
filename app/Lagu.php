<?php

namespace App;

use App\RequestQueue;
use Illuminate\Database\Eloquent\Model;

class Lagu extends Model
{
    protected $table = 'lagu';

    public function request(){
        return $this->belongsTo(RequestQueue::class, 'music_id');
    }
}
