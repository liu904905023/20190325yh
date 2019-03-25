<?php
namespace Home\Controller;
use Think\Controller;
class DemoController extends Controller {
 
	
    protected function _initialize(){
        //全局引入微信支付类

        Vendor('IntelPay.IntelPay');
        Vendor('WxpayV3.WxPayOut');
        Vendor('AliIsv.AopClient');
        Vendor('AliIsv.AlipayOpenAuthTokenAppRequest');
        Vendor('AliIsv.AlipaySystemOauthTokenRequest');

    }

    public function newpay(){
        if(IS_POST){
            $fee = yuan2fee(I('amount'));
            $userid = I('userid');
            $PayType = I('PayType');
            $systemUserSysNo=I('systemUserSysNo');
            $CustomerSysNO=I('CustomerSysNO');
            $CustomerName=I('CustomerName');
            $DisplayName=I('DisplayName');
            $AppId=I('AppId');
            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {

                if($PayType==104||$PayType==106){
                    $data['systemUserSysNo']=$systemUserSysNo;
                    $data['body']=$CustomerName;
                    $data['sub_openid']=$userid;
                    $data['total_fee']=$fee;
                    $data['callback_url']="web.yunlaohu.cn/index.php/Wft/jsapi";
                    $url  = C('SERVER_HOST')."IPP3Swiftpass/WeiXinJsPayApi";
                    $list = http( $url, $data);
//					\Think\Log::record($list);
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
            $this->ajaxreturn($jsApiParameters);

        }else{
            $systemUserSysNo=I('systemUserSysNo');//2--zijian 2406--zijian123--104 3402--xujiang123--106
            $data['systemUserSysNo'] = $systemUserSysNo;
            $url  = C('SERVER_HOST')."IPP3Customers/GetPayConfig";
           
            $list = http( $url, $data);
            $CustomerSysNO=$list['CustomerSystemUserBase']['CustomerSysNO'];
            $CustomerName=$list['CustomerSystemUserBase']['CustomerName'];
            $Customer_field_one=$list['CustomerSystemUserBase']['Customer_field_one'];
            $DisplayName=$list['CustomerSystemUserBase']['DisplayName'];
		

            /*
                ali config
                    $AppID=$list['AliPayConfig']['AppID']; 
                    $Merchant_private_key=$list['AliPayConfig']['Merchant_private_key']; 
                    $Alipay_public_key=$list['AliPayConfig']['Alipay_public_key']; 
                    $AppID=$list['AliPayConfig']['AppID']; 
            */
            /*
                wx config
                    $APPID=$list['WXConfig']['APPID']; 
                    $NCHIDs=$list['WXConfig']['NCHID']; 
                    $KEY=$list['WXConfig']['KEY']; 
                    $APPSECRET=$list['WXConfig']['APPSECRET']; 
                    $APPID=$list['WXConfig']['APPID']; 

            */
            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
                $appid = 'wx261671a6d70c4db5';
                $coco = new \IntelWxPayApi($appid,'0559d78cf2a556b1d7b46988f026114a');
                //			$coco = new \IntelWxPayApi($list['WXConfig']['APPID'],$list['WXConfig']['APPSECRET']);
                $userid = $coco->GetWxOpenId();
            }
            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'AlipayClient') !== false ) {
                $appid = $list['AliPayConfig']['AppID'];
                $tools = new \IntelAliPayApi($list['AliPayConfig']['AppID']);
                $Auth_Code =  $tools->GetAuthCode();
                $aop = new \AopClient ();
                $aop->gatewayUrl = 'https://openapi.alipay.com/gateway.do';
                $aop->appId = $list['AliPayConfig']['AppID'];
                $aop->rsaPrivateKeyFilePath =$list['AliPayConfig']['Merchant_private_key'];
                $aop->alipayPublicKey=$list['AliPayConfig']['Alipay_public_key'];
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

            $this->assign('userid',$userid);
            $this->assign('CustomerName',$CustomerName);
            $this->assign('CustomerSysNO',$CustomerSysNO);
            $this->assign('DisplayName',$DisplayName);
            $this->assign('PayType',$Customer_field_one);
            $this->assign('AppId',$appid);
            $this->assign('systemUserSysNo',$systemUserSysNo);
            $this->display();
        }

    }


	


}                                   