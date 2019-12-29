<?php

namespace App\Services;

use App\Models\JoinNow;
use Exception;

class JoinNowService
{
    public function index()
    {
        return JoinNow::get();
    }

    public function store($joinNowData)
    {
        try {
            /*Create a record in the Join Now table*/
            $data = JoinNow::create($joinNowData);
            return $data;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
