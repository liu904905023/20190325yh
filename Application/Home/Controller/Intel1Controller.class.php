<?php
namespace Home\Controller;
use Think\Controller;
class Intel1Controller extends Controller {

   
    protected function _initialize(){
        //全局引入微信支付类

        Vendor('IntelPay.IntelPay');
        Vendor('WxpayV3.WxPayOut');
        Vendor('AliIsv_V1.AopClient');
        Vendor('AliIsv_v1.AlipayOpenAuthTokenAppRequest');
        Vendor('AliIsv_v1.AlipaySystemOauthTokenRequest');

    }
	public function aaa(){
		$this->GetOpenId();	
	
	}
	public function  GetOpenId(){
        if (!isset($_GET['code'])){
            $URL['PHP_SELF'] = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['ORIG_PATH_INFO']);   //当前页面名称
            $URL['DOMAIN'] = $_SERVER['SERVER_NAME'];  //域名(主机名)
            $URL['QUERY_STRING'] = $_SERVER['QUERY_STRING'];   //URL 参数
            $URL['URI'] = $URL['PHP_SELF'].($URL['QUERY_STRING'] ? "?".$URL['QUERY_STRING'] : "");
            $baseUrl = urlencode("http://".$URL['DOMAIN'].$URL['PHP_SELF'].($URL['QUERY_STRING'] ? "?".$URL['QUERY_STRING'] : ""));
            $url = $this->__CreateOauthUrlForCode($baseUrl);
            Header("Location: $url");
            exit();
        }else {
            $code = $_GET['code'];
            $openid = $this->getOpenidFromMp($code);
            return $openid;

        }



    }
    public function __CreateOauthUrlForCode($redirectUrl)
    {
        $urlObj["appid"] = "wx261671a6d70c4db5";
        $urlObj["redirect_uri"] = "$redirectUrl";
        $urlObj["response_type"] = "code";
        $urlObj["scope"] = "snsapi_base";
        $urlObj["state"] = "STATE"."#wechat_redirect";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;
    }
    public function ToUrlParams($urlObj)
    {
        $buff = "";
        foreach ($urlObj as $k => $v)
        {
            $buff .= $k . "=" . $v . "&";
        }

        $buff = trim($buff, "&");
        return $buff;
    }
    public function __CreateOauthUrlForOpenid($code)
    {
        $urlObj["appid"] = "wx261671a6d70c4db5";
        $urlObj["secret"] = "0559d78cf2a556b1d7b46988f026114a";
        $urlObj["code"] = $code;
        $urlObj["grant_type"] = "authorization_code";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://api.weixin.qq.com/sns/oauth2/access_token?".$bizString;
    }
    public function getOpenidFromMp($code)
    {
        $url = $this->__CreateOauthUrlForOpenid($code);
        //初始化curl
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        //运行curl，结果以jason形式返回
        $res = curl_exec($ch);
        curl_close($ch);
        //取出openid
        $data = json_decode($res,true);
		 Header('Location:https://api.weixin.qq.com/sns/userinfo?access_token='.$data['access_token'].'&openid=o-Rj7wNDSniqBUMbeAIlJVVSllZI&lang=zh_CN');
        $this->data = $data;
        $openid = $data['openid'];
        return $openid;
    }
    public function index_bak(){
        if(IS_POST){

            $fee = yuan2fee(I('amount'));
            $userid = I('userid');
            $PayType = I('PayType');
            $systemUserSysNo=I('systemUserSysNo');
            $CustomerSysNO=I('CustomerSysNO');
            $CustomerName=I('CustomerName');
            $DisplayName=I('DisplayName');
            $AppId=I('AppId');
			$Switch = I('Switch');
            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {

                if($PayType==104||$PayType==106){
                    $data['systemUserSysNo']=$systemUserSysNo;
                    $data['body']=$CustomerName;
                    $data['sub_openid']=$userid;
                    $data['total_fee']=$fee;
                    $data['callback_url']="web.yunlaohu.cn/index.php/Wft/jsapi";
                    $url  = C('SERVER_HOST')."IPP3Swiftpass/WeiXinJsPayApi";
                    $list = http( $url, $data);
                    $jsApiParameters['PayInfo']['appId']=$list['Data']['PayData']['appId'];
                    $jsApiParameters['PayInfo']['paySign']=$list['Data']['PayData']['paySign'];
                    $jsApiParameters['PayInfo']['package']=$list['Data']['PayData']['package'];
                    $jsApiParameters['PayInfo']['out_trade_no']=$list['Data']['PayData']['out_trade_no'];
                    $jsApiParameters['PayInfo']['signType']=$list['Data']['PayData']['signType'];
                    $jsApiParameters['PayInfo']['timeStamp']=$list['Data']['PayData']['timeStamp'];
                    $jsApiParameters['PayInfo']['nonceStr']=$list['Data']['PayData']['nonceStr'];
                }else{
                    $data['systemUserSysNo'] = $systemUserSysNo;
                    $data['total_fee'] = $fee;
                    $data['openId'] = $userid;
					$url  = C('SERVER_HOST')."Payment/Payments/GetUnifiedOrderResult";
                    $list = http( $url, $data);
                    $jsApiParameters['PayInfo']=$list['Data']['WxPayData']['m_values'];

                }



            }
            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'AlipayClient') !== false ) {
                if($PayType==104||$PayType==106){
                    $data = array(
                        "buyer_id"=>$userid,
                        "total_fee"=>$fee,
                        "systemUserSysNo"=>$systemUserSysNo,
                        "body"=>$CustomerName,
                        "buyer_logon_id"=>""
                    );
                    $url  = C('SERVER_HOST')."IPP3Swiftpass/AliPayJsPayApi";
                    $list = http( $url, $data);
                    $jsApiParameters['PayInfo']=$list['Data']['PayData']['tradeNO'];
                }else{
                    $data = array(
                        "buyer_id"=>$userid,
                        "Total_amount"=>$fee,
                        "CustomerSysNo"=>$CustomerSysNO,
                        "Old_SysNo"=>$systemUserSysNo
                    );
                    $url  = C('SERVER_HOST')."IPP3AliPay/TradeCreate";
                    $list = http( $url, $data);
                    $data = json_decode($list['Data'],true);
                    $jsApiParameters['PayInfo']=$data['alipay_trade_create_response']['trade_no'];
                }
            }
            $jsApiParameters['Ad_Info']['UserId'] = $userid;
            $jsApiParameters['Ad_Info']['Fee'] = I('amount');
            $jsApiParameters['Ad_Info']['CustomerName'] = urlencode($CustomerName);
            $jsApiParameters['Ad_Info']['AppId'] = $AppId;
            $jsApiParameters['Ad_Info']['systemUserSysNo'] = $systemUserSysNo;
            $jsApiParameters['Ad_Info']['Switch'] = $Switch;
            $this->ajaxreturn($jsApiParameters);

        }else{
            $systemUserSysNo=I('systemUserSysNo');//2--zijian 2406--zijian123--104 3402--xujiang123--106
			if (preg_match("/^\d*$/", $systemUserSysNo)&&$systemUserSysNo!='') {

			}else{
				return false;
			}
            $data['systemUserSysNo'] = $systemUserSysNo;
            $url  = C('SERVER_HOST')."IPP3Customers/GetPayConfig";
            $list = http( $url, $data);
            $CustomerSysNO=$list['CustomerSystemUserBase']['CustomerSysNO'];
            $CustomerName=$list['CustomerSystemUserBase']['CustomerName'];
            $Customer_field_one=$list['CustomerSystemUserBase']['Customer_field_one'];
            $DisplayName=$list['CustomerSystemUserBase']['DisplayName'];
			$Switch=$list['CustomerSystemUserBase']['Switch'];

            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
				foreach( $list['PassageWayList'] as $key=>$val){
				if($val['Config']=='SwiftPassageConfig_WX'){
//					$Wx_Appid=$list["SwiftPassageConfig_WX"]["WX_APPID"];
					$Wx_Appid='wx261671a6d70c4db5';;
					$Wx_Appsecret='0559d78cf2a556b1d7b46988f026114a';
//					$Wx_Appsecret=$list["SwiftPassageConfig_WX"]["WX_APPSECRET"];
					$PayType= $val['PassageWay'];

				}else if($val['Config']=='WXConfig'){
					$Wx_Appid = $list['WXConfig']['APPID'];
					$Wx_Appsecret = $list['WXConfig']['APPSECRET'];
					$PayType= $val['PassageWay'];

				}
			}
				if($PayType==''){
					return false;
				}
                $coco = new \IntelWxPayApi($Wx_Appid,$Wx_Appsecret);
				try{
				$userid = $coco->GetWxOpenId();
				}
				catch(Exception $e){
					\Think\Log::record($e->getMessage());
				}
            }
            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'AlipayClient') !== false ) {
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

				}
				}
				if($PayType==''){
					return false;
				}
                $tools = new \IntelAliPayApi($AppID);
                $Auth_Code =  $tools->GetAuthCode();
                $aop = new \AopClient ();
                $aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
                $aop->appId =$AppID;
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
            }
			if($userid==''){
					header( 'Location: http://'.$_SERVER['HTTP_HOST'].'/index.php/Intel/index?systemUserSysNo='.$systemUserSysNo);
			}
            $this->assign('userid',$userid);
            $this->assign('CustomerName',$CustomerName);
            $this->assign('CustomerSysNO',$CustomerSysNO);
            $this->assign('DisplayName',$DisplayName);
            $this->assign('PayType',$PayType);
            $this->assign('AppId',$AppID);
            $this->assign('systemUserSysNo',$systemUserSysNo);
			$this->assign('Switch',$Switch);
            $this->display();
        }

    }















	public function index(){
        if(IS_POST){

            $fee = yuan2fee(I('amount'));
            $userid = I('userid');
            $PayType = I('PayType');
            $systemUserSysNo=I('systemUserSysNo');
            $CustomerSysNO=I('CustomerSysNO');
            $CustomerName=I('CustomerName');
            $DisplayName=I('DisplayName');
            $AppId=I('AppId');
			$Switch = I('Switch');
            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {

                if($PayType==104||$PayType==106){
                    $data['systemUserSysNo']=$systemUserSysNo;
                    $data['body']=$CustomerName;
                    $data['sub_openid']=$userid;
                    $data['total_fee']=$fee;
                    $data['callback_url']="web.yunlaohu.cn/index.php/Wft/jsapi";
                    $url  = C('SERVER_HOST')."IPP3Swiftpass/WeiXinJsPayApi";
                    $list = http( $url, $data);
                    $jsApiParameters['PayInfo']['appId']=$list['Data']['PayData']['appId'];
                    $jsApiParameters['PayInfo']['paySign']=$list['Data']['PayData']['paySign'];
                    $jsApiParameters['PayInfo']['package']=$list['Data']['PayData']['package'];
                    $jsApiParameters['PayInfo']['out_trade_no']=$list['Data']['PayData']['out_trade_no'];
                    $jsApiParameters['PayInfo']['signType']=$list['Data']['PayData']['signType'];
                    $jsApiParameters['PayInfo']['timeStamp']=$list['Data']['PayData']['timeStamp'];
                    $jsApiParameters['PayInfo']['nonceStr']=$list['Data']['PayData']['nonceStr'];
                }else if($PayType==102){
                    $data['systemUserSysNo'] = $systemUserSysNo;
                    $data['total_fee'] = $fee;
                    $data['openId'] = $userid;
					$url  = C('SERVER_HOST')."Payment/Payments/GetUnifiedOrderResult";
                    $list = http( $url, $data);
                    $jsApiParameters['PayInfo']=$list['Data']['WxPayData']['m_values'];

                }else if($PayType==108){
					$data['ReqModel']['TotalAmount']=$fee;
					$data['ReqModel']['ChannelType']='WX';
					$data['ReqModel']['OpenId']=$userid;
					$data['SystemUserSysNo']=$systemUserSysNo;
					$data['ReqModel']['SubAppId']='wxa9e066dad4e8aae8';
					$url  = "https://payapi.yunlaohu.cn/IPP3WSOrder/WSJsPayUnion";
					$list = http( $url, $data);
					$jsApiParameters['PayInfo']=$list['Data']['PayInfo'];
				}



            }
            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'AlipayClient') !== false ) {
                if($PayType==104||$PayType==106){
                    $data = array(
                        "buyer_id"=>$userid,
                        "total_fee"=>$fee,
                        "systemUserSysNo"=>$systemUserSysNo,
                        "body"=>$CustomerName,
                        "buyer_logon_id"=>""
                    );
                    $url  = C('SERVER_HOST')."IPP3Swiftpass/AliPayJsPayApi";
                    $list = http( $url, $data);
                    $jsApiParameters['PayInfo']=$list['Data']['PayData']['tradeNO'];
                }else if($PayType==102){
                    $data = array(
                        "buyer_id"=>$userid,
                        "Total_amount"=>$fee,
                        "CustomerSysNo"=>$CustomerSysNO,
                        "Old_SysNo"=>$systemUserSysNo
                    );
                    $url  = "https://payapi.yunlaohu.cn/IPP3AliPay/TradeCreate";
                    $list = http( $url, $data);
                    $data = json_decode($list['Data'],true);
                    $jsApiParameters['PayInfo']=$data['alipay_trade_create_response']['trade_no'];
                }else if($PayType==108){
				
					$data['ReqModel']['TotalAmount']=$fee;
					$data['ReqModel']['ChannelType']='ALI';
					$data['ReqModel']['OpenId']=$userid;
					$data['SystemUserSysNo']=$systemUserSysNo;
					$url  = "https://payapi.yunlaohu.cn/IPP3WSOrder/WSJsPayUnion";
                    $list = http( $url, $data);
					$jsApiParameters['PayInfo']=$list['Data']['PrePayId'];
				}
            }
			$jsApiParameters['Code']=$list['Code'];
			$jsApiParameters['Description']=$list['Description'];
            $jsApiParameters['Ad_Info']['UserId'] = $userid;
            $jsApiParameters['Ad_Info']['Fee'] = I('amount');
            $jsApiParameters['Ad_Info']['CustomerName'] = urlencode($CustomerName);
            $jsApiParameters['Ad_Info']['AppId'] = $AppId;
            $jsApiParameters['Ad_Info']['systemUserSysNo'] = $systemUserSysNo;
            $jsApiParameters['Ad_Info']['Switch'] = $Switch;
            $this->ajaxreturn($jsApiParameters);

        }else{
            $systemUserSysNo=I('systemUserSysNo');//2--zijian 2406--zijian123--104 3402--xujiang123--106
			if (preg_match("/^\d*$/", $systemUserSysNo)&&$systemUserSysNo!='') {

			}else{
				return false;
			}
            $data['systemUserSysNo'] = $systemUserSysNo;
            $url  = "https://payapi.yunlaohu.cn/IPP3Customers/GetPayConfig";
            $list = http( $url, $data);
            $CustomerSysNO=$list['CustomerSystemUserBase']['CustomerSysNO'];
            $CustomerName=$list['CustomerSystemUserBase']['CustomerName'];
            $Customer_field_one=$list['CustomerSystemUserBase']['Customer_field_one'];
            $DisplayName=$list['CustomerSystemUserBase']['DisplayName'];
			$Switch=$list['CustomerSystemUserBase']['Switch'];

            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
				foreach( $list['PassageWayList'] as $key=>$val){
				if($val['Config']=='SwiftPassageConfig_WX'){
//					$Wx_Appid=$list["SwiftPassageConfig_WX"]["WX_APPID"];
					$Wx_Appid='wx261671a6d70c4db5';;
					$Wx_Appsecret='0559d78cf2a556b1d7b46988f026114a';
//					$Wx_Appsecret=$list["SwiftPassageConfig_WX"]["WX_APPSECRET"];
					$PayType= $val['PassageWay'];

				}else if($val['Config']=='WXConfig'){
					$Wx_Appid = $list['WXConfig']['APPID'];
					$Wx_Appsecret = $list['WXConfig']['APPSECRET'];
					$PayType= $val['PassageWay'];

				}else if($val['Config']=='WS_PassageConfig_WX'){
					if($list['WS_PassageConfig_WX']['WS_APPIDTwo']==''&&$list['WS_PassageConfig_WX']['WS_APPSECRET']==''){
						$Wx_Appid = $list['WS_PassageConfig_WX']['WX_APPID'];
						$Wx_Appsecret = $list['WS_PassageConfig_WX']['WX_APPSECRET'];
					}else{
						$Wx_Appid = $list['WS_PassageConfig_WX']['WS_APPIDTwo'];
						$Wx_Appsecret = $list['WS_PassageConfig_WX']['WS_APPSECRET'];
					}
					$PayType= $val['PassageWay'];
				
				
				}
			}
				if($PayType==''){
					return false;
				}
                $coco = new \IntelWxPayApi($Wx_Appid,$Wx_Appsecret);
				try{
				$userid = $coco->GetWxOpenId();
				}
				catch(Exception $e){
					\Think\Log::record($e->getMessage());
				}
            }
            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'AlipayClient') !== false ) {
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

				}
				}
				if($PayType==''){
					return false;
				}
                $tools = new \IntelAliPayApi($AppID);
                $Auth_Code =  $tools->GetAuthCode();
                $aop = new \AopClient ();
                $aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
                $aop->appId =$AppID;
                $aop->rsaPrivateKeyFilePath =$Private_Key;
                $aop->alipayPublicKey=$Public_Key;
                $aop->apiVersion = '1.0';
                $aop->postCharset='utf-8';
                $aop->format='json';
				$aop->signType=$list['AliPayConfig']['Status']==1?'RSA2':'RSA';
                $request = new \AlipaySystemOauthTokenRequest ();
                $request->setGrantType("authorization_code");
                $request->setCode("$Auth_Code");
                $result = $aop->execute ($request);
                $ReturnList = $tools->object_to_array($result);
                $userid=$ReturnList['alipay_system_oauth_token_response']['user_id'];
            }
			if($userid==''){
					header( 'Location: http://'.$_SERVER['HTTP_HOST'].'/index.php/Intel/index?systemUserSysNo='.$systemUserSysNo);
			}
            $this->assign('userid',$userid);
            $this->assign('CustomerName',$CustomerName);
            $this->assign('CustomerSysNO',$CustomerSysNO);
            $this->assign('DisplayName',$DisplayName);
            $this->assign('PayType',$PayType);
            $this->assign('AppId',$AppID);
            $this->assign('systemUserSysNo',$systemUserSysNo);
			$this->assign('Switch',$Switch);
            $this->display();
        }

    }



	


}                                   