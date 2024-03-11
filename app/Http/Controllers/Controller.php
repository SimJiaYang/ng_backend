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

    /**
     * @param string $error
     * @param int $status
     * @param array $err
     * @return \Illuminate\Http\JsonResponse
     */
    function img_encode($data)
    {
        if (is_array($data)) {
            return implode("|", $data);
        } else {
            return $data;
        }
    }

    /**
     * @param string $data
     * @return array|string
     */
    function img_decode($data)
    {
        if ($data) {
            $data = explode("|", $data);

            if (count($data) > 1) {
                foreach ($data as &$d) {
                    $d = $this->image_parse($d);
                }
            } else {
                $data = implode("|", $data);
            }
        }
        return $data;
    }

    /**
     * @param string $url
     * @return string
     */
    function image_parse($url)
    {
        $parse = parse_url($url);
        if ($url) {
            if (isset($parse["host"])) {
                return $url;
            } else {
                return config("app.url") . "/" . $url;
            }
        }
        return $url;
    }
}
