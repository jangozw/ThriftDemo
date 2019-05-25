<?php
/**
 * Created by PhpStorm.
 * User: jangozw
 * Date: 2019/5/22
 * Time: 下午3:55
 */
namespace App;

class Client {
    public static function test()
    {
        $params =[
            'orderId' => '123',
        ];
        $service = 'UserCenterService';
        $method = 'getUserInfo';
        CallServer::getUserInfo($params, $method, $service);
    }
}





