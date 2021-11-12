<?php

namespace APIP2WEB2\utils;

class ValidationUtils
{
    public static function validarRequest($request, $nombre): bool
    {
        if (!property_exists($request, $nombre)) {
            http_response_code(400);
            echo "$nombre es null";
            return false;
        }
        return true;
    }
}