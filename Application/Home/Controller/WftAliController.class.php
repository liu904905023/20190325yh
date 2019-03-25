<?php
namespace Home\Controller;
use Think\Controller;
class WftAliController extends Controller {
	protected function _initialize(){
		//全局引入微信支付类

    	Vendor('AliIsv.AopClient');
    	Vendor('AliIsv.AlipayOpenAuthTokenAppRequest');
    	Vendor('AliIsv.AlipaySystemOauthTokenRequest');
	}
    public function index(){
		$Code  = $_GET['app_auth_code'];
		$Auth_Code  = $_GET['auth_code'];
//		$SysNO = $_GET['systemUserSysNo'];
		$SysNO=I('systemUserSysNo');
		$data['systemUserSysNo'] = $SysNO;
		$url  = C('SERVER_HOST')."IPP3Customers/GetPayConfig";
		$list = http( $url, $data);
		$Customer=$list['CustomerSystemUserBase']['CustomerName'];
		$systemUserName=$list['CustomerSystemUserBase']['DisplayName'];
		$Switch=$list['CustomerSystemUserBase']['Switch'];
//	                $Customer_field_one=$list['CustomerSystemUserBase']['Customer_field_one'];
//					$CustomerSysNO=$list['CustomerSystemUserBase']['CustomerSysNO'];
//		$AppID=$list['AliPayConfig']['AppID']; 
		$private_key=$list['AliPayConfig']['Merchant_private_key']; 
		$public_key=$list['AliPayConfig']['Alipay_public_key']; 
		$AppID=$list['AliPayConfig']['AppID']; 
		
		if($Auth_Code){
			$aop = new \AopClient ();
			$aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
			$aop->appId = $AppID;
			$aop->rsaPrivateKeyFilePath =$private_key;
			$aop->alipayPublicKey=$public_key;
			$aop->apiVersion = '1.0';
			$aop->postCharset='utf-8';
			$aop->format='json';
			$request = new \AlipaySystemOauthTokenRequest ();
			$request->setGrantType("authorization_code");
			$request->setCode("$Auth_Code");
			$result = $aop->execute ($request);
//			var_dump($result);exit;
			$ReturnList =$this-> object_to_array($result);
			$this -> assign('userid',$ReturnList['alipay_system_oauth_token_response']['user_id']);
			$this -> assign('systemUserSysNo',$SysNO);
			$this -> assign('UserName',$systemUserName);
			$this -> assign('CustomerName',$Customer);
			$this -> assign('AppID',$AppID);
							$this->assign('Switch',$Switch);

			$this->display('index'); 
				

		}
		
    }
	public function index1(){
		$Code  = $_GET['app_auth_code'];
		$Auth_Code  = $_GET['auth_code'];
//		$SysNO = $_GET['systemUserSysNo'];
		$SysNO=I('systemUserSysNo');
		$data['systemUserSysNo'] = $SysNO;
		$url  = "http://suibian.yunlaohu.cn/IPP3Customers/GetPayConfig";
//		$url  = C('SERVER_HOST')."IPP3Customers/GetPayConfig";
		$list = http( $url, $data);
//echo "<pre>";
//		var_dump($list);exit;
		$Customer=$list['CustomerSystemUserBase']['CustomerName'];
		$systemUserName=$list['CustomerSystemUserBase']['DisplayName'];
		$Switch=$list['CustomerSystemUserBase']['Switch'];
//	                $Customer_field_one=$list['CustomerSystemUserBase']['Customer_field_one'];
//					$CustomerSysNO=$list['CustomerSystemUserBase']['CustomerSysNO'];
//		$AppID=$list['AliPayConfig']['AppID']; 
		$private_key=$list['SwiftPassageConfig_ALi']['ALi_merchant_private_key']; 
		$public_key=$list['SwiftPassageConfig_ALi']['ALi_alipay_public_key']; 
		$AppID=$list['SwiftPassageConfig_ALi']['ALi_APPID']; 
		
		if($Auth_Code){
			$aop = new \AopClient ();
			$aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
			$aop->appId = $AppID;
			$aop->rsaPrivateKeyFilePath =$private_key;
			$aop->alipayPublicKey=$public_key;
			$aop->apiVersion = '1.0';
			$aop->postCharset='utf-8';
			$aop->format='json';
			$request = new \AlipaySystemOauthTokenRequest ();
			$request->setGrantType("authorization_code");
			$request->setCode("$Auth_Code");
			$result = $aop->execute ($request);
//			var_dump($result);exit;
			$ReturnList =$this-> object_to_array($result);
			$this -> assign('userid',$ReturnList['alipay_system_oauth_token_response']['user_id']);
			$this -> assign('systemUserSysNo',$SysNO);
			$this -> assign('UserName',$systemUserName);
			$this -> assign('CustomerName',$Customer);
			$this -> assign('AppID',$AppID);
							$this->assign('Switch',$Switch);

			$this->display('index1'); 
				

		}
		
    }
public function jsapi123(){
		$money = I('amount');
		$userid = I('userid');
		$systemUserSysNo = I('systemUserSysNo');
		$CustomerName = I('CustomerName');
				$Switch = I('Switch');

//		$CustomId =  staffquerystore($systemUserSysNo);
		$data = array(
			
		"buyer_id"=>$userid,
		"total_fee"=>yuan2fee($money),
		"systemUserSysNo"=>$systemUserSysNo,
		"body"=>$CustomerName,
		"buyer_logon_id"=>""
		);
		$data = json_encode($data);
//		\Think\Log::record($data);
		$url  = "http://suibian.yunlaohu.cn/IPP3Swiftpass/AliPayJsPayApi"; 
//		$url  = C('SERVER_HOST')."IPP3Swiftpass/AliPayJsPayApi"; 
		$head = array(
            "Content-Type:application/json;charset=UTF-8",
            "Content-length:" . strlen( $data )
//            "X-Ywkj-Authentication:" . strlen( $data )
        );
		$list = http_request( $url, $data, $head );
				\Think\Log::record($list);
		$list = json_decode($list,true);
		$Ad_Info['UserId'] = $userid;
		$Ad_Info['Fee'] = $money;
		$Ad_Info['CustomerName'] = urlencode($CustomerName);
		$Ad_Info['AppId'] = I('AppID');
		$Ad_Info['systemUserSysNo'] = $systemUserSysNo;
		$this->assign('Ad_Info',$Ad_Info);
				$this->assign('Switch',$Switch);

		$this->assign('out_trade_no',$list['Data']['PayData']['tradeNO']);
		$this->display();

	
	}
	public function jsapi(){
		$money = I('amount');
		$userid = I('userid');
		$systemUserSysNo = I('systemUserSysNo');
		$CustomerName = I('CustomerName');
				$Switch = I('Switch');

//		$CustomId =  staffquerystore($systemUserSysNo);
		$data = array(
			
		"buyer_id"=>$userid,
		"total_fee"=>yuan2fee($money),
		"systemUserSysNo"=>$systemUserSysNo,
		"body"=>$CustomerName,
		"buyer_logon_id"=>""
		);
		$data = json_encode($data);
//		\Think\Log::record($data);
//		$url  = "https://pos.yunlaohu.cn/IPP3Swiftpass/AliPayJsPayApi"; 
		$url  = C('SERVER_HOST')."IPP3Swiftpass/AliPayJsPayApi"; 
		$head = array(
            "Content-Type:application/json;charset=UTF-8",
            "Content-length:" . strlen( $data )
//            "X-Ywkj-Authentication:" . strlen( $data )
        );
		$list = http_request( $url, $data, $head );
//				\Think\Log::record($list);
		$list = json_decode($list,true);
		$Ad_Info['UserId'] = $userid;
		$Ad_Info['Fee'] = $money;
		$Ad_Info['CustomerName'] = urlencode($CustomerName);
		$Ad_Info['AppId'] = I('AppID');
		$Ad_Info['systemUserSysNo'] = $systemUserSysNo;
		$this->assign('Ad_Info',$Ad_Info);
				$this->assign('Switch',$Switch);

		$this->assign('out_trade_no',$list['Data']['PayData']['tradeNO']);
		$this->display();

	
	}










		private function object_to_array($obj) 
		{ 
			$_arr= is_object($obj) ? get_object_vars($obj) : $obj; 
			foreach($_arr as $key=> $val) 
			{ 
				$val= (is_array($val) || is_object($val))?$this->object_to_array($val) : $val; 
				$arr[$key] = $val; 
			} 
			return $arr; 
		}

    
}