<?php

namespace App\Http\Controllers\API;

use App\Models\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends BaseController
{
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
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        return $this->sendResponse(json_decode($request->marks), 'test');

        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'personal_code' => 'required',
            'home' => 'required',
            'telephone' => 'required',
            'education' => 'required',
            'education_code' => 'required|digits:8',
            'education_name' => 'required',
            'year' => 'required',
            'marks' => 'required|json',
            'relatives' => 'required|json',
            'speciality' => 'required|json',
            'info' => 'required|json',
            'document1' => 'required|file',
            'document2' => 'required|file',
        ]);

        $app = Application::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'personal_code' => $request->personal_code,
            'home' => $request->home,
            'telephone' => $request->telephone,
            'education' => $request->education,
            'education_code' => $request->education_code,
            'education_name' => $request->education_name,
            'year' => $request->year,
            'marks' => $request->marks,
            'relatives' => $request->relatives,
            'speciality' => $request->speciality,
            'info' => $request->info,
        ]);

        if($request->file('document1')) {
            $file = $request->file('document1');
            $file->store('public/documents');
            $app->document1 = $file->hashName();
        }

        if($request->file('document2')) {
            $file = $request->file('document2');
            $file->store('public/documents');
            $app->document2 = $file->hashName();
        }

        $app->save();

        return $this->sendResponse($app, 'Application created.');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
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
