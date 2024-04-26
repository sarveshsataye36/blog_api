<?php

namespace App\Traits;

trait HttpResponses{

    protected function success($status, $data = array(), $message='', $code=200)
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message
        ],$code);
    }

    protected function fails($status, $message='', $code=400)
    {
        return response()->json([
            'status' => $status,
            'message' => $message
        ],$code);
    }

    protected function validation($status, $error = array(), $message='', $code=422)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'errors' => $error
        ],$code);
    }
}