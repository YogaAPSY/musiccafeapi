<?php
namespace App\Transformers;

use App\Album;
use League\Fractal\TransformerAbstract;

class AlbumTransformer extends TransformerAbstract
{
    public function transform(Album $album)
    {
        return [
            'id' => $album->lagus->id,
            'judul' => $album->lagus->judul,
            'artist' => $album->lagus->artist,
            'genre' => $album->lagus->genre,
            'tahun' => $album->lagus->tahun,
            'album' => $album->nama,
        ];
    }
}
