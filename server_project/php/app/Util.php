<?php
/**
 * Created by PhpStorm.
 * User: jangozw
 * Date: 2019/5/22
 * Time: 下午7:52
 */

namespace App;


class Util
{
    public static function config($file, $key='')
    {
        $config = include APP_PATH."/../conf/{$file}.php";
        if (isset($config[$key])) {
            return $config[$key];
        }
        return $config;
    }
}