#!/usr/bin/env python
from stub import ThriftCommonCallService
from stub.ttypes import *
from thrift.transport import TSocket
from thrift.transport import TTransport
from thrift.protocol import TBinaryProtocol
from thrift.server import TServer
sys.path.append('./py')


# 用来处理的
class ServerHandler:
    def __init__(self):
        self.log = {}

    def invokeMethod(self, msg):
        ''' 实现的方法，.thrift中定义的服务 '''
        print("收到服务请求-参数是", msg)
        r = Response(200, "ok", "result")
        return r


handler = ServerHandler()
processor = ThriftCommonCallService.Processor(handler)
transport = TSocket.TServerSocket('127.0.0.1', 9999)
tfactory = TTransport.TBufferedTransportFactory()
pfactory = TBinaryProtocol.TBinaryProtocolFactory()
server = TServer.TSimpleServer(processor, transport, tfactory, pfactory)

print("启动服务...")
server.serve()
