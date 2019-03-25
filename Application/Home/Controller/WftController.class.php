<?php

namespace Home\Controller;
use Think\Controller;

class WftController extends Controller {
	protected function _initialize(){
		//全局引入微信支付类

    	Vendor('IntelPay.IntelPayHttps');
    	Vendor('WxpayV3.WxPayOut');
		Vendor('AliIsv.AopClient');
		Vendor('AliIsv.AlipayOpenAuthTokenAppRequest');
		Vendor('AliIsv.AlipaySystemOauthTokenRequest');
		
	}
    public function newpay(){
		$systemUserSysNo=I('systemUserSysNo');//2--zijian 2406--zijian123--104 3402--xujiang123--106
		$data['systemUserSysNo'] = $systemUserSysNo;
		$url  = C('SERVER_HOST')."IPP3Customers/GetPayConfig";
		$list = http( $url, $data);
		$Customer=$list['CustomerSystemUserBase']['CustomerName'];
		$systemUserName=$list['CustomerSystemUserBase']['DisplayName'];
				$Switch=$list['CustomerSystemUserBase']['Switch'];

		$this->assign('openid',$this->GetOpenId());
		$this->assign('Customer',$Customer);
		$this->assign('systemUserName',$systemUserName);
		$this->assign('systemUserSysNo',$systemUserSysNo);
				$this->assign('Switch',$Switch);

        $this->display();
    }
	public function newpay1(){
		$systemUserSysNo=I('systemUserSysNo');//2--zijian 2406--zijian123--104 3402--xujiang123--106
		$data['systemUserSysNo'] = $systemUserSysNo;
		$url  = C('SERVER_HOST')."IPP3Customers/GetPayConfig";
		$list = http( $url, $data);
		$Customer=$list['CustomerSystemUserBase']['CustomerName'];
		$systemUserName=$list['CustomerSystemUserBase']['DisplayName'];
				$Switch=$list['CustomerSystemUserBase']['Switch'];
		$this->assign('openid',$this->GetOpenId());
		$this->assign('Customer',$Customer);
		$this->assign('systemUserName',$systemUserName);
		$this->assign('systemUserSysNo',$systemUserSysNo);
				$this->assign('Switch',$Switch);

        $this->display();
    }
    public function jsapi(){
				$Switch = I('Switch');

		$data['systemUserSysNo']=$_POST['systemUserSysNo'];
		$data['body']=$_POST['Customer'];
		$data['sub_openid']=$_POST['openid'];
		$data['total_fee']=yuan2fee($_POST['amount']);
		$data['callback_url']="web.yunlaohu.cn/index.php/Wft/jsapi";
//		$url  = "https://pos.yunlaohu.cn/IPP3Swiftpass/WeiXinJsPayApi";
		$url  = C('SERVER_HOST')."IPP3Swiftpass/WeiXinJsPayApi";
        $data = json_encode( $data );
        $head = array(
            "Content-Type:application/json;charset=UTF-8",
            "Content-length:".strlen( $data )
            //"X-Ywkj-Authentication:" . strlen( $data ),
        );
		$list = http_request( $url, $data, $head );
//		\Think\Log::record($list);
		$list = json_decode($list,true);
		$Ad_Info['UserId'] = $_POST['openid'];
		$Ad_Info['Fee'] = $_POST['amount'];
		$Ad_Info['CustomerName'] = urlencode($_POST['Customer']);
		$Ad_Info['AppId'] = 'wx261671a6d70c4db5';
		$Ad_Info['systemUserSysNo'] = $_POST['systemUserSysNo'];
		$this->assign('Ad_Info',$Ad_Info);
				$this->assign('Switch',$Switch);

		$this->assign('appId',$list['Data']['PayData']['appId']);
		$this->assign('paySign',$list['Data']['PayData']['paySign']);
		$this->assign('package',$list['Data']['PayData']['package']);
		$this->assign('out_trade_no',$list['Data']['PayData']['out_trade_no']);
		$this->assign('signType',$list['Data']['PayData']['signType']);
		$this->assign('timeStamp',$list['Data']['PayData']['timeStamp']);
		$this->assign('nonceStr',$list['Data']['PayData']['nonceStr']);
        $this->display();

    }
    public function pay_extend_p(){
		if(IS_POST){

            $fee = yuan2fee(I('amount'));
            $userid = I('userid');
            $PayType = I('PayType');
            $systemUserSysNo=I('systemUserSysNo');
            $CardNum=I('CardNum');
            $CustomerName=I('CustomerName');
//			\Think\Log::record(json_encode($CardNum));
			$Query_Card_Data['CardNumber']=$CardNum;
			$Query_Card_Url = "http://suibian.yunlaohu.cn/IPP3PoliceCard/QueryBalance";
			$Query_Card_List = http($Query_Card_Url,$Query_Card_Data);
//			\Think\Log::record(json_encode($Query_Card_List));
			if($Query_Card_List['Code']==0&&$Query_Card_List!=null){
				
			}else{
				$jsApiParameters['IsOk']=1;
				$this->ajaxreturn($jsApiParameters);
				return false;
			}

           
            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {

                if($PayType==104||$PayType==106){
                    $data['systemUserSysNo']=$systemUserSysNo;
                    $data['body']=$CustomerName;
                    $data['sub_openid']=$userid;
                    $data['total_fee']=$fee;
                    $data['CardNumber']=$CardNum;
                    $data['callback_url']="web.yunlaohu.cn/index.php/Wft/jsapi";
                    $data['allback_url']="web.yunlaohu.cn/index.php/Wft/jsapi";
                    $url  = "http://suibian.yunlaohu.cn/IPP3PoliceCard/WeiXinJsPayApi_PoliceCard";
//                    $url  = C('SERVER_HOST')."IPP3Swiftpass/WeiXinJsPayApi";
                    $list = http( $url, $data);
//					\Think\Log::record(json_encode($data));
										\Think\Log::record(json_encode($list));

                    $jsApiParameters['PayInfo']['appId']=$list['Data']['PayData']['appId'];
                    $jsApiParameters['PayInfo']['paySign']=$list['Data']['PayData']['paySign'];
                    $jsApiParameters['PayInfo']['package']=$list['Data']['PayData']['package'];
                    $jsApiParameters['PayInfo']['out_trade_no']=$list['Data']['PayData']['out_trade_no'];
                    $jsApiParameters['PayInfo']['signType']=$list['Data']['PayData']['signType'];
                    $jsApiParameters['PayInfo']['timeStamp']=$list['Data']['PayData']['timeStamp'];
                    $jsApiParameters['PayInfo']['nonceStr']=$list['Data']['PayData']['nonceStr'];
                    $jsApiParameters['IsOk']=0;
                }



            }
           
            $this->ajaxreturn($jsApiParameters);

        }else{
            $systemUserSysNo=8792;//2--zijian 2406--zijian123--104 3402--xujiang123--106
			if($systemUserSysNo==''){
				return false;
			}
            $data['systemUserSysNo'] = $systemUserSysNo;
            $url  = C('SERVER_HOST')."IPP3Customers/GetPayConfig";
            $list = http( $url, $data);
            $CustomerName=$list['CustomerSystemUserBase']['CustomerName'];
			$MoneyTypeList_Url="http://suibian.yunlaohu.cn/IPP3PoliceCard/IPoliceCard_Money_TypeList";
			$MoneyTypeList_Data=[];
			$MoneyTypeList_Return = http($MoneyTypeList_Url,$MoneyTypeList_Data);
            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
				foreach( $list['PassageWayList'] as $key=>$val){
				if($val['Config']=='SwiftPassageConfig_WX'){
					$Wx_Appid=$list["SwiftPassageConfig_WX"]["WX_APPID"];
//					$Wx_Appid='wx5b4c4f34459a34c4';;
//					$Wx_Appsecret='21d2eeb8333b265be2fdceff17b7e402';
					$Wx_Appsecret=$list["SwiftPassageConfig_WX"]["WX_APPSECRET"];
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
           if($userid==''){
					header( 'Location:https://'.$_SERVER['HTTP_HOST'].'/index.php/Wft/pay_extend_p');
			}
            $this->assign('userid',$userid);
            $this->assign('CustomerName',$CustomerName);
            $this->assign('PayType',$PayType);
            $this->assign('systemUserSysNo',$systemUserSysNo);
			$this->assign('MoneyTypeList_Return',$MoneyTypeList_Return);
            $this->display();
        }

    }


	 public function pay_extend_p1(){
		if(IS_POST){

            $fee = yuan2fee(I('amount'));
            $userid = I('userid');
            $PayType = I('PayType');
            $systemUserSysNo=I('systemUserSysNo');
            $CardNum=I('CardNum');
            $CustomerName=I('CustomerName');
			\Think\Log::record(json_encode($CardNum));
			$Query_Card_Data['CardNumber']=$CardNum;
			$Query_Card_Url = "http://suibian.yunlaohu.cn/IPP3PoliceCard/QueryBalance";
			$Query_Card_List = http($Query_Card_Url,$Query_Card_Data);
			\Think\Log::record(json_encode($Query_Card_List));
			if($Query_Card_List['Code']==0&&$Query_Card_List!=null){
				
			}else{
				$jsApiParameters['IsOk']=1;
				$this->ajaxreturn($jsApiParameters);
				return false;
			}

           
            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {

                if($PayType==104||$PayType==106){
                    $data['systemUserSysNo']=$systemUserSysNo;
                    $data['body']=$CustomerName;
                    $data['sub_openid']=$userid;
                    $data['total_fee']=$fee;
                    $data['CardNumber']=$CardNum;
                    $data['callback_url']="web.yunlaohu.cn/index.php/Wft/jsapi";
                    $data['allback_url']="web.yunlaohu.cn/index.php/Wft/jsapi";
                    $url  = "http://suibian.yunlaohu.cn/IPP3PoliceCard/WeiXinJsPayApi_PoliceCard";
//                    $url  = C('SERVER_HOST')."IPP3Swiftpass/WeiXinJsPayApi";
                    $list = http( $url, $data);
//					\Think\Log::record(json_encode($data));
										\Think\Log::record(json_encode($list));

                    $jsApiParameters['PayInfo']['appId']=$list['Data']['PayData']['appId'];
                    $jsApiParameters['PayInfo']['paySign']=$list['Data']['PayData']['paySign'];
                    $jsApiParameters['PayInfo']['package']=$list['Data']['PayData']['package'];
                    $jsApiParameters['PayInfo']['out_trade_no']=$list['Data']['PayData']['out_trade_no'];
                    $jsApiParameters['PayInfo']['signType']=$list['Data']['PayData']['signType'];
                    $jsApiParameters['PayInfo']['timeStamp']=$list['Data']['PayData']['timeStamp'];
                    $jsApiParameters['PayInfo']['nonceStr']=$list['Data']['PayData']['nonceStr'];
                    $jsApiParameters['IsOk']=0;
                }



            }
           
            $this->ajaxreturn($jsApiParameters);

        }else{
            $systemUserSysNo=2406;//2--zijian 2406--zijian123--104 3402--xujiang123--106
			if($systemUserSysNo==''){
				return false;
			}
            $data['systemUserSysNo'] = $systemUserSysNo;
            $url  = C('SERVER_HOST')."IPP3Customers/GetPayConfig";
            $list = http( $url, $data);
            $CustomerName=$list['CustomerSystemUserBase']['CustomerName'];
			$MoneyTypeList_Url="http://suibian.yunlaohu.cn/IPP3PoliceCard/IPoliceCard_Money_TypeList";
			$MoneyTypeList_Data=[];
			$MoneyTypeList_Return = http($MoneyTypeList_Url,$MoneyTypeList_Data);
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
           
            $this->assign('userid',$userid);
            $this->assign('CustomerName',$CustomerName);
            $this->assign('PayType',$PayType);
            $this->assign('systemUserSysNo',$systemUserSysNo);
			$this->assign('MoneyTypeList_Return',$MoneyTypeList_Return);
            $this->display();
        }

    }
	public function weixin1(){
		$data['systemUserSysNo']=$this->aes($_GET['id']);
		$data['body']="";
		$data['sub_openid']=$this->GetOpenId();
		$data['total_fee']=yuan2fee(($this->aes($_GET['amount'])));
		$data['callback_url']="web.yunlaohu.cn/index.php/Wft/jsapi";
		$data['out_trade_no']=(string)$this->aes($_GET['out_trade_no']);
//		$url  = "https://pos.yunlaohu.cn/IPP3Swiftpass/WeiXinJsPayApi";
$data['datetime']=  $this->aes($_GET['datetime']);
		var_dump($data);exit;

		$url  = C('SERVER_HOST')."IPP3Swiftpass/WeiXinJsPayApi";
//				\Think\Log::record(json_encode($data));
		
		$list = http( $url, $data);
//		\Think\Log::record(json_encode($list));
//		\Think\Log::record(json_encode($_GET));
		$this->assign('appId',$list['Data']['PayData']['appId']);
		$this->assign('paySign',$list['Data']['PayData']['paySign']);
		$this->assign('package',$list['Data']['PayData']['package']);
		$this->assign('out_trade_no',$list['Data']['PayData']['out_trade_no']);
		$this->assign('signType',$list['Data']['PayData']['signType']);
		$this->assign('timeStamp',$list['Data']['PayData']['timeStamp']);
		$this->assign('nonceStr',$list['Data']['PayData']['nonceStr']);
		$this->assign('callback',$_GET['callback']);
		$this->assign('out_trade_no',$_GET['out_trade_no']);
        $this->display();

    }
	public function weixin(){
//		$oldtime = '20171023105000';
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

		$data['systemUserSysNo']=$this->aes($_GET['id']);
		$data['body']="";
		$data['sub_openid']=$this->GetOpenId();
		$data['total_fee']=yuan2fee(($this->aes($_GET['amount'])));
		$data['callback_url']="web.yunlaohu.cn/index.php/Wft/jsapi";
		$data['out_trade_no']=(string)$this->aes($_GET['out_trade_no']);
//		$url  = "https://pos.yunlaohu.cn/IPP3Swiftpass/WeiXinJsPayApi";
		$url  = C('SERVER_HOST')."IPP3Swiftpass/WeiXinJsPayApi";
//				\Think\Log::record(json_encode($data));

		$list = http( $url, $data);
//		\Think\Log::record(json_encode($list));
//		\Think\Log::record(json_encode($_GET));
		$this->assign('appId',$list['Data']['PayData']['appId']);
		$this->assign('paySign',$list['Data']['PayData']['paySign']);
		$this->assign('package',$list['Data']['PayData']['package']);
		$this->assign('out_trade_no',$list['Data']['PayData']['out_trade_no']);
		$this->assign('signType',$list['Data']['PayData']['signType']);
		$this->assign('timeStamp',$list['Data']['PayData']['timeStamp']);
		$this->assign('nonceStr',$list['Data']['PayData']['nonceStr']);
		$this->assign('callback',$_GET['callback']);
		$this->assign('out_trade_no',$_GET['out_trade_no']);
        $this->display();

    }
	//direct_weixin
	public function weixin_direct(){
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

		$data['systemUserSysNo']=$this->aes($_GET['id']);
		$data['openId']=$this->GetOpenId();
		$data['total_fee']=yuan2fee(($this->aes($_GET['amount'])));
		$data['callback_url']="web.yunlaohu.cn/index.php/Wft/jsapi";
		$data['out_trade_no']=(string)$this->aes($_GET['out_trade_no']);
//		$url  = "https://pa.yunlaohu.cn/IPP3Swiftpass/WeiXinJsPayApi";
		$url  = C('SERVER_HOST')."Payment/Payments/GetUnifiedOrderResult";
//		$url  = "http://suibian.yunlaohu.cn/Payment/Payments/GetUnifiedOrderResult";
//				\Think\Log::record(json_encode($data));

		$list = http( $url, $data);
//		dump($list);exit;
//		\Think\Log::record(json_encode($list));
//		\Think\Log::record(json_encode($_GET));
		$this->assign('appId',$list['Data']['WxPayData']['m_values']['appId']);
		$this->assign('paySign',$list['Data']['WxPayData']['m_values']['paySign']);
		$this->assign('package',$list['Data']['WxPayData']['m_values']['package']);
		$this->assign('out_trade_no',$list['Data']['WxPayData']['m_values']['out_trade_no']);
		$this->assign('signType',$list['Data']['WxPayData']['m_values']['signType']);
		$this->assign('timeStamp',$list['Data']['WxPayData']['m_values']['timeStamp']);
		$this->assign('nonceStr',$list['Data']['WxPayData']['m_values']['nonceStr']);
		$this->assign('callback',$_GET['callback']);
		$this->assign('out_trade_no',$_GET['out_trade_no']);
        $this->display();

    }
	public function weixin_o(){

//		$oldtime = '20171023105000';
		$posttime = $this->aes($_GET['datetime']);
		if($_GET['datetime']==""){
		$Qrcode_data = "http://web.yunlaohu.cn/index.php/Wft/pay_extends?id=".urlencode($_GET['id'])."&datetime=".urlencode($_GET['datetime'])."&amount=".urlencode($_GET['amount'])."&out_trade_no=".urlencode($_GET['out_trade_no'])."&callback=".urlencode($_GET['callback']);
		}else{
			if((time()-strtotime($posttime))>180){
				$this->redirect("Base/istrue");
				return false;
			}
$Qrcode_data = "http://web.yunlaohu.cn/index.php/Wft/pay_extends?id=".urlencode($_GET['id'])."&datetime=".urlencode($_GET['datetime'])."&amount=".urlencode($_GET['amount'])."&out_trade_no=".urlencode($_GET['out_trade_no'])."&callback=".urlencode($_GET['callback']);
		}

		$data['systemUserSysNo']=$this->aes($_GET['id']);
		$data['body']="";
		$data['sub_openid']=$this->GetOpenId();
		$data['total_fee']=yuan2fee(($this->aes($_GET['amount'])));
		$data['callback_url']="web.yunlaohu.cn/index.php/Wft/jsapi";
		$data['out_trade_no']=(string)$this->aes($_GET['out_trade_no']);
//		$url  = "https://pos.yunlaohu.cn/IPP3Swiftpass/WeiXinJsPayApi";
		$url  = C('SERVER_HOST')."IPP3Swiftpass/WeiXinJsPayApi";
//				\Think\Log::record(json_encode($data));

		$list = http( $url, $data);
//		\Think\Log::record(json_encode($list));
//		\Think\Log::record(json_encode($_GET));
		$this->assign('appId',$list['Data']['PayData']['appId']);
		$this->assign('paySign',$list['Data']['PayData']['paySign']);
		$this->assign('package',$list['Data']['PayData']['package']);
		$this->assign('out_trade_no',$list['Data']['PayData']['out_trade_no']);
		$this->assign('signType',$list['Data']['PayData']['signType']);
		$this->assign('timeStamp',$list['Data']['PayData']['timeStamp']);
		$this->assign('nonceStr',$list['Data']['PayData']['nonceStr']);
		$this->assign('callback',$_GET['callback']);
		$this->assign('out_trade_no',$_GET['out_trade_no']);
		$this->assign('Qrcode_data',$Qrcode_data);
        $this->display();

    }

	public function pay_extend(){
		$posttime = $this->aes($_GET['datetime']);
		if($_GET['datetime']==""){
		$Qrcode_data = "http://web.yunlaohu.cn/index.php/Wft/weixin?id=".urlencode($_GET['id'])."&datetime=".urlencode($_GET['datetime'])."&amount=".urlencode($_GET['amount'])."&out_trade_no=".urlencode($_GET['out_trade_no'])."&callback=".urlencode($_GET['callback']);
		}else{
			if((time()-strtotime($posttime))>180){
				$this->redirect("Base/istrue");
				return false;
			}
$Qrcode_data = "http://web.yunlaohu.cn/index.php/Wft/weixin?id=".urlencode($_GET['id'])."&datetime=".urlencode($_GET['datetime'])."&amount=".urlencode($_GET['amount'])."&out_trade_no=".urlencode($_GET['out_trade_no'])."&callback=".urlencode($_GET['callback']);
		}
		$Qrcode_Url= "http://".$_SERVER['HTTP_HOST']. "/index.php/Qrcode/qrcode?url=".urlencode($Qrcode_data);

		$data['systemUserSysNo']=$this->aes($_GET['id']);
		$data['body']="";
		$data['sub_openid']=$this->GetOpenId();
		$data['total_fee']=yuan2fee(($this->aes($_GET['amount'])));
		$data['callback_url']="web.yunlaohu.cn/index.php/Wft/jsapi";
		$data['out_trade_no']=(string)$this->aes($_GET['out_trade_no']);
//		$url  = "https://pos.yunlaohu.cn/IPP3Swiftpass/WeiXinJsPayApi";
		$url  = C('SERVER_HOST')."IPP3Swiftpass/WeiXinJsPayApi";
//				\Think\Log::record(json_encode($data));

		$list = http( $url, $data);
//		\Think\Log::record(json_encode($list));
//		\Think\Log::record(json_encode($_GET));
		$this->assign('appId',$list['Data']['PayData']['appId']);
		$this->assign('paySign',$list['Data']['PayData']['paySign']);
		$this->assign('package',$list['Data']['PayData']['package']);
		$this->assign('out_trade_no',$list['Data']['PayData']['out_trade_no']);
		$this->assign('signType',$list['Data']['PayData']['signType']);
		$this->assign('timeStamp',$list['Data']['PayData']['timeStamp']);
		$this->assign('nonceStr',$list['Data']['PayData']['nonceStr']);
		$this->assign('callback',$_GET['callback']);
		$this->assign('out_trade_no',$_GET['out_trade_no']);
		$this->assign('total_fee',$data['total_fee']);
		$this->assign('Qrcode_Url',($Qrcode_Url));
        $this->display();
	}
	public function extend(){
//		$data['systemUserSysNo']=$this->aes($_GET['id']);
//		$data['out_trade_no']=$this->aes($_GET['out_trade_no']);
//		$url = "http://pos.yunlaohu.cn/IPP3Swiftpass/OrderQueryApi";
//		$list = http($url,$data);
//		if($list['Data'][''])
//dump($list);exit;
		header( "Location:http://web.yunlaohu.cn/index.php/Wft/pay_extend?id=".urlencode($_GET['id'])."&datetime=".urlencode($_GET['datetime'])."&amount=".urlencode($_GET['amount'])."&out_trade_no=".urlencode($_GET['out_trade_no'])."&callback=".urlencode($_GET['callback'])."");
		$this->display();
	}
	public function extend_o(){
		$data['systemUserSysNo']=$this->aes($_GET['id']);
		$data['out_trade_no']=$this->aes($_GET['out_trade_no']);
		$url = "http://pos.yunlaohu.cn/IPP3Swiftpass/OrderQueryApi";
		$list = http($url,$data);
		if(($list['Data']['WxPayData']['result_code']==1&&$list['Data']['WxPayData']['err_code']=='Order not exists')||($list['Data']['WxPayData']['result_code']==0&&$list['Data']['WxPayData']['trade_state']=='NOTPAY')){
				

		}else{
		$this->redirect("Base/istrue",array('message'=>2));
				return false;
		}

		header( "Location:http://web.yunlaohu.cn/index.php/Wft/weixin_o?id=".urlencode($_GET['id'])."&datetime=".urlencode($_GET['datetime'])."&amount=".urlencode($_GET['amount'])."&out_trade_no=".urlencode($_GET['out_trade_no'])."&callback=".urlencode($_GET['callback'])."");
		$this->display();
	}
	public function pay_extends(){
		$posttime = $this->aes($_GET['datetime']);
		if($_GET['datetime']==""){
		$Qrcode_data = "http://web.yunlaohu.cn/index.php/Wft/weixin?id=".urlencode($_GET['id'])."&datetime=".urlencode($_GET['datetime'])."&amount=".urlencode($_GET['amount'])."&out_trade_no=".urlencode($_GET['out_trade_no'])."&callback=".urlencode($_GET['callback']);
		}else{
			if((time()-strtotime($posttime))>180){
				$this->redirect("Base/istrue");
				return false;
			}
$Qrcode_data = "http://web.yunlaohu.cn/index.php/Wft/weixin?id=".urlencode($_GET['id'])."&datetime=".urlencode($_GET['datetime'])."&amount=".urlencode($_GET['amount'])."&out_trade_no=".urlencode($_GET['out_trade_no'])."&callback=".urlencode($_GET['callback']);
		}
		$Qrcode_Url= "http://".$_SERVER['HTTP_HOST']. "/index.php/Qrcode/qrcode?url=".urlencode($Qrcode_data);

		$data['systemUserSysNo']=$this->aes($_GET['id']);
		$data['body']="";
		$data['sub_openid']=$this->GetOpenId();
		$data['total_fee']=yuan2fee(($this->aes($_GET['amount'])));
		$data['callback_url']="web.yunlaohu.cn/index.php/Wft/jsapi";
		$data['out_trade_no']=(string)$this->aes($_GET['out_trade_no']);
//		$url  = "https://pos.yunlaohu.cn/IPP3Swiftpass/WeiXinJsPayApi";
		$url  = C('SERVER_HOST')."IPP3Swiftpass/WeiXinJsPayApi";
//				\Think\Log::record(json_encode($data));

		$list = http( $url, $data);
//		\Think\Log::record(json_encode($list));
//		\Think\Log::record(json_encode($_GET));
		$this->assign('appId',$list['Data']['PayData']['appId']);
		$this->assign('paySign',$list['Data']['PayData']['paySign']);
		$this->assign('package',$list['Data']['PayData']['package']);
		$this->assign('out_trade_no',$list['Data']['PayData']['out_trade_no']);
		$this->assign('signType',$list['Data']['PayData']['signType']);
		$this->assign('timeStamp',$list['Data']['PayData']['timeStamp']);
		$this->assign('nonceStr',$list['Data']['PayData']['nonceStr']);
		$this->assign('callback',$_GET['callback']);
		$this->assign('out_trade_no',$_GET['out_trade_no']);
		$this->assign('total_fee',$data['total_fee']);
		$this->assign('Qrcode_Url',($Qrcode_Url));
        $this->display();
	}
	private function aes($de){
		$privateKey = "1234qwer5678asda";
		$iv     = "yCJXKLv4GvySreYK";
		$encryptedData = base64_decode($de);
		$decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $privateKey, $encryptedData, MCRYPT_MODE_CBC, $iv);
		return trim($decrypted);
	}
	public function recharge(){
		$url  = C('SERVER_HOST')."IPP3Customers/IPP3DYC_Money_TypeList";
//		$url  = "https://pos.yunlaohu.cn/IPP3Customers/IPP3DYC_Money_TypeList";
        $data = json_encode( $data );
        $head = array(
            "Content-Type:application/json;charset=UTF-8",
            "Content-length:".strlen( $data ),
            //"X-Ywkj-Authentication:" . strlen( $data )
        );
		$list = http_request( $url, $data, $head );
		$data = json_decode($list,true);
		$this->assign("openid",$this->GetOpenId());
		$this->assign("systemUserSysNo",5193);
		$this->assign("data",$data);
		$this->display();
	}
	public function recharge_jsapi(){
//		\Think\Log::record(json_encode($_POST));
			$data['systemUserSysNo']=I('systemUserSysNo');
			$data['body']="";
			$data['attach']="1|".I('company')."|".I('contact')."|".I('num')."|".I('mobile');
			$data['sub_openid']=I('openid');
			$data['total_fee']=yuan2fee(I('fee'));
			$data['callback_url']="web.yunlaohu.cn/index.php/Wft/jsapi";
//			$url  = "https://pos.yunlaohu.cn/IPP3Swiftpass/WeiXinJsPayApi";
			$url  = C('SERVER_HOST')."IPP3Swiftpass/WeiXinJsPayApi";
			$data = json_encode( $data );
			$head = array(
				"Content-Type:application/json;charset=UTF-8",
				"Content-length:".strlen( $data ),
				//"X-Ywkj-Authentication:" . strlen( $data ),
			);
			$list = http_request( $url, $data, $head );
//			\Think\Log::record($list);
			$list = json_decode($list,true);
			$this->assign('appId',$list['Data']['PayData']['appId']);
			$this->assign('paySign',$list['Data']['PayData']['paySign']);
			$this->assign('package',$list['Data']['PayData']['package']);
			$this->assign('out_trade_no',$list['Data']['PayData']['out_trade_no']);
			$this->assign('signType',$list['Data']['PayData']['signType']);
			$this->assign('timeStamp',$list['Data']['PayData']['timeStamp']);
			$this->assign('nonceStr',$list['Data']['PayData']['nonceStr']);
			$this->display();
	
	
	
	}
	public function jsapi1(){
//		\Think\Log::record(json_encode($_POST));
			$data['systemUserSysNo']=2406;
			$data['body']="";
			$data['attach']="1|云网|13044443333|444333|13044443333";

			$data['sub_openid']='otXptweENZr-trzek4EciizLZnl4';
			$data['total_fee']=2;
			$data['callback_url']="web.yunlaohu.cn/index.php/Wft/jsapi";
			$url  = C('SERVER_HOST')."IPP3Swiftpass/WeiXinJsPayApi";
			$url  = "http://pos.yunlaohu.cn/IPP3Swiftpass/WeiXinJsPayApi";
			$data = json_encode( $data );
			$head = array(
				"Content-Type:application/json;charset=UTF-8",
				"Content-length:".strlen( $data ),
				//"X-Ywkj-Authentication:" . strlen( $data ),
			);
			$list = http_request( $url, $data, $head );
//			\Think\Log::record($list);
			$list = json_decode($list,true);
			$this->assign('appId',$list['Data']['PayData']['appId']);
			$this->assign('paySign',$list['Data']['PayData']['paySign']);
			$this->assign('package',$list['Data']['PayData']['package']);
			$this->assign('out_trade_no',$list['Data']['PayData']['out_trade_no']);
			$this->assign('signType',$list['Data']['PayData']['signType']);
			$this->assign('timeStamp',$list['Data']['PayData']['timeStamp']);
			$this->assign('nonceStr',$list['Data']['PayData']['nonceStr']);
			$this->display();
	
	
	
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
        $this->data = $data;
        $openid = $data['openid'];
        return $openid;
    }





}