<?php
/**
 * Created by PhpStorm.
 * User: chams
 * Date: 27/01/18
 * Time: 15:32
 */

namespace App\Traits\API\Exceptions;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Laravel\Passport\Exceptions\MissingScopeException;

trait RestMissingScopeExceptionTrait
{
    /**
     * Check if the given exception is an Eloquent Model Not Found Exception.
     *
     * @param \Exception $exception
     * @return bool
     */
    protected function isMissingScopeException(\Exception $exception): bool
    {
        return $exception instanceof MissingScopeException;
    }

    /**
     * Return a json response for Eloquent Model Not Found Exception
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function missingScopeException(string $message = 'Unauthorized.',
                                              int $statusCode = JsonResponse::HTTP_UNAUTHORIZED): JsonResponse
    {
        return response()->json($message, $statusCode);
    }
}