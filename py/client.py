#!/usr/bin/env python
import sys
from stub import ThriftCommonCallService
from thrift import Thrift
from thrift.transport import TSocket
from thrift.transport import TTransport
from thrift.protocol import TBinaryProtocol
import json
sys.path.append('./py')

try:
    # Make socket
    transport = TSocket.TSocket('127.0.0.1', 9999)

    # Buffering is critical. Raw sockets are very slow
    transport = TTransport.TBufferedTransport(transport)

    # Wrap in a protocol
    protocol = TBinaryProtocol.TBinaryProtocol(transport)

    # Create a client to use the protocol encoder
    client = ThriftCommonCallService.Client(protocol)

    # Connect!
    transport.open()
    params = {"ServiceName": "UserService", "MethodName": "getUserInfo", "Params": {"uid": "1233"}}
    params = json.dumps(params)
    res = client.invokeMethod(params)
    print("请求结果", res)
    transport.close()

except Thrift.TException as tx:
    print("%s" % (tx.message))
