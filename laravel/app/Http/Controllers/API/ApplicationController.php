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
        $info = json_decode($app->info);
        $relatives = json_decode($app->relatives);

        $mpdf = new \Mpdf\Mpdf(['utf-8','A4','12','timesnewroman',20,15,20,25,10,10]);
        $mpdf->SetDisplayMode('fullpage');
        $html = "
            <div class='code'>Reģ. kods: <b>".$app->cipher."</b></div>
           <div class='header'><h2>Profesionālās izglītības kompetences centra</h2><h3>Rīgas Valsts tehnikuma direktorei</h3></div>
           <div class='author1'>".$app->name." ".$app->surname."</div>
           <div class='author2'><sup>(vārds uzvārds)</sup></div>
           <div  class='author1'><b>".$app->personal_code."</b></div>
           <div class='author2'><sup>(personas kods)</sup></div>
           <div class='author1'>".$app->home."</div>
           <div class='author2'><sup>(iela, mājas Nr. dzīvokļa Nr., ciems, pagasts, pilsēta, reģions, pasta kods)</sup></div>
           <div class='address'>".$app->telephone.", ".$app->email."</div>
           <div class='author2'><sup>(Tālruņa numurs, epasts)</sup></div>
           <div class='header'><h3><i>iesniegums</i></h3></div>
           <div>Lūdzu pieņemt mani specialitātē:  <b>".$app->speciality->speciality."</b> <b>".$app->speciality->name."</b></div>
           <div>Par sevi sniedzu šādas ziņas:</div>
           <div>Izglītība: <span class='info'>".$app->education.", ".$app->education_name.", ".$app->year.". gads</span></div>
           <div>Izglītība kods: <span class='info'>".$app->education_code."</span></div>
           <div><b>Galīgie vērtējumi:</b></div>
           <table>
           <tr><td class='subject'>Matemātika:</td>
           <td><b class='info2'>".$marks->math."</b></td
           ><td class='subject'>Latviešu valoda:</td>
           <td><b class='info2'>".$marks->latvian."</b></td>
           <td class='subject'>Ķīmija:</td>
           <td><b class='info2'>".$marks->chemistry."</b>
           ";

        if(property_exists($marks, 'informatics') && $marks->informatics != null) {
            $html .= "
               </td><td class='subject'>Informātika:</td>
                <td ><b class='info2' > ".$marks->informatics."</b ></td>";
        }

        $html .= "
        </tr>
           <tr><td class='subject'>1. svešvaloda (".$this->getLanguage($marks->language)."):</td><td><b  class='info2'>".$marks->language_mark."</b></td><td class='subject'>Fizika:</td><td><b class='info2'>".$marks->physics."</b></td></tr>
           </table>
           <div>Galīgo vērtējumu vidējā atzīme: <b>".$this->getAvgMark($marks)."</b> balles</div>
           <div><b>Radinieka dati (vārds, uzvārds, tālrunis, e-pasts):</b></div>
           ";

        if(property_exists($relatives, 'mom')) {
            $html .= "<div>Māte: <span class='info'>".$relatives->mom->name." ".$relatives->mom->surname." <span style='text-transform:lowercase'></span>".$relatives->mom->telephone." <span style='text-transform:lowercase'>".$relatives->mom->email."</span></span></div>";
        }

        if(property_exists($relatives, 'father')) {
            $html .= "<div>Tēvs:  <span class='info'>".$relatives->father->name." ".$relatives->father->surname." <span style='text-transform:lowercase'></span>".$relatives->father->telephone." <span style='text-transform:lowercase'>".$relatives->father->email."</span></span></div>";
        }

        if(property_exists($relatives, 'guardian')) {
            $html .= "<div>Aizbildnis: <span class='info'>".$relatives->guardian->name." ".$relatives->guardian->surname." <span style='text-transform:lowercase'></span><br/>".$relatives->guardian->telephone."<br/> <span style='text-transform:lowercase'>".$relatives->guardian->email."</span></span></div>";
        }
        $html .= "
             <div><b>Papildinformācija:</b></div>
             <table>
             <tr><td class='info1'>Dienesta viesnīca:</td><td class='info2'> <b>".($info->hostel == 'yes' ? 'Jā' : 'Nē')."</b></td><td class='info1'>Esmu bārenis jā/nē:&nbsp;	&nbsp;	&nbsp;</td><td class='info2'> <b>".($info->children == 'yes' ? 'Jā' : 'Nē')."</b></td></tr>
             <tr><td class='info1'>Esmu persona ar <br/>speciālām vajadzībām:</td><td class='info2'> <b>".($info->special == 'yes' ? 'Jā' : 'Nē')."</b>&nbsp;	&nbsp;	&nbsp;</td><td class='info1'>Esmu no daudzbērnu<br/> ģimenes jā/nē:</td><td class='info2'> <b>".($info->family == 'yes' ? 'Jā' : 'Nē')."</b></td></tr>
             </table><br/>
           <div>Saskaņā ar uzņemšanas noteikumiem, pievienoju šādus dokumentus:</div>
           <div>
                 <ul>
                     <li>izglītības dokuments (kopija);</li>
                     <li>izziņa par veselības stāvokli (veidlapa Nr. 027/u);</li>
                     <li>4 fotogrāfijas (3x4 cm)</li>
                     <li>citi:_______</li>
                 </ul>
             </div>
             <div class='date'>Datums: ".date("d.m.y")."</div>
             <div class='date'>Apliecinu, ka sniegtās ziņas ir patiesas: _______________<br/><sup>(paraksts)</sup></div>
        <style>
        .header{
    text-align: center;
    font-family: 'Times New Roman';
    font-size:12px;
}

.author1{
    text-align: center;
    text-decoration: underline;
    text-transform: uppercase;
    font-weight: bold;
    font-family: 'Times New Roman', Georgia, Serif;
    font-size:13px;
}

.author2{
    text-align: center;
    font-family: 'Times New Roman', Georgia, Serif;
    font-size:13px;

}

.address{
    text-align: center;
    text-decoration: underline;
    font-weight: bold;
    font-family: 'Times New Roman', Georgia, Serif;

}

.info{
    font-family: 'Times New Roman', Georgia, Serif;
    text-transform: uppercase;
    font-weight: bold;


}

i{
    font-family: 'Times New Roman', Georgia, Serif;

}

div, tr, td, span{
    font-family: 'Times New Roman', Georgia, Serif;
    font-size:13px;

}

.subject{
    text-align: right;

}

.code{
    text-align: right;

}

div{
    line-height: 160%;

}

.date{
    text-align: right;

}

.author2{
    line-height: 0;

}

.author4{
    text-align: center;
    font-weight: bold;

}


.table {
    border-collapse: collapse;
    margin: auto;
    width: 400px;
}


.table, .th, .td {
    border: 1px solid black;

}

.info1{

}

.info2{
    font-weight: bold;

}
</style>
        ";
        $mpdf->WriteHTML($html);

        return $mpdf->Output();
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
