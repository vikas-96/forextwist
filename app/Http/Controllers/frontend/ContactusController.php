<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contactus;
use App\Http\Resources\Frontend\ContactusResource;
use App\Http\Requests\Frontend\ContactusRequest;
use App\Services\ContactusService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;

class ContactusController extends Controller
{

    protected $ContactusService;

    public function __construct(ContactusService $ContactusService)
    {
        $this->ContactusService = $ContactusService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = $this->ContactusService->index();
            return ContactusResource::collection($data);
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
    public function store(ContactusRequest $request)
    {
        $validated = $request->validated();
        DB::beginTransaction();
        try {
            $patient = $this->ContactusService->store($validated);
            DB::commit();
            return response()->json(['message' => 'Contact Us Created'], 201);
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
