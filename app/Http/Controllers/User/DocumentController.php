<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\User\DocumentResource;
use App\Http\Requests\User\DocumentRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\DocumentService;
use DB;

class DocumentController extends Controller
{
    protected $DocumentService;

    public function __construct(DocumentService $DocumentService)
    {
        $this->DocumentService = $DocumentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
    {
        $validated = $request->validated();
        $validated["user_id"] = \Auth::user()->id;
        DB::beginTransaction();
        try {
            $data = $this->DocumentService->store($validated);
            DB::commit();
            return response()->json(['message' => 'Document Added Successfully.'], 201);
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
    public function show($id)   // id means UserId
    {
        try{
            $documentdata = $this->DocumentService->show($id);
            return DocumentResource::collection($documentdata);
            // return response()->json(new DocumentResource($documentdata), 200);
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
    public function update(DocumentRequest $request, $id)
    {
        $validatedUser = $request->validated();
        DB::beginTransaction();
        try {
            $user = $this->DocumentService->update($validatedUser, $id);
            DB::commit();
            return response()->json(['message' => 'Approved Successfully'], 200);
        } catch(ModelNotFoundException $ex) {
            DB::rollback();
            return response()->json(['message' => 'Unable to find requested User!'], 404);
        } catch (\Exception $ex) {
            DB::rollback();
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
            $this->DocumentService->delete($id);

            return response()->json(['message' => 'Document has been deleted successfully!'], 200);
        } catch (ModelNotFoundException $ex) {
            return response()->json(['message' => 'Unable to find requested Document!'], 404);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function uploadFile(Request $request)
    {
        try {
            $assets = $this->DocumentService->uploadFile($request->all());
            return response()->json(['image' => $assets,'message'=>"image upload successfully"], 200);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

}
