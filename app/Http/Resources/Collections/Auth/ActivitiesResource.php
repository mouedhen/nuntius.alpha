<?php

namespace App\Http\Resources\Collections\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivitiesResource extends JsonResource
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
            'description' => $this->description,
            'subject' => $this->subject,
            'subject_type' => $this->subject_type,
            'causer' => $this->causer,
            'date' => $this->updated_at,
            'properties' => $this->properties,
        ];
    }
}
