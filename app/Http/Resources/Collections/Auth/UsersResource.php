<?php

namespace App\Http\Resources\Collections\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
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
            'url' => url("/users/{$this->id}")
        ];
    }
}
