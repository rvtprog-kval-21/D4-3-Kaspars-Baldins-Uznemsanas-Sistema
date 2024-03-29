<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'speciality' => $this->speciality ? $this->speciality->speciality  : null,
            'qual' => $this->speciality ? $this->speciality->name : null,
            'branch' => $this->speciality->branch->name,
        ];
    }
}
