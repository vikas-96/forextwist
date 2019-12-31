<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Http\Resources\Frontend\StateResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StateController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = State::findOrFail($id);
            return response()->json(new StateResource($data),200);
        } catch (ModelNotFoundException $ex) {
            return response()->json(['message' => 'Unable to find requested State!'], 404);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    public function getStateBasedOnCountry($country_id){
        try {
            $data = State::where('country_id',$country_id)->get();
            return StateResource::collection($data);
        } catch (ModelNotFoundException $ex) {
            return response()->json(['message' => 'Unable to find requested State!'], 404);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

}
