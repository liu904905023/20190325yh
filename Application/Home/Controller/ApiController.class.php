<?php

namespace Home\Controller;

use Think\Controller;

class ApiController extends Controller{

    public function index2(){

        $SysNo = I('SysNo');
        Vendor('WxpayV3.WxAccount');
        if(SESSION('flag')==0){
            $CusetomeSysNo = SESSION('SysNO');
        }else if(SESSION('flag')==1){
            $CusetomeSysNo = session('servicestoreno');
        }
        $str = "CusetomeSysNo_".$CusetomeSysNo."_SystemSysNo_".$SysNo;
        if(I('DeletClear')==1){
            $str = "CusetomeSysNo_".$CusetomeSysNo."_SystemSysNo_".$SysNo."_DeletClear_1";
        }
        $coco =$this->QueryToken($CusetomeSysNo);
        $result = $this->getTicket( $str ,$coco );

        $info['ticket']   = $result['ticket'];
        $info['codeurl'] = $result['codeurl'];
        $codeurl          = urlencode( $info['codeurl'] );
        $this -> ajaxreturn($codeurl);
    }
    public function index3(){
        $SysNo = SESSION('SysNO');
        Vendor('WxpayV3.WxAccount');
        if(SESSION('flag')==0){
            $CusetomeSysNo = SESSION('SysNO');
        }else if(SESSION('flag')==1){
            $CusetomeSysNo = session('servicestoreno');
        }
        $str = "CusetomeSysNo_".$CusetomeSysNo."_SystemSysNo_".$SysNo;
        if(I('DeletClear')==1){
            $str = "CusetomeSysNo_".$CusetomeSysNo."_SystemSysNo_".$SysNo."_DeletClear_1";
        }
        $coco =$this->QueryToken($CusetomeSysNo);
        $result = $this->getTicket( $str ,$coco );
        $info['ticket']   = $result['ticket'];
        $info['codeurl'] = $result['codeurl'];
        $codeurl          = urlencode( $info['codeurl'] );
        $this -> ajaxreturn($codeurl);
    }


    public function getTicket( $mch_id = NULL,$token ){

        if( empty( $mch_id ) ){
            return FALSE;
            exit();
        }
        $wx                = new \WxAccount();
        $barcode['action_info']['scene']['scene_str'] = $mch_id;
        $barcode['action_name']                       = 'QR_LIMIT_STR_SCENE';
        $res = $wx->barCodeCreateFixed( $barcode,$token );
        $data['ticket']  = $res['ticket'];
        $data['codeurl'] = $res['url'];
        return $data;
    }
    public function index(){

        if( isset( $_GET['echostr'] ) ){
            $this->valid();
        }else{
            $this->responseMsg();
        }
    }

    public function valid(){
        $echoStr = $_GET["echostr"];

        if( $this->checkSignature() ){
            ob_clean();

            echo $echoStr;
            exit;
        }
    }

    public function responseMsg(){
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
 $postObj = simplexml_load_string( $postStr, 'SimpleXMLElement',
                LIBXML_NOCDATA );

        //extract post data
        if( !empty( $postStr ) ){
				$textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
<FuncFlag>%d</FuncFlag>
</xml>";
        $resultStr = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, time(), 0, 0);
		//\Think\log::record($resultStr);
        return $resultStr;
		

        }
    }



    private function reText( $data ){
        $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
        $msgType = "text";
        $contentStr = trim($data['content']);
        $resultStr = sprintf( $textTpl, $data['fromUsername'],$data['toUsername'], NOW_TIME, $msgType, $contentStr);
        var_dump($resultStr);
//		        \Think\log::record($resultStr);

		exit();
    }



    private function checkSignature(){
        // you must define TOKEN by yourself
        /* if( !defined( "TOKEN" ) ){
             throw new Exception( 'TOKEN is not defined!' );
         }*/

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce     = $_GET["nonce"];

        $token  = "D8g14207Q2q83Z2go3B1Bf332GgOo8Q3";
        $tmpArr = array( $token,$timestamp,$nonce );
        // use SORT_STRING rule
        sort( $tmpArr, SORT_STRING );
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    private function CheckClear($SystemUserSysNO,$Openid){
        $arr1  = array(
            "SystemUserSysNO" => $SystemUserSysNO,
            "Openid" => (string)$Openid,

        );

        $url = C( 'SERVER_HOST' ) . "IPP3Order/IPP3TemplateMessageList";
        $info = json_encode( $arr1 );
        $head = array(
            "Content-Type:application/json;charset=UTF-8",
            "Content-length:" . strlen( $info )
        );
        $res  = http_request( $url, $info, $head );
        $arrData = json_decode($res,TRUE);

        return $arrData;


    }

    private function AddClear($CustomerServiceSysNO,$Openid,$SystemSysNO){

        $clearinfo = array(

            "CustomerServiceSysNO" => $CustomerServiceSysNO,
            "Openid" => (string)$Openid,
            "SystemUserSysNO" => $SystemSysNO,

        );
        $url = C( 'SERVER_HOST' ) . "IPP3Order/IPP3TemplateMessageInsert";
        $info = json_encode( $clearinfo );
        $head = array(
            "Content-Type:application/json;charset=UTF-8",
            "Content-length:" . strlen( $info )
        );
        $res  = http_request( $url, $info, $head );

        return $res;

    }

    private function DeleteClear($openid,$SystemSysNO){

        $data['Openid'] = (string)$openid;
        $data['SystemUserSysNO'] = $SystemSysNO;
        $url = C( 'SERVER_HOST' ) . "IPP3Order/IPP3TemplateMessageDel";
        $info = json_encode( $data );
        $head = array(
            "Content-Type:application/json;charset=UTF-8",
            "Content-length:" . strlen( $info )
        );
        $res  = http_request( $url, $info, $head );

        return $res;


    }

    private function QueryToken($CustomerServiceSysNO){

        $data['CustomerServiceSysNO']=$CustomerServiceSysNO;
        $url = C( 'SERVER_HOST' ) . "Payment/Payments/GetToken";
        $info = json_encode( $data );
        $head = array(
            "Content-Type:application/json;charset=UTF-8",
            "Content-length:" . strlen( $info )
        );
        $res = http_request( $url, $info, $head );
        $res = json_decode($res,true);

        return $res['Description'];


    }
    //回复图文消息
    private function transmitNews($object, $newsArray)
    {
        if(!is_array($newsArray)){
            return;
        }
        $itemTpl = "    <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
		</item>
		";
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $xmlTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[news]]></MsgType>
		<ArticleCount>%s</ArticleCount>
		<Articles>
		$item_str</Articles>
		</xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        echo $result;
		exit;
    }

}
