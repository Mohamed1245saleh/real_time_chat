<?php
namespace App\Traits;

trait ResponseTrait
{

    public function errorResponse($e)
    {
        return $this->res([], false, $e);
    }

    public function successWithData($data)
    {
        return $this->res($data, true, 'here what we found in ' . $this->module_name);
    }

    public function youCantAccess()
    {
        return $this->res([], false, 'you can not access this module');
    }

    public function res($data = [], $status = true, $message = '')
    {
        $data = [
            'payload' => $data,
            'status' => $status,
            'message' => $message
        ];
        return response()->json($data);
    }

}
