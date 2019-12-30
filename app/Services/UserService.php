<?php

namespace App\Services;

use App\Models\User;
use Exception;

class UserService
{
    public function index()
    {
        return User::get();
    }

    public function store($userData)
    {
        try {
            /*Create a record in the users table*/
            $user = User::create($userData);
            return $user;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function show($id)
    {
        $userdata = User::find($id);
        if(!empty($userdata)){
            return $userdata;
        }
        throw new \Exception("Record not found");
    }

    public function update($UserData, $UserId)
    {
        $currentUser = User::findOrFail($UserId);
        $currentUser->update($UserData);
        return $currentUser;
    }

    public function destroy($id)
    {
        $User = User::findOrFail($id);

        if ($User->delete()) {
            return $User;
        }
    }

    /**
     * Get user details of specified email.
     *
     *@param  [string] email
     *
     *@return [json]   object
     */
    public function getByEmail($email)
    {
        return User::where('email', $email)->firstOrFail();
    }

    /**
     * re-verify for specified email and token.
     *
     *@param  [string] email
     *@param  [string] token
     *
     *@return [json]   object
     */
    public function verifyToken($email, $token)
    {
        // return PasswordReset::where('token', $token)->where('email', $email)->firstOrFail();
    }

    /**
     * Get Password Reset for specified email and toke.
     *
     *@param  [array] verified credentials
     *@param  [object] user details
     *
     *@return [json]   object
     */
    public function setPasswordAndStatus($credentials, $user)
    {
        try {
            $user->password = $credentials['password'];
            $user->save();

            return $user;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     *Set changed password of user.
     *
     *@param  [string] credentials
     *@param  [string] user details
     *
     *@return [json]   object
     */
    public function setChangedPassword($credentials, $user)
    {
        try {
            $user->password = $credentials['password'];
            $user->save();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
