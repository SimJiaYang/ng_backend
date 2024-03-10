<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param array $data
     * @param string $error
     * @param array $ext
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonResponse(
        $data = [],
        $error = '',
        $ext = [],
        $status = 200
    ) {
        return response([
            'success' => empty($error),
            'data'    => $data,
            'error'   => $error,
        ] + $ext, $status,);
    }

    /**
     * @param array $data
     * @param int $status
     * @param array $err
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data = [], $status = 200, $err = [])
    {
        return $this->jsonResponse($data, '', $err, $status);
    }

    /**
     * @param string $error
     * @param int $status
     * @param array $err
     * @return \Illuminate\Http\JsonResponse
     */
    public function fail(string $error, $status = 200, $err = [])
    {
        return $this->jsonResponse([], $error, $err, $status);
    }
}
