<?php
/**
 * Created by PhpStorm.
 * User: chams
 * Date: 27/01/18
 * Time: 15:32
 */

namespace App\Traits\API\Exceptions;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait RestNotFoundExceptionTrait
{
    /**
     * Check if the given exception is an Eloquent Model Not Found Exception.
     *
     * @param \Exception $exception
     * @return bool
     */
    protected function isNotFoundException(\Exception $exception): bool
    {
        return $exception instanceof NotFoundHttpException;
    }

    /**
     * Return a json response for Eloquent Model Not Found Exception
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function notFoundException(string $message = '404 NOT FOUND.',
                                              int $statusCode = JsonResponse::HTTP_NOT_FOUND): JsonResponse
    {
        return response()->json($message, $statusCode);
    }
}