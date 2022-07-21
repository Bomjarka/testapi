<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseApiController extends Controller
{
    /**
     * @param array $result
     * @param string $message
     * @return JsonResponse
     */
    public function sendSuccessResponse(array $result, string $message): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $result
        ];

        return response()->json($response);
    }

    /**
     * @param $error
     * @param array $errorMessages
     * @param $code
     * @return JsonResponse
     */
    public function sendErrorResponse($error, array $errorMessages = [], int $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
