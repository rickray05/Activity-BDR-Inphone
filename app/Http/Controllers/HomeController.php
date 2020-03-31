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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $guzzle = new Client();

        // $response = $guzzle->post('http://localhost:8000/oauth/token', [
        //     'form_params' => [
        //         'grant_type' => 'client_credentials',
        //         'client_id' => 'client-id',
        //         'client_secret' => 'client-secret',
        //         'scope' => 'your-scope',
        //     ],
        // ]);

        // echo json_decode((string) $response->getBody(), true);die;
        return view('home');
    }
}
