<?php

namespace App\Services;

use App\Models\UserBankDetail;
use Exception;
use DB;

class UserBankDetailService
{
    public function index()
    {
        // return UserBankDetail::get();
    }

    public function store($bankData)
    {
        try {
            /*Create a record in the User Bank Detail table*/
            $data = UserBankDetail::create($bankData);
            return $data;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function show($id)
    {
        $bankdata = UserBankDetail::find($id);
        if(!empty($bankdata)){
            return $bankdata;
        }
        throw new \Exception("Record not found");
    }

    public function update($bankData, $userId)
    {
        $currentBank = UserBankDetail::findOrFail($userId);
        $currentBank->update($bankData);
        return $currentBank;
    }

    public function userBankDetails($userId){
        return UserBankDetail::where('user_id',$userId)->where('status','active')->get();
    }

}
