<?php

namespace App\Traits;

trait ResponseTraits {

    public function sendResponse($status,$message,$response,$redirect_to)
    {
        return response()->json([
            "status" => $status,
            "message" => $message,
            "response" => $response,
            "redirect_to" => $redirect_to
        ]);
    }
}
