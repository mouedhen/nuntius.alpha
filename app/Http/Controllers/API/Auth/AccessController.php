<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\Auth\LoginAttemptRequest;
use App\Http\Resources\Auth\UserResource;
use App\Traits\API\Helpers\RestTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccessController extends Controller
{
    use RestTrait;

    public function guard()
    {
        return Auth::guard('api');
    }

    public function login(LoginAttemptRequest $request)
    {
        if (Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ])) {
            $user = Auth::user();
            $user['token'] = $user->createToken('goulelhom-app', $user->roles->toArray())->accessToken;
            return $this->jsonResponse(['data' => $user], JsonResponse::HTTP_OK);
        }
        return $this->jsonResponse('Unauthorized', JsonResponse::HTTP_UNAUTHORIZED);
    }

    public function logout(Request $request)
    {
        if (!$this->guard()->check()) {
            return $this->jsonResponse(
                'No active user session was found',
                JsonResponse::HTTP_UNAUTHORIZED
            );
        }

        $request->user('api')->token()->revoke();

        if (config('core.auth.unique_session')) {
            DB::table('oauth_access_tokens')
                ->where('user_id', '=', $request->user('api')->id)
                ->update(array('revoked' => true));
        }

        // $this->guard('web')->logout();

        Session::flush();
        Session::regenerate();

        return $this->jsonResponse('User was logged out.');
    }

    public function profile(Request $request)
    {
        return new UserResource($request->user('api'));
    }

    public function loginIndex()
    {
        $data = ['error' => 'UNAUTHORIZED', 'message' => 'you need to be logged in.'];
        return $this->jsonResponse($data, JsonResponse::HTTP_UNAUTHORIZED);
    }

    public function logoutIndex()
    {
        return $this->jsonResponse('NOT IMPLEMENTED', JsonResponse::HTTP_NOT_IMPLEMENTED);
    }
}
