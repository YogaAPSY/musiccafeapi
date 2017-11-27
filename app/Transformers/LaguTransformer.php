<?php
namespace App\Transformers;

use App\Lagu;
use League\Fractal\TransformerAbstract;

class LaguTransformer extends TransformerAbstract
{
    public function transform(Lagu $lagu)
    {
        return [
            'id' => $lagu->id,
            'judul' => $lagu->judul,
            'artist' => $lagu->artist,
            'genre' => $lagu->genre,
            'tahun' => $lagu->tahun,
            'album' => $lagu->albums->nama_album,
        ];
    }
}
