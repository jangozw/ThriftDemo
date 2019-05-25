<?php
/**
 * Created by PhpStorm.
 * User: jangozw
 * Date: 2019/5/22
 * Time: 下午3:47
 */

namespace App;

use App\Lib\ThriftCommonCallServiceProcessor;
use Thrift\Factory\TBinaryProtocolFactory;
use Thrift\Factory\TTransportFactory;
use Thrift\Server\TServerSocket;
use Thrift\Server\TSimpleServer;
use Thrift\TMultiplexedProcessor;
use Thrift\Transport\TBufferedTransport;

require_once APP_PATH . '/Lib/ThriftCommonCallService.php';
require_once APP_PATH . '/Lib/Types.php';


class Run
{
    public static function run()
    {
        try {

            $config = \App\Util::config('service', 'service');
            // 监听开始
            $transport = new TServerSocket($config['host'], $config['port']);


            $thriftProcessor = new ThriftCommonCallServiceProcessor(new \App\Server());
            $tFactory = new TTransportFactory();


            $pFactory = new TBinaryProtocolFactory(true, true);

            Log::info("服务启动成功", $config);

            $server = new TSimpleServer($thriftProcessor, $transport, $tFactory, $tFactory, $pFactory, $pFactory);
            $server->serve();

        } catch (\Exception $e) {
            Log::info("socket 连接异常: ".$e->getMessage());
        }
    }
}






