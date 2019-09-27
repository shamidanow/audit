<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $client = new Client();
        /*$res = $client->request('GET', 'https://api-sandbox.direct.yandex.com/json/v5/campaigns'
            , [
            'Authorization' => [
                'Bearer' => auth()->user()->api_id
            ]
        ]);
        $client->addHeader('Authorization', 'Bearer '.auth()->user()->api_id.'');*/
        
        $res = $client->get("https://api-sandbox.direct.yandex.com/json/v5/campaigns", [
            'headers' => [
                'Authorization' => 'Bearer '.auth()->user()->api_id
            ],// здесь можно передать заголовки
            'json' => [], // здесь можно передать тело запроса
            'exceptions' =>false // эта опция отключит автоматическое выбрасывание исключений guzzle-ом
        ]);
        
        $data = json_decode($res->getBody());
        dd($data);
        //return view('home');
    }
}
