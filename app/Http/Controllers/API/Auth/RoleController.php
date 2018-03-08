<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\Auth\Role;
use App\Traits\API\Helpers\RestTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\Resource;

class RoleController extends Controller
{
    use RestTrait;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return Resource::collection(
            Role::paginate()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Resource
     */
    public function show($id)
    {
        return new Resource(Role::findOrFail($id));
    }
}
