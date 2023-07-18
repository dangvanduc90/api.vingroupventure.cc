<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;

class CredentialController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'ip' => $request->get('ip'),
            'username' => $request->get('username'),
            'password' => $request->get('password'),
            'code' => $request->get('code'),
        ]);
//        header('Access-Control-Allow-Origin: *');
//        header('Access-Control-Allow-Credentials: false'); //Include cookies for cross domain request
//        header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT');
//        header('Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, Authorization, ' .
//            'X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control, X-OSC-Cross-Request');
//        header('Content-type: application/json');
//        echo json_encode([
//            'data' => $user,
//            'code' => 200,
//            'msg' => 'Success',
//        ]);
//        die;
        return response()->json([
            'data' => $user,
            'code' => 200,
            'msg' => 'Success',
        ]);
    }
}
