<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationForgetRequest;
use App\Http\Requests\AuthenticationLoginRequest;
use App\Http\Requests\AuthenticationRegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthenticationController extends Controller
{
    protected string $tokenName;
    protected array $response = [
        'success' => false,
        'token' => null
    ];

    public function __construct(Request $request)
    {
        $this->tokenName = $request->get('token_name', 'default');
    }

    public function login(AuthenticationLoginRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json($this->response, 401);
        }

        $user = User::with(['abilities'])->whereEmail($request->only('email'))->first();

        return response()->json([
            'success' => true,
            'token' => $user->createToken($this->tokenName, $user->abilities()->pluck('ability')->toArray())->plainTextToken
        ]);
    }

    public function register(AuthenticationRegisterRequest $request)
    {
        try {
            $requests = $request->validated();
            $requests['password'] = Hash::make($request['password']);
            $user = User::create($requests);
            $status = 201;
            $this->response = [
                'success' => true,
                'token' => $user->createToken($this->tokenName)->plainTextToken
            ];
        } catch (\Exception $exception) {
            $status = 500;
        }

        return response()->json($this->response, $status);
    }

    public function forget(AuthenticationForgetRequest $request)
    {
        if (Password::sendResetLink($request->only('email')) === Password::RESET_LINK_SENT) {
            return response()->json(null, 200);
        }

        return response()->json(null, 500);
    }
}
