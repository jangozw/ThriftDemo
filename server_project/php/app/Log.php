<?php
/**
 * Created by PhpStorm.
 * User: jangozw
 * Date: 2019/5/22
 * Time: 下午3:49
 */

namespace App;


class Log
{
    public static function info($msg, $data=[])
    {
        self::write('INFO| '.$msg, $data);
    }

    public static function error($msg, $data=[])
    {
        self::write('ERROR| '.$msg, $data);
    }

    private static function write($msg, $data = [])
    {
        $file = self::logFile();
        $msg = date('Y-m-d H:i:s').' |'.$msg.': '. (!is_string($data) ? json_encode($data, JSON_UNESCAPED_UNICODE): $data);
        $msg = PHP_EOL.$msg;
        file_put_contents($file, $msg, FILE_APPEND);
        if (self::is_cli()) {
            echo $msg;
        }
    }
    public static function is_cli(){
        return preg_match("/cli/i", php_sapi_name()) ? true : false;
    }
    private static function logFile()
    {
        $f = LOG_PATH.'/'.'server-'.date('Ymd').'.log';
        return $f;
    }
}