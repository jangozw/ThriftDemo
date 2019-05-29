# Thrift 服务调用项目实例
**项目结构**
```
├── README.md
├── ThriftDemo.thrift
├── go
│   ├── client.go
│   ├── go.mod
│   ├── go.sum
│   ├── server.go
│   ├── service
│   │   └── rpc.go
│   └── stub
│       ├── GoUnusedProtection__.go
│       ├── ThriftDemo-consts.go
│       ├── ThriftDemo.go
│       └── thrift_common_call_service-remote
│           └── thrift_common_call_service-remote.go
├── php
│   ├── app
│   │   ├── CallServer.php
│   │   ├── Client.php
│   │   ├── Lib
│   │   │   ├── ThriftCommonCallService.php
│   │   │   └── Types.php
│   │   ├── Log.php
│   │   ├── Server.php
│   │   ├── ServerHandle.php
│   │   └── Util.php
│   ├── client.php
│   ├── composer.json
│   ├── composer.lock
│   ├── conf
│   │   └── service.php
│   └── server.php
├── py
│   ├── __init__.py
│   ├── client.py
│   ├── server.py
│   └── stub
│       ├── ThriftCommonCallService-remote
│       ├── ThriftCommonCallService.py
│       ├── __init__.py
│       ├── constants.py
│       └── ttypes.py
└──


```

### 提供了三个语言的thrift调用实例

go
```$xslt
# 开启服务
go run server.go

# 请求调用

go run client.go
```

py
```$xslt
# 开启服务
python server.go

# 请求调用

python client.go
```

php
```$xslt
# 开启服务
php server.go

# 请求调用

php client.go
```

以上任何一个server启动，其他语言的client都可以调用