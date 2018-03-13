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
        $role = '';
        if($this->hasRole('employee')) $role = 'employee';
        if($this->hasRole('supervisor')) $role = 'supervisor';
        if($this->hasRole('manager')) $role = 'manager';
        if($this->hasRole('admin')) $role = 'admin';

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'roles' => $this->roles,
            'role' => $role,
            'activity' => ActivitiesResource::collection($this->activity),
            'actions' => ActivitiesResource::collection($this->actions)
        ];
    }
}
