<?php
/** @copyright Tuğran Demirel */

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

trait ResponderTrait
{
    /**
     * @param object|array|null $data
     * @param int $code
     * @return JsonResponse
     */
    protected function success(object|array|null $data, int $code = 200): JsonResponse
    {
        $response = [
            'status' => $code,
            'success' => true
        ];

        if ($data instanceof JsonResource) {
            return $data->additional(array_merge($data->additional, $response))->toResponse(request());
        }
        return response()->json(array_merge($response, ['data' => $data]), $code);
    }

    /**
     * @param string $message
     * @param int $code
     * @param $data
     * @return JsonResponse
     */
    protected function error(string $message, int $code = 500, $data = null): JsonResponse
    {

        $response = [
        ];
        return response()->json([
            'status' => $code,
            'success' => false,
            'error' => [
                'code' => $code,
                'message' => $message
            ],
            'data' => $data
        ], $code);
    }
}
