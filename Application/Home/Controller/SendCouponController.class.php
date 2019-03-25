<?php
// +----------------------------------------------------------------------
// | 设计开发：Webster  Tel:17095135002 邮箱：312549912@qq.com
// | 此版本为微信官方最新微信支付V3版本
// +----------------------------------------------------------------------
namespace Home\Controller;
use Think\Controller;
class SendCouponController extends Controller {
	 protected function _initialize(){
        //全局引入微信支付类

        Vendor('IntelPay.IntelPay');

    }
	public function index(){
		
		$Wx_Appid='wxa9e066dad4e8aae8';;
		$Wx_Appsecret='cdc1293eef533f39fe672f0166ec991e';
		$coco = new \IntelWxPayApi($Wx_Appid,$Wx_Appsecret);
		$data['SystemUserSysNo']=I("SystemUserSysNo");
		$data['ReqModel']['coupon_stock_id']=I("stockid");
		$data['ReqModel']['open_id']=$coco->GetWxOpenId();
//		echo json_encode($data);exit;
		$url = "https://payapi.yunlaohu.cn/IPP3WXCoupon/SendCoupon";
		$list = http($url,$data);
//		dump($list);exit;
//		$list['Code']=1;
//		$list['Description']="发放代金券业务处理失败！";
		$this->assign("list",$list);
		$this->display();
		  
	}
	private function httpGet($url) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 500);
		// 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
		// 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_URL, $url);
		$res = curl_exec($curl);
		curl_close($curl);
		return $res;
	}
}