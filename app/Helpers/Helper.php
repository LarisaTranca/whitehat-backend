<?php

namespace App\Helpers;

class Helper 
{
    /**
     * Build custom response object
     *
     * @param int       $status
     * @param string    $code
     * @param string    $key
     * @param           $object
     * @return array
     */
    public static function buildResponseObject(string $status, string $code, string $key, $object) : array
    {
        return [
            'status' => $status,
            'code' => $code,
            $key => $object,
        ];
    }

}