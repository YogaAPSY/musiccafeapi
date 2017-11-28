<?php

namespace App\Http\Controllers;

use App\Lagu;
use App\RequestQueue;
use Dingo\Api\Facade\response;
use Illuminate\Http\Request;
use Illuminate\Http\session;
use Illuminate\Support\Carbon;

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
    /*
    public function refresh(Request $request)
    {
        try {
        $music = RequestQueue::all();
        $musicRequest['playlist'] = $music->where('played', 0);
        $musicRequest['playlist']['request_available'] = false;

        if(count($musicRequest['playlist']) > 1)
        {
            echo "111";
            $musicRequest['playlist']['request_available'] = true;
            $musicRequest['playlist']['currently_playing'] = $request->input('currently_playing');
            if ($musicRequest['playlist']['currently_playing'] != $musicRequest['playlist'][0]->id)
            {
                echo "22";
                Session::put('currently_playing', $musicRequest['playlist'][0]->id);
                $musicRequest['playlist']['currently_playing'] = $musicRequest['playlist'][0]->id;
                var_dump($musicRequest['playlist']['currently_playing']);
                $music = Lagu::where('id', $musicRequest['playlist']['currently_playing']);
                $musicRequest['playlist']['src'] = $musicRequest->slug;
            } else {
                echo "333";
                RequestQueue::where($musicRequest['playlist'][0]->id)->update(['played' => '1']);
            }
        } else {
            echo "4444";
            $musicRequest['playlist']['currently_playing'] = false;
        }
        echo "555";
        echo json_encode($musicRequest['playlist']);
        } catch (\Exception $e){
            echo "666";
            return $this->response->errorInternal($e->getMessage());
        }
    }
*/
}
