/**
客户端, 请求服务端
 */
package main

import (
	"context"
	"encoding/json"
	"fmt"
	"github.com/apache/thrift/lib/go/thrift"
	"go-demo/stub"
	"log"
	"net"
	"os"
)

type Req struct {
	ServiceName string
	MethodName string
	Params interface{}

}

func main()  {
	var params map[string]string
	params = make(map[string]string)
	params["orderId"] = "12345"

	req := Req{
		"UserService",
		"getUserInfo",
		params,
	}
	pa,_ := json.Marshal(req)
	paramsJson := string(pa)

	request(paramsJson)
}



//paramsJson 请求的参数， 是协议定的
func request(paramsJson string) (r *stub.Response) {

	//socket  连接的端口号，ip
	host := "127.0.0.1"
	port := "9999"

	ctx := context.Background()
	transportFactory := thrift.NewTBufferedTransportFactory(8192)
	protocolFactory := thrift.NewTBinaryProtocolFactory(true, true)

	transport, err := thrift.NewTSocket(net.JoinHostPort(host, port))
	if err != nil {
		fmt.Fprintln(os.Stderr, "error resolving address:", err)
		os.Exit(1)
	}

	useTransport, err := transportFactory.GetTransport(transport)

	client := stub.NewThriftCommonCallServiceClientFactory(useTransport, protocolFactory)
	if err := transport.Open(); err != nil {
		fmt.Fprintln(os.Stderr, "Error opening socket to :"+host+":"+port, " ", err)
		os.Exit(1)
	}
	defer transport.Close()

	res, err := client.InvokeMethod(ctx, paramsJson)
	if err != nil {
		log.Println("Echo failed:", err)
		return
	}

	fmt.Println("请求服务", paramsJson, "返回结果", res)

	return res
}
