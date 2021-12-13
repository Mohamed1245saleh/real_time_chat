<?php
namespace App\Traits;

trait ResponseTrait
{

    public function errorResponse($e , $title)
    {
        return $this->res([], false, $e , $title);
    }

    public function successWithData($data ,  $message, $title )
    {
        return $this->res($data, true, $message, $title );
    }

    public function youCantAccess()
    {
        return $this->res([], false, 'you can not access this module');
    }

    public function res($data = [], $status = true, $message = '' , $title ='')
    {
        $data = [
            'payload' => $data,
            'status' => $status,
            'message' => $message,
            'title'   => $title
        ];
        return response()->json($data);
    }

}
