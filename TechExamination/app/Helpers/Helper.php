<?php
namespace App\Helpers;

class Helper
{
    public static function getActors($key='')
    {
        $data = array(
            '1' => 'Teacher',
            '2' => 'Student'
        );

        return  (isset($key) && $key!='')?$data[$key]:$data;

    }
}