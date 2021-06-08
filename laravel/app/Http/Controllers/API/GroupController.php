<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->sendResponse(GroupResource::collection(Group::all()), 'Return all groups');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'name' => 'required|unique:groups',
            'speciality_id' => 'required|exists:specialities,id',
        ]);

        $group = Group::create($request->all());

        return $this->sendResponse($group, 'Create group');
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'branch_id' => 'required',
            'name' => 'required',
            'speciality_id' => 'required|exists:specialities,id',
        ]);

        $group = Group::findOrFail($id);

        $group->update($request->all());

        return $this->sendResponse($group, 'Update group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $group = Group::findOrFail($id);

        return $this->sendResponse($group->delete(), 'Delete group');
    }
}
