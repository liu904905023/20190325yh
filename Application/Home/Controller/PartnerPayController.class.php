<?php
namespace Home\Controller;
use Think\Controller;
class PartnerPayController extends Controller {
	protected function _initialize(){
    	Vendor('IntelPay.IntelPay');
    	Vendor('WxpayV3.WxPayOut');
		Vendor('AliIsv.AopClient');
		Vendor('AliIsv.AlipayOpenAuthTokenAppRequest');
		Vendor('AliIsv.AlipaySystemOauthTokenRequest');
		
	}

	public function pay_1(){

		$systemUserSysNo = $this->aes($_GET['id']);
		$posttime = $this->aes($_GET['datetime']);
		if($_GET['datetime']==""){
			$this->redirect("Base/istrue",array('message'=>3));
				return false;
		}else{
			if((time()-strtotime($posttime))>300){
				$this->redirect("Base/istrue");
				return false;
			}
		}
		$data['systemUserSysNo'] = $systemUserSysNo;
		$url  = C('SERVER_HOST')."IPP3Customers/GetPayConfig"; 
		$list = http( $url, $data);
		$appid = $list['SwiftPassageConfig_ALi']['ALi_APPID'];
		$tools = new \IntelAliPayApi($appid);
		$Auth_Code =  $tools->GetAuthCode();
		$aop = new \AopClient ();
		$aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
		$aop->appId = $appid;
		$aop->rsaPrivateKeyFilePath =$list['SwiftPassageConfig_ALi']['ALi_merchant_private_key'];
		$aop->alipayPublicKey=$list['SwiftPassageConfig_ALi']['ALi_alipay_public_key'];
		$aop->apiVersion = '1.0';
		$aop->postCharset='utf-8';
		$aop->format='json';
		$request = new \AlipaySystemOauthTokenRequest ();
		$request->setGrantType("authorization_code");
		$request->setCode("$Auth_Code");
		$result = $aop->execute ($request);
//			$ReturnList =json_decode($result,true);
		$ReturnList = $tools->object_to_array($result);
		$userid=$ReturnList['alipay_system_oauth_token_response']['user_id'];
		$_pay_data = array(
		"buyer_id"=>$userid,
		"total_fee"=>yuan2fee(($this->aes($_GET['amount']))),
		"systemUserSysNo"=>$systemUserSysNo,
		"out_trade_no"=>(string)$this->aes($_GET['out_trade_no']),
		"body"=>'',
		"buyer_logon_id"=>""
		);
//			\Think\Log::record(json_encode($_pay_data));
		$_pay_url  = C('SERVER_HOST')."IPP3Swiftpass/AliPayJsPayApi"; 
		
		$_pay_list = http( $_pay_url, $_pay_data);
//			\Think\Log::record(json_encode($_pay_list));
		$this->assign('out_trade_no',$_pay_list['Data']['PayData']['tradeNO']);
		$this->assign('callback',$_GET['callback']);
		
        $this->display();

    }
	public function pay(){

		$systemUserSysNo = $this->aes($_GET['id']);
		$posttime = $this->aes($_GET['datetime']);
		if($_GET['datetime']==""){
			$this->redirect("Base/istrue",array('message'=>3));
				return false;
		}else{
			if((time()-strtotime($posttime))>300){
				$this->redirect("Base/istrue");
				return false;
			}
		}
		$data['systemUserSysNo'] = $systemUserSysNo;
		$url  = C('SERVER_HOST')."IPP3Customers/GetPayConfig"; 
		$list = http( $url, $data);

		foreach( $list['PassageWayList'] as $key=>$val){
				if($val['Config']=='SwiftPassageConfig_ALi'){
					$Private_Key=$list['SwiftPassageConfig_ALi']['ALi_merchant_private_key']; 
					$Public_Key=$list['SwiftPassageConfig_ALi']['ALi_alipay_public_key']; 
					$AppID=$list['SwiftPassageConfig_ALi']['ALi_APPID']; 
					$PayType= $val['PassageWay'];

				}else if($val['Config']=='AliPayConfig'){
					$Public_Key = $list['AliPayConfig']['Alipay_public_key'];
					$Private_Key = $list['AliPayConfig']['Merchant_private_key'];
					$AppID = $list['AliPayConfig']['AppID'];
					$PayType= $val['PassageWay'];

				}else if($val['Config']=='WS_PassageConfig_ALi'){
					$Public_Key = $list['WS_PassageConfig_ALi']['ALi_alipay_public_key'];
					$Private_Key = $list['WS_PassageConfig_ALi']['ALi_merchant_private_key'];
					$AppID = $list['WS_PassageConfig_ALi']['ALi_APPID'];
					$PayType= $val['PassageWay'];

				}else if($val['PassageWay']=='110'){
                    $arr_url["SystemUserSysNo"]  = $systemUserSysNo;
                    $select_ali_url = "http://css.yunlaohu.cn/IPP3Customers/SystemUser_Extend_AliList";
                    $return_ali_url = http($select_ali_url, $arr_url);
                    if($return_ali_url['Data']['Ali_url']){
                        header( 'Location:'.$return_ali_url['Data']['Ali_url'] );
                    }else{
                        $this->redirect("Base/info",array('message'=>1,'icon_href'=>'ico_hint.png'));
                        return false;
                    }
                }
		}


		$tools = new \IntelAliPayApi($AppID);
		$Auth_Code =  $tools->GetAuthCode();
		$aop = new \AopClient ();
		$aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
		$aop->appId = $AppID;
		$aop->rsaPrivateKeyFilePath =$Private_Key;
		$aop->alipayPublicKey=$Public_Key;
		$aop->apiVersion = '1.0';
		$aop->postCharset='utf-8';
		$aop->format='json';
		$request = new \AlipaySystemOauthTokenRequest ();
		$request->setGrantType("authorization_code");
		$request->setCode("$Auth_Code");
		$result = $aop->execute ($request);
//			$ReturnList =json_decode($result,true);
		$ReturnList = $tools->object_to_array($result);
		$userid=$ReturnList['alipay_system_oauth_token_response']['user_id'];
		if($PayType==104||$PayType==106){
                    $pay_data = array(
                        "buyer_id"=>$userid,
                        "total_fee"=>yuan2fee(($this->aes($_GET['amount']))),
						"out_trade_no"=>(string)$this->aes($_GET['out_trade_no']),
                        "systemUserSysNo"=>$systemUserSysNo,
                        "body"=>$CustomerName,
                        "buyer_logon_id"=>""
                    );
                    $pay_url  = "http://css.yunlaohu.cn/IPP3Swiftpass/AliPayJsPayApi";
                    $return_list = http( $pay_url, $pay_data);
                    $tradeNO=$return_list['Data']['PayData']['tradeNO'];
                }else if($PayType==102){
                    $pay_data = array(
                        "buyer_id"=>$userid,
                        "Total_amount"=>yuan2fee(($this->aes($_GET['amount']))),
                        "CustomerSysNo"=>$CustomerSysNO,
                        "Out_trade_no"=>(string)$this->aes($_GET['out_trade_no']),
                        "Old_SysNo"=>$systemUserSysNo
                    );
                    $pay_url  = "http://css.yunlaohu.cn/IPP3AliPay/TradeCreate";
                    $return_list = http( $pay_url, $pay_data);
                    $pay_data = json_decode($return_list['Data'],true);
                    $tradeNO=$pay_data['alipay_trade_create_response']['trade_no'];
					

                }else if($PayType==108){
				
					$pay_data['ReqModel']['TotalAmount']=yuan2fee(($this->aes($_GET['amount'])));
					$pay_data['ReqModel']['ChannelType']='ALI';
					$pay_data['ReqModel']['OpenId']=$userid;
					$pay_data['ReqModel']['OutTradeNo']=(string)$this->aes($_GET['out_trade_no']);
					$pay_data['SystemUserSysNo']=$systemUserSysNo;
					$pay_url  = "https://payapi.yunlaohu.cn/IPP3WSOrder/WSJsPayUnion";
                    $return_list = http( $pay_url, $pay_data);
					$tradeNO=$return_list['Data']['PrePayId'];
		}
//			\Think\Log::record(json_encode($_pay_list));
		$this->assign('out_trade_no',$tradeNO);
		$this->assign('callback',$_GET['callback']);
		
        $this->display();

    }
	//bank_direct
	public function pay_direct(){
		$systemUserSysNo = $this->aes($_GET['id']);
		$posttime = $this->aes($_GET['datetime']);
		if($_GET['datetime']==""){
			$this->redirect("Base/istrue",array('message'=>3));
				return false;
		}else{
			if((time()-strtotime($posttime))>300){
				$this->redirect("Base/istrue");
				return false;
			}
		}

		$data['systemUserSysNo'] = $systemUserSysNo;
		$url  = C('SERVER_HOST')."IPP3Customers/GetPayConfig"; 
		$list = http( $url, $data);
		$Public_Key = $list['AliPayConfig']['Alipay_public_key'];
		$Private_Key = $list['AliPayConfig']['Merchant_private_key'];
		$AppID = $list['AliPayConfig']['AppID'];
		$tools = new \IntelAliPayApi($AppID);
		$Auth_Code =  $tools->GetAuthCode();
		$aop = new \AopClient ();
		$aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
		$aop->appId = $AppID;
		$aop->rsaPrivateKeyFilePath =$Private_Key;
		$aop->alipayPublicKey=$Public_Key;
		$aop->apiVersion = '1.0';
		$aop->postCharset='utf-8';
		$aop->format='json';
		$request = new \AlipaySystemOauthTokenRequest ();
		$request->setGrantType("authorization_code");
		$request->setCode("$Auth_Code");
		$result = $aop->execute ($request);
//			$ReturnList =json_decode($result,true);
		$ReturnList = $tools->object_to_array($result);
		$userid=$ReturnList['alipay_system_oauth_token_response']['user_id'];
		$_pay_data = array(
		"buyer_id"=>$userid,
		"Total_amount"=>yuan2fee(($this->aes($_GET['amount']))),
		"Old_SysNo"=>$systemUserSysNo,
		"out_trade_no"=>(string)$this->aes($_GET['out_trade_no']),
		"CustomerSysNo"=>''
		);
		$_pay_url  = C('SERVER_HOST')."IPP3AliPay/TradeCreate"; 
//		$_pay_url  = "http://suibian.yunlaohu.cn/IPP3AliPay/TradeCreate"; 
		
		$_pay_list = http( $_pay_url, $_pay_data);
		$payinfo = json_decode($_pay_list['Data'],true);
		$this->assign('out_trade_no',$payinfo['alipay_trade_create_response']['trade_no']);
		$this->assign('callback',$_GET['callback']);
		
        $this->display();
    }

