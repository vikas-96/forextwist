<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\User\UserBankDetailResource;
use App\Http\Requests\User\UserBankDetailRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\UserBankDetailService;
use DB;

class UserBankDetailController extends Controller
{

    protected $UserBankDetailService;

    public function __construct(UserBankDetailService $UserBankDetailService)
    {
        $this->UserBankDetailService = $UserBankDetailService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // try {
        //     $data = $this->UserBankDetailService->index();
        //     return UserBankDetailResource::collection($data);
        // } catch (\Exception $ex) {
        //     return response()->json(['message' => $ex->getMessage()], 500);
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserBankDetailRequest $request)
    {
        $validated = $request->validated();
        $validated["user_id"] = \Auth::user()->id;
        DB::beginTransaction();
        try {
            $data = $this->UserBankDetailService->store($validated);
            DB::commit();
            return response()->json(['message' => 'Bank Account Added Successfully.'], 201);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $bankdata = $this->UserBankDetailService->show($id);
            return response()->json(new UserBankDetailResource($bankdata), 200);
        }catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserBankDetailRequest $request, $id)
    {
        $validatedUser = $request->validated();

        try {
            $user = $this->UserBankDetailService->update($validatedUser, $id);

            return response()->json(['message' => 'Bank Updated'], 200);
        } catch(ModelNotFoundException $ex) {
            return response()->json(['message' => 'Unable to find requested User!'], 404);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function userBankDetails($userId)
    {
        try {
            $data = $this->UserBankDetailService->userBankDetails($userId);
            return UserBankDetailResource::collection($data);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

}
