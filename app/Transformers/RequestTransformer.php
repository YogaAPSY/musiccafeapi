<?php
namespace App\Transformers;

use App\RequestQueue;
use League\Fractal\TransformerAbstract;

class RequestTransformer extends TransformerAbstract
{
    public function transform(RequestQueue $lagu)
    {
        return [
            'id' => $lagu->lagus->music_id,
            'judul' => $lagu->lagus->judul,
            'artist' => $lagu->lagus->artist,
            'genre' => $lagu->lagus->genre,
            'tahun' => $lagu->lagus->tahun,
            'album' => $lagu->lagus->album,
        ];
    }
}
