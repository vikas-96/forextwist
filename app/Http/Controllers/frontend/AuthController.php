<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\Frontend\LoginRequest;
use App\Http\Requests\Frontend\ForgetPasswordRequest;
use App\Http\Requests\Frontend\ResetPasswordRequest;
use App\Http\Requests\Frontend\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;
use App\Events\UsersResetPassword;

class AuthController extends Controller
{
    /*Initialize service class instance*/
    protected $UserService;
    
    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }

    /**
     *Login to system.
     *
     * @param  [string] email
     * @param  [string] password
     *
     * @return [string] message
     * @return [json]   object
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $credentials['status'] = 'active';
        $credentials['email_verified'] = 'yes';

        try {
            if (!Auth::attempt($credentials)) {
                return response()->json(['message' => 'Invalid credentials'], 400);
            }
                $response = Auth::user()->createToken('authToken')->accessToken;

                // this updates last login of user record.
                log_activity('Login', 'Successfully login');

                return response()->json(['access_token'=>$response], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /* Logout from system */
    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();

            return response()->json([], 204);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     *forget password.
     *
     * @param  [string] email
     *
     * @return [string] message
     * @return [json]   object
     */
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $credentials = $request->validated();

        try {
            $userDetails = $this->UserService->getByEmail($credentials['email']);

            if ($userDetails->status == "inactive") {
                return response()->json([
                    'message' => 'You are not an active user, kindly contact forex twist.',
                ], 400);
            }

            if ($userDetails->email_verified == "no") {
                return response()->json([
                    'message' => 'You are not an verified user, kindly contact forex twist.',
                ], 400);
            }

            if (!empty($userDetails->email)) {
                event(new UsersResetPassword($userDetails));

                return response()->json([
                    'message' => 'We have e-mailed your password reset link!',
                ]);
            }
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => "We can't find a user with that e-mail address.",
            ], 404);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * reset password.
     *
     * @param  [string] email
     * @param  [string] token
     * @param  [string] password
     * @param  [string] password_confirmation
     *
     * @return [json] object
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $credentials = $request->validated();

        try {
            $passwordReset = $this->UserService->verifyToken($credentials['email'], $credentials['token']);

            if (Carbon::parse($passwordReset->updated_at)->addMinutes(config('auth.passwords.users.expire', 60))->isPast()) {
                $passwordReset->delete();

                return response()->json([
                    'message' => 'This reset password token is invalid.',
                ], 404);
            }

            $userDetails = $this->UserService->getByEmail($credentials['email']);

            $user = $this->UserService->setPasswordAndStatus($credentials, $userDetails);

            if ($user->status == 1) {
                // event(new UsersResetPasswordSuccess($user));

                return response()->json([
                    'message' => 'Password has been changed successfully.',
                ], 200);
            }
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'We cant find a user with that e-mail address.',
            ], 404);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Change password.
     *
     * @param  [string] current_password
     * @param  [string] password
     * @param  [string] password_confirmation
     *
     * @return [json] object
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $credentials = $request->validated();

        try {
            $user = Auth::user();

            if (!Hash::check($credentials['current_password'], $user->password)) {
                return response()->json([
                    'message' => 'Current password does not match.',
                ], 400);
            }

            $this->UserService->setChangedPassword($credentials, $user);

            return response()->json([
                'message' => 'Password has been changed successfully.',
            ], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }
    }

}
