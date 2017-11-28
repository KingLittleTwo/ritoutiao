<?php
/**
 * Created by PhpStorm.
 * User: 41662
 * Date: 2017/11/28
 * Time: 23:30
 */

namespace App\Http\Common;


class Message
{
    public static function jsonMsg($code, $data)
    {
        echo json_encode([
            'code' => $code,
            'data' => $data
        ]);
        die;
    }

}
