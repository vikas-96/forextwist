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
}
