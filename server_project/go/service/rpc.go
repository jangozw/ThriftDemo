package service

import (
	"context"
	"encoding/json"
	"fmt"
	"go-demo/stub"
)

type DemoRep struct {
	OrderId int
	Username string
	Price float64
	PayTime string
}

type RpcService struct {

}


//处理业务实现的方法,是定义的服务
func (RpcService) InvokeMethod(ctx context.Context, params string) (r *stub.Response, err error) {
	/*r.Code = 100
	r.Msg = "ok"
	r.Data = "hello"*/

	data := DemoRep{
		100,
		"Django",
		100.23,
		"2019-09-09",
	}
	d,_ := json.Marshal(data)
	dataJson := string(d)

	res := &stub.Response{}
	res.Code = 200
	res.Msg = "ok"
	res.Data = dataJson

	fmt.Println("收到服务请求", params, "返回结果", res)

	return res, nil
}
