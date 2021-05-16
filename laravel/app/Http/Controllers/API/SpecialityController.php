<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpecialityResource;
use App\Models\Speciality;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SpecialityController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return $this->sendResponse(SpecialityResource::collection(Speciality::all()), 'Return all specialities');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:specialities',
            'class' => 'required|integer|between:1,2',
            'branch_id' => 'required|exists:branches,id',
            'speciality' => 'required',
            'code' => 'required',
        ]);

        $speciality = Speciality::create($request->all());

        return $this->sendResponse($speciality, 'Create new speciality');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'class' => 'required|integer|between:1,2',
            'speciality' => 'required',
            'branch_id' => 'required|exists:branches,id',
            'code' => 'required',
        ]);

        $speciality = Speciality::findOrFail($id);

        $speciality->update($request->all());

        return $this->sendResponse($speciality, 'Update speciality');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $speciality = Speciality::findOrfail($id);

        return $this->sendResponse($speciality->delete(), 'Delete speciality');
    }
}
