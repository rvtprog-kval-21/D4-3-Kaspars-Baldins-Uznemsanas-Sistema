<?php

namespace App\Http\Resources;

use App\Models\Application;
use App\Models\Branch;
use App\Models\Speciality;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $date = Carbon::parse($this->created_at)->format('Y-m-d H:i:s.u');

        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'personal_code' => $this->personal_code,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'marks' => $this->marks,
            'relatives' => $this->relatives,
            'info' => $this->info,
            'group_id' => $this->group_id,
            'year' => $this->year,
            'home' => $this->home,
            'education' => $this->education,
            'education_code' => $this->education_code,
            'education_name' => $this->education_name,
            'branch_id' => $this->branch_id,
            'document1' => $this->document1,
            'document2' => $this->document2,
            'speciality_id' => $this->speciality ? $this->speciality->name : null,
            'secondary_speciality_id' => $this->secondary_speciality ? $this->secondary_speciality->name : null,
            'speciality' => $this->speciality ? $this->speciality->id : null,
            'secondary_speciality' => $this->secondary_speciality ? $this->secondary_speciality->id : null,
            'group_name' => isset($this->group->name) ? $this->group->name : null,
            'cipher' => $this->speciality ? $this->speciality->code.'-'.Application::where('speciality_id', $this->speciality_id)->
                whereRaw("TIMESTAMPDIFF(MICROSECOND, '{$date}', created_at) <= 0")->count() : null
        ];
    }
}
