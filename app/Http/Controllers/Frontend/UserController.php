<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Resources\Frontend\UserResource;
use App\Http\Requests\Frontend\UserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;
use App\Events\UsersEmailVerification;

class UserController extends Controller
{

    protected $UserService;
    
    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->UserService->index();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validatedUser = $request->validated();
        DB::beginTransaction();
        try {
            $user = $this->UserService->store($validatedUser);
            event(new UsersEmailVerification($user));
            DB::commit();
            return response()->json(['message' => 'User Created'], 201);
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
            $userdata = $this->UserService->show($id);
            return response()->json(new userResource($userdata), 200);
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
    public function update(UserRequest $request, $id)
    {
        $validatedUser = $request->validated();

        try {
            $user = $this->UserService->update($validatedUser, $id);

            return response()->json(['message' => 'User Updated'], 200);
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
        try {
            // if(\Auth::user()->id == $id){
            //     return response()->json(['message' => 'Sorry you cannot delete yourself.'], 400);
            // }
            $deleteUser = $this->UserService->destroy($id);

            return response()->json(['message' => 'User has been deleted successfully!'], 200);
        } catch(ModelNotFoundException $ex) {
            return response()->json(['message' => 'Unable to find requested User!'], 404);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
}
