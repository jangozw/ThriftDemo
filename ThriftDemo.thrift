# 实现功能： 客户端调用服务端通用thrift请求

# 指定生成什么语言，生成文件存放的目录

# php 的请使用 thrift --gen php:server (这样client 和 server 可以公用生成的文件)
namespace php stub
# thrift --gen go ThriftDemo.thrift -out ./server_project/go
namespace go stub
namespace py stub

// 返回结构体
struct Response {
    1: i32 code;    // 返回状态码
    2: string msg;  // 码字回提示语名
    3: string data; // 返回内容
}

// 服务体
service ThriftCommonCallService {
    // json 字符串参数  客户端请求方法, params 用json
    Response invokeMethod(1:string params)
}