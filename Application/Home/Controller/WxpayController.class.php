<?php
// +----------------------------------------------------------------------
// | 设计开发：Webster  Tel:17095135002 邮箱：312549912@qq.com
// | 此版本为微信官方最新微信支付V3版本
// +----------------------------------------------------------------------
namespace Home\Controller;
use Think\Controller;
class WxpayController extends Controller {
	protected function _initialize(){
		//全局引入微信支付类

    	Vendor('WxpayV3.WxPayPubHelper');
    	Vendor('WxpayV3.WxPayOut');
	}
	public function newpay(){
		$tools = new \JsApiPay();
		$systemUserSysNo=I('systemUserSysNo');//2--zijian 2406--zijian123--104 3402--xujiang123--106
		$data['systemUserSysNo'] = $systemUserSysNo;
		$url  = C('SERVER_HOST')."IPP3Customers/GetPayConfig";
		$list = http( $url, $data);
		$Customer=$list['CustomerSystemUserBase']['CustomerName'];
		$systemUserName=$list['CustomerSystemUserBase']['DisplayName'];
		$Switch=$list['CustomerSystemUserBase']['Switch'];
//		\Think\Log::record("日志".$Switch );
		cookie('appid',$list['WXConfig']['APPID']);
		cookie('mchid',$list['WXConfig']['NCHID']);
		cookie('key',$list['WXConfig']['KEY']);
		cookie('appsecret',$list['WXConfig']['APPSECRET']);
		cookie('sub_mch_id',$list['WXConfig']['sub_mch_id']);
		cookie('systemUserSysNo',$systemUserSysNo);
		cookie('openId',$tools->GetOpenid());
		//\Think\Log::record("日志".cookie('openId') );
		$this->assign('Customer',$Customer);
		$this->assign('systemUserSysNo',$systemUserName);
		$this->assign('Switch',$Switch);
		$this->display();	
	
	}
	public function newpay1(){
		$tools = new \JsApiPay();
		$systemUserSysNo=I('systemUserSysNo');//2--zijian 2406--zijian123--104 3402--xujiang123--106
		$data['systemUserSysNo'] = $systemUserSysNo;
		$url  = "http://suibian.yunlaohu.cn/IPP3Customers/GetPayConfig";
//		$url  = C('SERVER_HOST')."IPP3Customers/GetPayConfig";
		$list = http( $url, $data);
//		dump($list);exit;
		$Customer=$list['CustomerSystemUserBase']['CustomerName'];
		$systemUserName=$list['CustomerSystemUserBase']['DisplayName'];
		$Switch=$list['CustomerSystemUserBase']['Switch'];
//		\Think\Log::record("日志".$Switch );
		cookie('appid',$list['WXConfig']['APPID']);
		cookie('mchid',$list['WXConfig']['NCHID']);
		cookie('key',$list['WXConfig']['KEY']);
		cookie('appsecret',$list['WXConfig']['APPSECRET']);
		cookie('sub_mch_id',$list['WXConfig']['sub_mch_id']);
		cookie('systemUserSysNo',$systemUserSysNo);
		cookie('openId',$tools->GetOpenid());
		//\Think\Log::record("日志".cookie('openId') );
		$this->assign('Customer',$Customer);
		$this->assign('systemUserSysNo',$systemUserName);
		$this->assign('Switch',$Switch);
		$this->display();	
	
	}
	//JSAPI支付 V3版本微信支付
    public function jsapi(){
		
    	//①、获取用户openid
		$fee = yuan2fee($_POST['amount']);
		$openId = cookie('openId');
		$systemUserSysNo=(string)cookie('systemUserSysNo');
		$CustomInfo = GetCustomerInfoBySysNo($systemUserSysNo);
		$Customname = $CustomInfo['CustomerName'];
		$CustomSysNo = $CustomInfo['CustomerSysNo'];
		$Switch = I('Switch');
		$tools = new \JsApiPay();
		
		//$openId = $tools->GetOpenid();

		//②、统一下单
		$input = new \WxPayUnifiedOrder();
		$Randoms = new \Random();
		$Out_trade_no = $Randoms->GenerateOutTradeNo($systemUserSysNo);
		$input->SetBody("$Customname");
		$input->SetAttach("$systemUserSysNo");
		$input->SetOut_trade_no("$Out_trade_no");
		$input->SetTotal_fee("$fee");
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("test");
		$input->SetNotify_url("http://payapi.yunlaohu.cn/IPP3Order/Notify");
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openId);
		
		$order = \WxPayApi::unifiedOrder($input);
		
		//echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
		$jsApiParameters = $tools->GetJsApiParameters($order);
		//获取共享收货地址js函数参数
		//$editAddress = $tools->GetEditAddressParameters();
		$Ad_Info['UserId'] = $openId;
		$Ad_Info['Fee'] = $_POST['amount'];
		$Ad_Info['CustomerName'] = urlencode($Customname);
		$Ad_Info['AppId'] = 'wx261671a6d70c4db5';
		$Ad_Info['systemUserSysNo'] = $systemUserSysNo;
		$this->assign('Ad_Info',$Ad_Info);
		$this->assign('Switch',$Switch);
		$this->assign('jsApiParameters',$jsApiParameters);

