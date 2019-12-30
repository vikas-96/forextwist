<?php

namespace App\Http\Resources\Frontend;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        // return [
        //     'id'=> $this->id,
        //     'firstname'=> $this->firstname,
        //     "lastname"=> $this->lastname,
        //     "email"=> $this->email,
        //     "contact"=> $this->contact,
        //     "dob"=> $this->dob,
        //     "country"=> $this->getCountry->name,
        //     "state"=> $this->getState->name,
        //     "city"=> $this->city,
        //     "pincode"=> $this->pincode,
        //     "address"=> $this->address,
        //     "email_verified"=> $this->email_verified,
        //     "status"=> $this->status,
        //     "created_at"=> $this->created_at->format('d/m/Y H:i:s'),
        // ];
    }
}
