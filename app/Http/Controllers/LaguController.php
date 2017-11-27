<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Controllers\ApiController;
use App\Lagu;
use App\Transformers\AlbumTransformer;
use App\Transformers\LaguTransformer;
use Dingo\Api\Facade\response;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;

class LaguController extends ApiController
{
    public function login(Request $request)
    {
        $userId = $request->input('APP-ID');

        $appId = explode(',', config('audioplayer.app_client_id'));
        if(in_array($userId , $appId)) {
             return [
                "data" => [
                    "message" => "success",
                    "status_code" => 1,
                    "username" => $userId,
                ]
             ];
        } else {
            return $this->response->errorInternal();
        }
    }
    public function index()
    {
        try {
            $AllMusic = Lagu::with('albums')->get();

            return $this->response->collection($AllMusic, new LaguTransformer);
        } catch (\Exception $e) {
            return $this->response->errorInternal($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $Music = Lagu::findOrFail($id);
            return $this->response->item($Music, new LaguTransformer);
        } catch (\Exception $e) {
            return $this->response->errorInternal($e->getMessage());
        }
    }

    public function search($keyword)
    {
        try {
            /*
            $searchMusic = Album::with(['lagus' => function ($query) use ($keyword) {
                $query->orWhere('judul','LIKE', $keyword);
                $query->orWhere('artist','LIKE', $keyword);
            }])->orWhere('nama_album', $keyword)->get();

            return $this->response->collection($searchMusic, new AlbumTransformer);
            */

            $albumid = Album::where('nama_album', 'LIKE', $keyword)->first();
            if($albumid != NULL ){
            $searchMusic = Lagu::Where('judul','LIKE', $keyword)->orWhere('artist','LIKE', $keyword)->orWhere('album_id', $albumid->id)->get();

            } else {
                 $searchMusic = Lagu::Where('judul','LIKE', $keyword)->orWhere('artist','LIKE', $keyword)->get();
            }
            return $this->response->collection($searchMusic, new LaguTransformer);

        } catch (\Exception $e) {
            return $this->response->errorInternal($e->getMessage());
        }
    }
}
