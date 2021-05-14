<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;

class ApplicationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return $this->sendResponse(ApplicationResource::collection(Application::all()), 'Return all applications');

    }

    /**
     *
     * @return JsonResponse
     */
    public function today()
    {
        return $this->sendResponse(ApplicationResource::collection(Application::today()->get()), 'Return today applications');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
//        return $this->sendResponse(json_encode($request->marks), 'test');

        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'personal_code' => 'required',
            'home' => 'required',
            'telephone' => 'required',
            'email' => 'required',
            'education' => 'required',
            'education_code' => 'required|digits:8',
            'education_name' => 'required',
            'year' => 'required',
            'marks' => 'required',
            'relatives' => 'required',
            'speciality_id' => 'required|exists:specialities,id',
            'secondary_speciality_id' => 'required|exists:specialities,id',
            'info' => 'required',
            'document1' => 'required|file',
            'document2' => 'required|file',
        ]);

        $file1 = null;
        $file2 = null;

        if($request->file('document1')) {
            $file = $request->file('document1');
            $file->store('public/documents');
            $file1 = $file->hashName();
        }

        if($request->file('document2')) {
            $file = $request->file('document2');
            $file->store('public/documents');
            $file2 = $file->hashName();
        }

        $app = Application::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'personal_code' => $request->personal_code,
            'home' => $request->home,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'education' => $request->education,
            'education_code' => $request->education_code,
            'education_name' => $request->education_name,
            'year' => $request->year,
            'marks' => json_encode($request->marks),
            'relatives' => json_encode($request->relatives),
            'speciality_id' => $request->speciality_id,
            'secondary_speciality_id' => $request->secondary_speciality_id,
            'info' => json_encode($request->info),
            'document1' => $file1,
            'document2' => $file2,
        ]);


        $app->save();

        return $this->sendResponse($app, 'Application created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return $this->sendResponse(new ApplicationResource(Application::findOrFail($id)), 'Return application');
    }

    private function getLanguage($language) {
        switch($language) {
            case 'english':
                return 'angļu';
            case 'french':
                return 'franču';
            case 'german':
                return 'vācu';
        }
    }

    private function getAvgMark($marks) {
        $count = 0;
        $mark = 0;
        foreach($marks as $m) {
            if(floatval($m)) {
                $count++;
                $mark += floatval($m);
            }
        }

        return $mark/$count;
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $app = new ApplicationResource(Application::findOrFail($id));

        $marks = json_decode($app->marks);
        $marks->trans_language = $this->getLanguage($marks->language);
        $marks->avg = $this->getAvgMark($marks);

        $data = [
            'app' => $app,
            'marks' => $marks,
            'info' => json_decode($app->info),
            'relatives' => json_decode($app->relatives),
        ];

        $pdf = PDF::loadView('pdf_view', $data);
        return $pdf->stream('document.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $app = Application::findOrfail($id);

        $app->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'personal_code' => $request->personal_code,
            'home' => $request->home,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'education' => $request->education,
            'education_code' => $request->education_code,
            'education_name' => $request->education_name,
            'year' => $request->year,
            'marks' => json_encode($request->marks),
            'relatives' => json_encode($request->relatives),
            'speciality_id' => $request->speciality_id,
            'secondary_speciality_id' => $request->secondary_speciality_id,
            'info' => json_encode($request->info),
        ]);

        if($request->file('document1')) {
            $file = $request->file('document1');
            $file->store('public/documents');
            $app->document1 = $file->hashName();
        }

        if($request->file('document2')) {
            $file = $request->file('document2');
            $file->store('public/documents');
            $app->document1 = $file->hashName();
        }

        $app->save();

        return $this->sendResponse($app, 'Application updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $app = Application::findOrFail($id);

        return $this->sendResponse($app->delete(), 'Delete application');
    }
}
