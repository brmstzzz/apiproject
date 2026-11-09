<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $posts = User::all();

        return new UserResource(true, 'List Data Users', $posts);
    }

public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'address' => 'required',
            'house_number' => 'required',
            'phone_number' => 'required',
            'city' => 'required',
            'roles' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $posts = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'house_number' => $request->house_number,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'roles' => $request->roles,
        ]);

        return new UserResource(true, 'Data User Berhasil Ditambahkan!', $posts);
    }

    public function destroy($id)
    {
        $posts = User::find($id);
        $posts->delete();

        return new UserResource(true, 'Data User Berhasil Dihapus!', null);
    }

    public function show($id)
    {
        $posts = User::find($id);

        return new UserResource(true, 'Detail Data Post', $posts);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'address' => 'required',
            'house_number' => 'required',
            'phone_number' => 'required',
            'city' => 'required',
            'roles' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $posts = User::find($id);
        $posts->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'house_number' => $request->house_number,
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'roles' => $request->roles,
        ]);

        return new UserResource(true, 'Data User Berhasil Diubah!', $posts);
    }
}