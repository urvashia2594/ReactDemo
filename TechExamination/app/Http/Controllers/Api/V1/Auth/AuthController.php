<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\User;
use  App\Http\Requests\Admin\User\StoreRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use  App\Http\Requests\Api\Auth\LoginRequest;
use  App\Jobs\RegisterUserJob;

class AuthController extends Controller
{
    public function register(StoreRequest $request)
    {
        $data = $this->fillableFields($request);
        $user = new User();
        $user->fill($data);
        $user->save();

        dispatch(new RegisterUserJob($user));

        $response['token'] =  $user->createToken('MyApp')->accessToken;
        $response['user'] =  $user;

        return response()->json([
            'success'=>1,
            'data'=> $response
        ],200);


    }

    public function login(LoginRequest $request)
    {
        $data = $request->only('email', 'password');
        $user = User::where('email', $data['email'])->where('actor', 2)->first();
        if (Hash::check($data['password'], $user->password)) {
            Auth::attempt($data);
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['user'] =  $user;
            return response()->json([
                'success' => 1,
                'data' => $success
            ], 200);
        }else{
            return response()->json([
                'success' => 0,
                'error' => 'Unauthorised'
            ], 401);
        }
    }

    private function fillableFields($request)
    {
        $data = $request->only('email', 'name');
        if ($request->has('password') && $request->get('password') != '') {
            $data['password'] = bcrypt($request->get('password'));
        }
        return $data;
    }
}
