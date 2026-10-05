<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;                    
use App\Http\Resources\UserResource;     
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return new UserResource(true, 'List Data Users', $users);
    }
}