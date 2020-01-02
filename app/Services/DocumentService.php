<?php

namespace App\Services;

use App\Models\Document;
use Exception;
use DB;

class DocumentService
{
    public function store($documentData)
    {
        try {
            /*Create a record in the User Bank Detail table*/
            $data = Document::create($documentData);
            return $data;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function show($id)
    {
        $bankdata = Document::where('user_id',$id)->get();
        if(!empty($bankdata)){
            return $bankdata;
        }
        throw new \Exception("Record not found");
    }

    public function update($documentData, $userId)
    {
        $currentDocument = Document::findOrFail($userId);
        $currentDocument->update($documentData);
        return $currentDocument;
    }

    public function delete($id)
    {
        $userDocument = Document::findOrFail($id);

        if ($userDocument->delete()) {
            return $userDocument;
        }

        throw new \Exception('Unable to delete Document');
    }

    public function uploadFile($data){
        try{
            $path = 'images';

            $file = $data['file'];
            
            $path = $file->store($path);
            
            if(!is_null($path)){
                $path = 'storage/images/'.$file->hashName();
                return $path;
            }
            return response()->json(['message' => 'Unable to upload file'], 500);
        }catch (\Exception $exception) {
            throw $exception;
        }
    }



}
