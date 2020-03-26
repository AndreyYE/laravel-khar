<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUser;
use App\Http\Requests\UpdateUser;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    public function store(CreateUser $request)
    {
        try{
            $password = ['password' => Hash::make($request->password)];
            $user = User::create(array_merge($request->except('password'), $password));
        }catch (\Exception $exception){
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
        return new UserResource($user);
    }

    public function show($id)
    {
        try{
            $user = User::where('user_id',$id)->first();
            if(!$user){
                throw new \Exception(__('messages.noUser'));
            }
        }catch (\Exception $exception)
        {
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
        return new UserResource(User::where('user_id',$id)->first());
    }

    public function update(UpdateUser $request, $id)
    {
        try{
            $password = $request->password?['password' => Hash::make($request->password)]:[];
            $user = User::where('user_id', $id)
                ->update(array_merge($request->except('password'), $password));
            if($user){
                $user = User::where('user_id',$id)->first();
            }else{
                throw new \Exception(__('messages.updateFailed'));
            }
        }catch (\Exception $exception){
            return response()->json([
                'error' => $exception->getMessage(),
            ],500);
        }
        return new UserResource($user);
    }

    public function destroy($id)
    {
        $user = User::where('user_id',$id)->first();
        if(User::where('user_id',$id)->delete()){
            return new UserResource($user);
        }
        return response()->json([
            'error' => __('messages.deleteFailed'),
        ],500);
    }
}
