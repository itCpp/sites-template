<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Crypt;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Шифрование всех ключей массива
     * 
     * @param array|object $data
     * @return array
     */
    public static function encrypt($data)
    {
        if (!$data or $data == "")
            return $data;

        if (!in_array(gettype($data), ['array', 'object']))
            return Crypt::encryptString($data);

        $response = [];

        foreach ($data as $key => $row) {
            $response[$key] = self::encrypt($row);
        }

        return $response;
    }
}