	public function pay_yh(){

//		$systemUserSysNo = 4863;
		$systemUserSysNo = $this->aes($_GET['id']);
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'AlipayClient') !== false ) {

			$data['systemUserSysNo'] = $systemUserSysNo;
			$url  = C('SERVER_HOST')."IPP3Customers/GetPayConfig"; 
			$list = http( $url, $data);
			$Public_Key = $list['AliPayConfig']['Alipay_public_key'];
			$Private_Key = $list['AliPayConfig']['Merchant_private_key'];
			$AppID = $list['AliPayConfig']['AppID'];
			$tools = new \IntelAliPayApi($AppID);
			$Auth_Code =  $tools->GetAuthCode();
			$aop = new \AopClient ();
			$aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
			$aop->appId = $AppID;
			$aop->rsaPrivateKeyFilePath =$Private_Key;
			$aop->alipayPublicKey=$Public_Key;
			$aop->apiVersion = '1.0';
			$aop->postCharset='utf-8';
			$aop->format='json';
			$request = new \AlipaySystemOauthTokenRequest ();
			$request->setGrantType("authorization_code");
			$request->setCode("$Auth_Code");
			$result = $aop->execute ($request);
//			$ReturnList =json_decode($result,true);
			$ReturnList = $tools->object_to_array($result);
			$userid=$ReturnList['alipay_system_oauth_token_response']['user_id'];
			$_pay_data = array(
			"buyer_id"=>$userid,
			"Total_amount"=>yuan2fee(($this->aes($_GET['amount']))),
			"Old_SysNo"=>$systemUserSysNo,
			"out_trade_no"=>(string)$this->aes($_GET['out_trade_no']),
			"CustomerSysNo"=>''
			);
//			\Think\Log::record(json_encode($_pay_data));
//			$_pay_url  = C('SERVER_HOST')."IPP3Swiftpass/AliPayJsPayApi"; 
			$_pay_url  = "http://suibian.yunlaohu.cn/IPP3AliPay/TradeCreate"; 
//			dump($_pay_data);exit;
			$_pay_list = http( $_pay_url, $_pay_data);
			$payinfo = json_decode($_pay_list['Data'],true);
//			dump($payinfo);exit;
//			\Think\Log::record(json_encode($_pay_list));
			$this->assign('out_trade_no',$payinfo['alipay_trade_create_response']['trade_no']);
			$this->assign('callback',$_GET['callback']);
		
		}
        $this->display();

    }


	public function aaa(){
		echo $this-> aes("iZ%2Fd3f0ntUAnHdziEUx8bA%3D%3D");
	}
	private function aes($de){
		$privateKey = "1234qwer5678asda";
		$iv     = "yCJXKLv4GvySreYK";
		$encryptedData = base64_decode($de);
		$decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $privateKey, $encryptedData, MCRYPT_MODE_CBC, $iv);
		return trim($decrypted);
	}

    
}