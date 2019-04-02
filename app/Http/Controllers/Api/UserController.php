<?php

namespace App\Http\Controllers\Api;

use DB;
use Auth;
use Response;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function users()
    {
        $users = User::orderBy('name')->paginate(15);

        return UserResource::collection($users);
    }

    public function user($id)
    {
        $user = User::where('id', $id)->first();

        // return $user;

        if ($user == null) {
            return Response::json([
                'status' => [
                    "code" => 400,
                    "description" => 'Bad Request'
                ]
            ], 400);
        }

        return (new UserResource($user))
            ->additional([
                'status' => [
                    "code" => 200,
                    "description" => 'OK'
                ]
            ])->response()->setStatusCode(200);
    }

    public function updateUser(Request $request, $iduser)
    {
        $request->validate([
            'name'  => 'max:120',
            'email' => 'email|unique:users,id,'.$iduser,
            'username' => 'unique:users,id,'.$iduser
        ]);

        $user = User::where('id',$iduser)->firstOrFail();

        
        if($user == null ){
            return Response::json([
                'status' => [
                    "code" => 404,
                    "description" => 'Data Not Found!'
                ]
            ], 404);
        }else{
                if($request->password != null){
                    $request->merge([
                        'password' => bcrypt($request->password)
                        ]);
        }

             $user->update($request->all());

             return (new UserResource($user))
            ->additional([
                'status' => [
                    "code" => 200,
                    "description" => 'OK'
                ]
            ])->response()->setStatusCode(200);
        }
    }

    public function logout($id)
    {
        $user = User::where('id', $id)->first();

        if ($user == null) {
            return Response::json([
                'status' => [
                    "code" => 400,
                    "description" => 'Bad Request'
                ]
            ], 400);
        } else {
            Auth::logout();
            return Response::json([
                'status' => [
                    "code" => 200,
                    "description" => 'OK'
                ]
            ], 200);
        }
    }

    public function login(Request $request)
    {
        if (!Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            return Response::json([
                'status' => [
                    "code" => 401,
                    "description" => 'Credential Is Wrong'
                ]
            ], 401);
        }

        $loggedUser = User::find(Auth::user()->id);

        return (new UserResource($loggedUser))
            ->additional([
                'status' => [
                    "code" => 202,
                    "description" => 'Accepted'
                ]
            ])->response()->setStatusCode(202);
    }

    public function register(Request $request)
    {
        // return $request->all();

        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3'
        ]);

        $newUser = User::create([
            'name' => $request->name,
            'username' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'api_token' => bcrypt($request->email),
        ]);

        return (new UserResource($newUser))
            ->additional([
                'status' => [
                    "code" => 201,
                    "description" => 'Created'
                ]
            ])->response()->setStatusCode(201);
    }
}
