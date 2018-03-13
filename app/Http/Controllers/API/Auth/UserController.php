<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\Auth\UserStoreRequest;
use App\Http\Resources\Auth\UserResource;
use App\Http\Resources\Collections\Auth\UsersResource;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Traits\API\Helpers\RestTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    use RestTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return UsersResource::collection(
            User::paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request)
    {
        $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password'))
            ]
        );

        $role = Role::find($request->get('role'));
        $user->attachRole($role);

        $data = new UserResource($user);
        return $this->jsonResponse(['data' => $data], JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return UserResource
     */
    public function show($id)
    {
        if ($id === '0') {
            $user = new User();
            $user->id = 0;
            $user->name = 'anonymous';
            $user->email = 'anonymous';
            $user->actions = Activity::where('causer_id', '=', null)->get();
            return new UserResource($user);
        }
        return new UserResource(User::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return UserResource
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        if($request->get('role')) {
            $user->roles()->detach();
            $role = Role::find($request->get('role'));
            $user->attachRole($role);
        }

        if ($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
            $user->save();
        }

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        User::findOrFail($id)
            ->delete();

        return $this->jsonResponse(
            'record deleted successfully',
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}
