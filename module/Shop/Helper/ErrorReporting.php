<?php

namespace Shop\Helper;

class ErrorReporting
{
    /**
     * @return string
     */
    public function get404()
    {
        header("HTTP/1.0 404 Not Found");
        return json_encode(
            [
                "error" => [
                    "type" => "invalid_request_error",
                    "message" => "Unable to resolve the request \"api info\"."
                ]
            ]
        );
    }

    /**
     * @param null $method
     * @return string
     */
    public function methodIsNotAllowed($method = null)
    {
        header("HTTP/1.0 405 Method Not Allowed");
        return json_encode(
            [
                "error" => [
                    "type" => "invalid_request_error",
                    "message" => "The requested resource does not support http method . " . $method
                ]
            ]
        );
    }

    public function actionIsNotAllowed($action = null)
    {
        header("HTTP/1.0 400 Action Not Allowed");
        return json_encode(
            [
                "error" => [
                    "type" => "invalid_request_error",
                    "message" => "The requested resource does not support route action . " . $action
                ]
            ]
        );
    }

    /**
     * @return string
     */
    public function invalidParams()
    {
        header("HTTP/1.0 400 Parameters error");
        return json_encode(
            [
                "error" => [
                    "params" => [
                        "code" => "required",
                        "message" =>"Product cannot be blank.",
                        "name" => "product_id"
                    ],
                    [
                        "code" => "required",
                        "message" => "Quantity cannot be blank.",
                        "name" => "quantity"
                    ],

                    "type" => "invalid_param_error",
                    "message" => "Invalid data parameters"
                ]
            ]
        );
    }
}