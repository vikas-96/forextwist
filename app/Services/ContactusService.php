<?php

namespace App\Services;

use App\Models\Contactus;
use Exception;
use DB;

class ContactusService
{
    public function index()
    {
        return Contactus::get();
    }

    public function store($contactusData)
    {
        try {
            /*Create a record in the Join Now table*/
            $data = Contactus::create($contactusData);
            return $data;
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
