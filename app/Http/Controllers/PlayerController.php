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

            $requestLagu = Lagu::findOrFail($id);

            $requestQueue = new RequestQueue();
            $requestQueue->music_id = $requestLagu->id;
            $requestQueue->save();

        } catch (\Exception $e){
           return $e->getMessage();
        }
    }

    public function refresh(Request $request)
    {
        try {
        $music = RequestQueue::all();
        $musicRequest['playlist'] = $music->where('played', 0);
        $musicRequest['playlist']['request_available'] = false;

        if(count($musicRequest['playlist']) > 1)
        {
            $musicRequest['playlist']['request_available'] = true;
            $musicRequest['playlist']['currently_playing'] = $request->input('currently_playing');
            if ($musicRequest['playlist']['currently_playing'] != $musicRequest['playlist'][0]->id)
            {
                Session::put('currently_playing', $musicRequest['playlist'][0]->id);
                $musicRequest['playlist']['currently_playing'] = $musicRequest['playlist'][0]->id;
                $music = Lagu::where('id', $musicRequest['playlist']['currently_playing'])->first();
                $musicRequest['playlist']['src'] = $music->slug;
            } else {
                RequestQueue::where($musicRequest['playlist'][0]->id)->update(['played' => '1'])->get();
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