		$this->display();	
		$this->postlog($CustomSysNo,$systemUserSysNo,$fee,$Out_trade_no);
    }
	public function jsapi123(){
		
    	//①、获取用户openid
		$fee = yuan2fee($_POST['amount']);
		$openId = cookie('openId');
		$systemUserSysNo=(string)cookie('systemUserSysNo');
		$CustomInfo = GetCustomerInfoBySysNo($systemUserSysNo);
		$Customname = $CustomInfo['CustomerName'];
		$CustomSysNo = $CustomInfo['CustomerSysNo'];
		$Switch = I('Switch');
		$tools = new \JsApiPay();
		
		//$openId = $tools->GetOpenid();

		//②、统一下单
		$input = new \WxPayUnifiedOrder();
		$Randoms = new \Random();
		$Out_trade_no = $Randoms->GenerateOutTradeNo($systemUserSysNo);
		$input->SetBody("$Customname");
		$input->SetAttach("$systemUserSysNo");
		$input->SetOut_trade_no("$Out_trade_no");
		$input->SetTotal_fee("$fee");
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("test");
		$input->SetNotify_url("http://payapi.yunlaohu.cn/IPP3Order/Notify");
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openId);
		
		$order = \WxPayApi::unifiedOrder($input);
		
		//echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
		$jsApiParameters = $tools->GetJsApiParameters($order);
		//获取共享收货地址js函数参数
		//$editAddress = $tools->GetEditAddressParameters();
		$Ad_Info['UserId'] = $openId;
		$Ad_Info['Fee'] = $_POST['amount'];
		$Ad_Info['CustomerName'] = urlencode($Customname);
		$Ad_Info['AppId'] = 'wx261671a6d70c4db5';
		$Ad_Info['systemUserSysNo'] = $systemUserSysNo;
		$this->assign('Ad_Info',$Ad_Info);
		$this->assign('Switch',$Switch);
		$this->assign('jsApiParameters',$jsApiParameters);

		$this->display();	
		$this->postlog($CustomSysNo,$systemUserSysNo,$fee,$Out_trade_no);
    }
	private function postlog($CustomerServiceSysNo,$SystemUserSysNo,$Total_fee,$Out_trade_no) {
        $data['CustomerServiceSysNo']=$CustomerServiceSysNo;
        $data['SystemUserSysNo']=$SystemUserSysNo;
        $data['Total_fee']=$Total_fee;
        $data['Out_trade_no']=$Out_trade_no;
        $data['Pay_Type']="102";
        $data = json_encode($data);
        $url = C('SERVER_HOST') ."/IPP3Order/IPP3So_MasterLog";
        $head = array("Content-Type:application/json;charset=UTF-8", "Content-length:" . strlen($data), "X-Ywkj-Authentication:" . strlen($data));
        $list = http_request( $url, $data, $head);
    }
    //扫码支付 模式一 模式二 V3版本微信支付
    public function native(){
		$status = session('status');
        if( !isset($status)){
            $this->redirect("Login/login");
        }else{
            R("Base/getMenu");
        }
//		R("Base/getMenu");
//		$systemUserSysNo =$_POST['syskeyno'];
//		$fee = yuan2fee($_POST['payfee']);
//		$data['systemUserSysNo'] =$systemUserSysNo;
//		$url  = C('SERVER_HOST')."IPP3Customers/IPP3WxconfigBySUsysNo";
//        $data = json_encode( $data );
//        $head = array(
//            "Content-Type:application/json;charset=UTF-8",
//            "Content-length:".strlen( $data ),
//            //"X-Ywkj-Authentication:" . strlen( $data ),
//        );
//
//        $list = http_request( $url, $data, $head );
//        $list = json_decode( $list ,true);
//		cookie('appid',$list['APPID']);
//		cookie('mchid',$list['NCHID']);
//		cookie('key',$list['KEY']);
//		cookie('appsecret',$list['APPSECRET']);
//		cookie('sub_mch_id',$list['sub_mch_id']);
//		cookie('systemUserSysNo',$systemUserSysNo);
//		$systemUserSysNo=(string)cookie('systemUserSysNo');
//    	//模式一
//    	/**
//    	 * 流程：
//    	 * 1、组装包含支付信息的url，生成二维码
//    	 * 2、用户扫描二维码，进行支付
//    	 * 3、确定支付之后，微信服务器会回调预先配置的回调地址，在【微信开放平台-微信支付-支付配置】中进行配置
//    	 * 4、在接到回调通知之后，用户进行统一下单支付，并返回支付信息以完成支付（见：native_notify.php）
//    	 * 5、支付完成之后，微信服务器会通知支付成功
//    	 * 6、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
//    	 */
//    	$notify = new \NativePay();
//    	
//    	//模式二
//    	/**
//    	 * 流程：
//    	 * 1、调用统一下单，取得code_url，生成二维码
//    	 * 2、用户扫描二维码，进行支付
//    	 * 3、支付完成之后，微信服务器会通知支付成功
//    	 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
//    	*/
//    	$input = new \WxPayUnifiedOrder();
//    	$input->SetBody("test");
//    	$input->SetAttach("$systemUserSysNo");
//    	$input->SetOut_trade_no(cookie('mchid').date("YmdHis").rand(100,999));
//    	$input->SetTotal_fee("$fee");
//    	$input->SetTime_start(date("YmdHis"));
//    	$input->SetTime_expire(date("YmdHis", time() + 600));
//    	$input->SetGoods_tag("test");
//    	$input->SetNotify_url("http://payapi.yunlaohu.cn/IPP3Order/Notify");
//    	$input->SetTrade_type("NATIVE");
//    	$input->SetProduct_id("123456789");
//    	$result = $notify->GetPayUrl($input);
////		var_dump($result);
//    	$url2 = $result["code_url"];
//    	$this->assign('url2',$url2);//扫码支付二
    	$this->display();
    }
    //刷卡支付 V3版本微信支付
    public function micropay(){
    	if(isset($_REQUEST["auth_code"]) && $_REQUEST["auth_code"] != ""){
    		$auth_code = $_REQUEST["auth_code"];
    		$input = new \WxPayMicroPay();
    		$input->SetAuth_code($auth_code);
    		$input->SetBody("刷卡测试样例-支付");
    		$input->SetTotal_fee("1");
    		$input->SetOut_trade_no(cookie('mchid').date("YmdHis"));
    	
    		$microPay = new \MicroPay();
    		dump($microPay->pay($input));
    	}
    	$this->display();
    }
	public function weixin(){
		if(IS_POST ){
		$fee = yuan2fee(I('money'));
		$Mobile = I('Mobile');
		$Product = I('Proudct');
		$Remark = I('Remark');
		$Number = I('Number');
		$ProductCount = I('ProductCount');
		$Name = I('Name');
		$openId = cookie('openId');
		$systemUserSysNo=(string)cookie('systemUserSysNo');
		if(empty($fee)||empty($Mobile)||empty($Product)||empty($systemUserSysNo)||empty($Number)||empty($Name)||empty($ProductCount)){
			return false;
		}else{
		
		}
//		$Product_Info = "{'goods_detail':[ { 'goods_id':'iphone6s_16G', 'wxpay_goods_id':'1001', 'goods_name':'iPhone6s 16G', 'quantity':1, 'price':528800, 'goods_category':'123456', 'body':'苹果手机' }]}";
//		$systemUserSysNo（主键）|$Name(姓名)|$Mobile（电话）|$Product（宽带）|$Number（学号）|$Remark（备注）|01（标记）
//		$Customname = GetCustomerServiceSysNo($systemUserSysNo);
		$tools = new \JsApiPay();
		$input = new \WxPayUnifiedOrder();
		$Randoms = new \Random();
		$Out_trade_no = $Randoms->GenerateOutTradeNo();
		$input->SetBody("$Product");
		$input->SetAttach("$systemUserSysNo|01|$Name|$Mobile|$Product|$Number|$Remark|$ProductCount");
//		$input->SetDetail("$Product_Info");
		$input->SetOut_trade_no("$Out_trade_no");
		$input->SetTotal_fee("$fee");
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("test");
		$input->SetNotify_url("http://payapi.yunlaohu.cn/IPP3Order/Notify");
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openId);
		$order = \WxPayApi::unifiedOrder($input);
		$info = json_encode( $input );
//		\Think\Log::record($info );
		$jsApiParameters = $tools->GetJsApiParameters($order);
		$this->assign('jsApiParameters',$jsApiParameters);

		
		}else{
			$tools = new \JsApiPay();
			$systemUserSysNo =3714;
			$data['systemUserSysNo'] =$systemUserSysNo;
			$url  = C('SERVER_HOST')."IPP3Customers/IPP3WxconfigBySUsysNo";
			$data = json_encode( $data );
			$head = array(
				"Content-Type:application/json;charset=UTF-8",
				"Content-length:".strlen( $data ),
				//"X-Ywkj-Authentication:" . strlen( $data ),
			);
//			$Customer = GetCustomerServiceSysNo($systemUserSysNo);
//			$systemUserName= QueryStaffInfo($systemUserSysNo);
			$list = http_request( $url, $data, $head );
			$list = json_decode( $list ,true);
			cookie('appid',$list['APPID']);
			cookie('mchid',$list['NCHID']);
			cookie('key',$list['KEY']);
			cookie('appsecret',$list['APPSECRET']);
			cookie('sub_mch_id',$list['sub_mch_id']);
			cookie('systemUserSysNo',$systemUserSysNo);
			cookie('openId',$tools->GetOpenid());
//			$this->assign('Customer',$Customer);
//			$this->assign('systemUserSysNo',$systemUserName);
		}
		
		$this->display();	
	
	}
}