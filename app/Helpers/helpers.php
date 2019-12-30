<?php

use App\Models\UserActivityDetail;
// use Request;
use Illuminate\Support\Facades\Auth;


if (!function_exists('log_activity')) {
    function log_activity($type, $comment)
    {
        try{
            $data = [
                'user_id' => Auth::user()->id,
                'ip_address' => \Request::ip(),
                'type' => $type,
                'comment' => $comment
            ];
            return UserActivityDetail::create($data);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
}