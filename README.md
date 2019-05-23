# Thrift 服务调用项目实例
**项目结构**
```
├── README.md
├── ThriftDemo.thrift
├── client_project
│   └── php
│       ├── app
│       │   ├── CallServer.php
│       │   ├── Client.php
│       │   ├── Lib
│       │   │   ├── ThriftCommonCallService.php
│       │   │   └── Types.php
│       │   ├── Log.php
│       │   └── Util.php
│       ├── composer.json
│       ├── conf
│       │   └── service.php
│       ├── index.php
│       └── log
└── server_project
    └── php
        ├── app
        │   ├── Lib
        │   │   ├── ThriftCommonCallService.php
        │   │   └── Types.php
        │   ├── Log.php
        │   ├── Run.php
        │   ├── Server.php
        │   └── Util.php
        ├── composer.json
        ├── conf
        │   └── service.php
        ├── index.php
        └── log


```

