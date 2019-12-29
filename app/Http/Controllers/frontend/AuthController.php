<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\Frontend\LoginRequest;

class AuthController extends Controller
{
    protected $UserService;
    
    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $credentials['status'] = 'active';

        try {
            if (!Auth::guard('api')->attempt($credentials)) {
                return response()->json(['message' => 'Invalid credentials'], 400);
            }
                $response = Auth::user()->createToken();

                // $response['user'] = new UserResource($this->userService->getAuthUser());

                // //this updates last login of user record.
                // $this->userService->updateLastLogin($response['user']['user_id']);

                return response()->json($response, 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

}
