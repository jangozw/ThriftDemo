<?php
/**
 * Created by PhpStorm.
 * User: jangozw
 * Date: 2019/5/22
 * Time: 下午3:56
 */
namespace App;

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Protocol\TMultiplexedProtocol;
use Thrift\Transport\TBufferedTransport;
use Thrift\Transport\TSocket;
use App\Lib\ThriftCommonCallServiceClient;

require_once APP_PATH . '/Lib/ThriftCommonCallService.php';
require_once APP_PATH . '/Lib/Types.php';

/**
 * Class CallServer
 * @package App
 *
 *
 */
class CallServer
{
    // 保存对象实例化
    private static $instance;

    // 配置文件
    private $config = [];

    //本类可以调用的方法
    private static $methods = [
        'getUserInfo',
        'getOrderInfo',
    ];

    private function __construct()
    {
        $config = Util::config('service', 'service');
        $this->config = [
            'host' => $config['host'],
            'port' => $config['port'],
        ];

    }

    /**
     * 连接服务
     * @param string $name  调用的方法名
     * @param array $args   1、参数数组 2、具体哪个方法名  3、所属的 Service 名称
     * @return bool
     */
    public static function __callStatic($name, $args)
    {
        if (!in_array($name, self::$methods)) {
            Log::info("调用的方法不存在 {$name}");
            return false;
        }
        if (! self::$instance) {
            self::$instance = new self();
        }
        return self::$instance->invoke($args);
    }

    private function invoke($args)
    {
        try {
            $socket = new TSocket($this->config['host'], $this->config['port']);
            $socket->setRecvTimeout(50000);
            $socket->setDebug(true);
            $transport = new TBufferedTransport($socket, 1024, 1024);
            $protocol = new TBinaryProtocol($transport);
            $thriftProtocol = new TMultiplexedProtocol($protocol, 'thriftCommonCallService');
            $client = new ThriftCommonCallServiceClient($thriftProtocol);
            $transport->open();
            // 拼装参数与类型
            $data = [
                'params' => $args[0],
                'methodName' => $args[1],
                'serviceName' => $args[2]
            ];
            $result = $client->invokeMethod(json_encode($data));
            //$result->data = json_decode($result->data, true);
            $transport->close();
            Log::info("调用服务-请求", $data);
            Log::info("调用服务-结果", $result);
            return $result;
        } catch (\Exception $Te) {
            Log::info('服务连接失败 ', ['host' => $this->config, 'methodName' => $args[1], 'content' => $Te->getMessage()]);
        }
    }
}