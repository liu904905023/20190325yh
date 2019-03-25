<?php
// +----------------------------------------------------------------------
// | 设计开发：Webster  Tel:17095135002 邮箱：312549912@qq.com
// | 此版本为微信官方最新微信支付V3版本
// +----------------------------------------------------------------------
namespace Home\Controller;
use Think\Controller;
class Test1Controller extends Controller {
	protected function _initialize(){
		//全局引入微信支付类

	}
	public function newpay(){
//		R("Base/getMenu");	
		$systemUserSysNo =2;
		$data['systemUserSysNo'] =$systemUserSysNo;
		$url  = "https://payapi.yunlaohu.cn/IPP3Customers/IPP3WxconfigBySUsysNo";
        $data = json_encode( $data );
        $head = array(
            "Content-Type:application/json;charset=UTF-8",
            "Content-length:".strlen( $data ),
            //"X-Ywkj-Authentication:" . strlen( $data ),
        );
//		$Customer = GetCustomerServiceSysNo($systemUserSysNo);
//		$systemUserName= QueryStaffInfo($systemUserSysNo);
        $list = $this->http_request( $url, $data, $head );
        $list = json_decode( $list ,true);
		var_dump($list);exit;
//		cookie('appid',$list['APPID']);
//		cookie('mchid',$list['NCHID']);
//		cookie('key',$list['KEY']);
//		cookie('appsecret',$list['APPSECRET']);
//		cookie('sub_mch_id',$list['sub_mch_id']);
//		cookie('systemUserSysNo',$systemUserSysNo);
//		cookie('openId',$tools->GetOpenid());
//		//\Think\Log::record("日志".cookie('openId') );
//		$this->assign('Customer',$Customer);
//		$this->assign('systemUserSysNo',$systemUserName);
		$this->display();	
	
	}
	//JSAPI支付 V3版本微信支付
   private function http_request( $url, $data = NULL, $head = NULL ){//15秒抛出
     $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_TIMEOUT,15);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        if( !empty( $data ) ){
            curl_setopt( $ch, CURLOPT_POST, 1 );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
        }
        if( !empty( $head ) ){
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $head );
        }
        $output = curl_exec( $ch );
        curl_close( $ch );
        return $output;
}
}