<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Resources\Auth\ActivityResource;
use App\Http\Resources\Collections\Auth\ActivitiesResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ActivitiesResource::collection(
            Activity::orderBy('updated_at', 'desc')->paginate()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return ActivitiesResource
     */
    public function show($id)
    {
        return new ActivitiesResource(Activity::findOrFail($id));
    }
}
