<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JoinNow;
use App\Http\Resources\Frontend\JoinNowResource;
use App\Http\Requests\Frontend\JoinNowRequest;
use App\Services\JoinNowService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;

class JoinNowController extends Controller
{

    protected $JoinNowService;

    public function __construct(JoinNowService $JoinNowService)
    {
        $this->JoinNowService = $JoinNowService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = $this->JoinNowService->index();
            return JoinNowResource::collection($data);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JoinNowRequest $request)
    {
        $validated = $request->validated();
        DB::beginTransaction();
        try {
            $patient = $this->JoinNowService->store($validated);
            DB::commit();
            return response()->json(['message' => 'Join Now Created'], 201);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
