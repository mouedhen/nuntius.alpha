<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\Collections\Auth\ActivitiesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'roles' => $this->roles,
            'activity' => ActivitiesResource::collection($this->activity),
            'actions' => ActivitiesResource::collection($this->actions)
        ];
    }
}
