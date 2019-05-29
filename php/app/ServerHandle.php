<?php

namespace App;

use App\Lib\Response;
use App\Lib\ThriftCommonCallServiceIf;

class ServerHandle implements ThriftCommonCallServiceIf
{
    public function invokeMethod($params)
    {
        $result = $this->parseRequest($params);
        Log::info("服务调用", ['request' => $params, 'result' => $result]);
        return $result;
    }

    private function parseRequest($params)
    {
        try {
            // 转换字符串 json
            $params = json_decode($params, true);
            $methodName = $params['MethodName'];
            $serviceName = $params['ServiceName'];
            $data = $params['Params'];
            // 自己可以实现转发的业务逻辑
            //...
            $result = $this->routeService($serviceName, $methodName, $data);
            return $this->success($result);
        } catch (\Exception $e) {
            Log::error('调用服务出错', ['params' => $params, 'error' => $e->getMessage().'|'.$e->getFile().':'.$e->getLine()]);
        }
    }


    /**
     * 分发业务处理
     * @param $service
     * @param $method
     * @param array $params
     * @return array
     */
    private function routeService($service, $method, $params=[])
    {
        return [
            'uid' => '123666',
            'name' => 'Django',
        ];
    }

    private function success($data = [])
    {
        $response = new Response();
        $response->code = 200;
        $response->msg = '测试server应答成功';
        $response->data = json_encode($data);
        return $response;
    }
}