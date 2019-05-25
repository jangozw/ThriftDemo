//服务端， 启动监听即可 go run server.go
package main

import (
	"fmt"
	"github.com/apache/thrift/lib/go/thrift"
	"go-demo/service"
	"go-demo/stub"
)



func main() {
	//监听地址
	host := "127.0.0.1"
	port := "9999"
	addr := host+":"+port


	transport, err := thrift.NewTServerSocket(addr)
	if err != nil {
		panic(err)
	}
	//处理的业务类 要实现定义的服务
	handler := &service.RpcService{}
	processor := stub.NewThriftCommonCallServiceProcessor(handler)


	transportFactory := thrift.NewTBufferedTransportFactory(8192)
	protocolFactory := thrift.NewTBinaryProtocolFactory(true, true)



	server := thrift.NewTSimpleServer4(
		processor,
		transport,
		transportFactory,
		protocolFactory,
	)

	fmt.Println("服务启动成功")

	if err := server.Serve(); err != nil {
		panic(err)
	}
}
