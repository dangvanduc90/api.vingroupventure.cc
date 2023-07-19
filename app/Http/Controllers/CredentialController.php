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
        return response()->json([
            'data' => $user,
            'code' => 200,
            'msg' => 'Success',
        ]);
    }
}
