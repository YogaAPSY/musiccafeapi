<?php

namespace App\Http\Controllers;

use App\Lagu;
use App\RequestQueue;
use Dingo\Api\Facade\response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Session;

class PlayerController extends Controller
{

    public function index()
    {
        try{
            return view('audio');
        } catch (\Exception $e){
            return $this->response->errorInternal($e->getMessage());
        }
    }

    public function request($id)
    {
        try {

            $requestLagu = Lagu::where('music_id',$id)->first();

            $requestQueue = new RequestQueue();
            $requestQueue->music_id = $requestLagu->music_id;
            $requestQueue->save();

            return [
                "data" => [
                    "message" => "success to add music to playlist",
                ]
            ];

        } catch (\Exception $e){
           return $e->getMessage();
        }
    }

    public function refresh(Request $request)
    {
        try {
        $music = RequestQueue::where('played', '0')->get();

        $musicRequest['playlist'] = $music;

        $musicRequest['playlist']['request_available'] = false;

        if(count($musicRequest['playlist']) > 1)
        {

            $musicRequest['playlist']['request_available'] = true;
            $musicRequest['playlist']['currently_playing'] = $request->input('currently_playing');
            if ($musicRequest['playlist']['currently_playing'] != $musicRequest['playlist'][0]->id)
            {
                Session::put('currently_playing', $musicRequest['playlist'][0]->id);
                $musicRequest['playlist']['currently_playing'] = $musicRequest['playlist'][0]->id;

                $music = Lagu::where('music_id', $musicRequest['playlist']['currently_playing'])->first();

                $musicRequest['playlist']['src'] = $music->slug;
            } else {
                RequestQueue::where('id', $musicRequest['playlist'][0]->id)->update(['played' => '1']);
            }
        } else {
            $musicRequest['playlist']['currently_playing'] = false;
        }
        echo json_encode($musicRequest['playlist']);
        } catch (\Exception $e){

            return $e->getMessage();
        }
    }
}
