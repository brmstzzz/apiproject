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
            'name'         => 'required',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|min:6',
            'address'      => 'required',
            'phone_number' => 'required',
            'city'         => 'required',
            'roles'        => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $posts = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => bcrypt($request->password),
            'address'      => $request->address,
            'phone_number' => $request->phone_number,
            'city'         => $request->city,
            'roles'        => $request->roles,
        ]);

        return new UserResource(true, 'Data User Berhasil Ditambahkan!', $posts);
    }

    public function show($id)
    {
        $posts = User::find($id);

        if (!$posts) {
            return response()->json([
                'success' => false,
                'message' => 'Data User Tidak Ditemukan!',
                'data'    => null
            ], 404);
        }

        return new UserResource(true, 'Detail Data User', $posts);
    }

    public function update(Request $request, $id)
    {
        $posts = User::find($id);

        if (!$posts) {
            return response()->json([
                'success' => false,
                'message' => 'Data User Tidak Ditemukan!',
                'data'    => null
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'email'        => 'required|email|unique:users,email,' . $id,
            'password'     => 'nullable|min:6',
            'address'      => 'required',
            'phone_number' => 'required',
            'city'         => 'required',
            'roles'        => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $updateData = [
            'name'         => $request->name,
            'email'        => $request->email,
            'address'      => $request->address,
            'phone_number' => $request->phone_number,
            'city'         => $request->city,
            'roles'        => $request->roles,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
        }

        $posts->update($updateData);

        return new UserResource(true, 'Data User Berhasil Diubah!', $posts);
    }

    public function destroy($id)
    {
        $posts = User::find($id);

        if (!$posts) {
            return response()->json([
                'success' => false,
                'message' => 'Data User Tidak Ditemukan!',
                'data'    => null
            ], 404);
        }

        $posts->delete();

        return new UserResource(true, 'Data User Berhasil Dihapus!', null);
    }
}