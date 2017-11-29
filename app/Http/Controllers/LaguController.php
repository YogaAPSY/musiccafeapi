<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Lagu;
use App\RequestQueue;
use App\Transformers\AlbumTransformer;
use App\Transformers\LaguTransformer;
use App\Transformers\RequestTransformer;
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
            return $this->response->errorInternal($e->getMessage());
        }
    }
    public function index()
    {
        try {
            $AllMusic = Lagu::all();

            return $this->response->collection($AllMusic, new LaguTransformer);
        } catch (\Exception $e) {
            return $this->response->errorInternal($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $Music = Lagu::where('music_id',$id)->first();
            return $this->response->item($Music, new LaguTransformer);
        } catch (\Exception $e) {
            return $this->response->errorInternal($e->getMessage());
        }
    }

    public function search($keyword)
    {
        try {
            $searchMusic = Lagu::Where('judul','LIKE', '%' .$keyword. '%')
            ->orWhere('artist','LIKE', '%' .$keyword. '%')->orWhere('album', 'LIKE', '%' .$keyword. '%')->get();
            return $this->response->collection($searchMusic, new LaguTransformer);

        } catch (\Exception $e) {
            return $this->response->errorInternal($e->getMessage());
        }
    }

    public function list()
    {
        try {
            $list = RequestQueue::where('played', '0')->with('lagus')->get();

            return $this->response->collection($list, new RequestTransformer);
        } catch (\Exception $e) {
            return $this->response->errorInternal($e->getMessage());
        }
    }
}
