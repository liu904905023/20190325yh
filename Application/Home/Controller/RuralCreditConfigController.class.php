<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/25
 * Time: 13:14
 */

namespace Home\Controller;

use Common\Compose\Base;

class RuralCreditConfigController extends Base
{
    public function index()
    {
        if (IS_POST) {
            if ((session('data')['CustomersType'] == 0 & session('flag') == 0)) {

                /*插入之前先查询，看看数据库中是否有该数据*/
                $Query_Url =  C('SERVER_HOST') . "IPP3Customers/RuralCreditConfigQuery";
                $Query_Data['CustomerServiceSysNo'] = session('data')['SysNo'];
                $Query_Return = http($Query_Url, $Query_Data);
                if($Query_Return['data']){
                   /*执行插入修改接口*/
                }else{
                    $Insert_Url  = C('SERVER_HOST') . "IPP3Customers/RuralCreditConfigAdd";
                    $Insert_Data = array(
                        'OrgId'                => I('OrgId', '', 'htmlspecialchars'),
                        'ChannelFlag'          => I('ChannelFlag', '', 'htmlspecialchars'),
                        'Public_key'           => I('Public_key', '', 'htmlspecialchars'),
                        'Private_key'          => I('Private_key', '', 'htmlspecialchars'),
                        'CustomerServiceSysNo' => session('data')['SysNo']
                    );
                    $Insert_Return = http($Insert_Url, $Insert_Data);
                    $this->ajaxReturn( $arrData );;
                }
                exit();
                $Insert_Url  = C('SERVER_HOST') . "IPP3Customers/RuralCreditConfigAdd";
                $Insert_Data = array(
                    'OrgId'                => I('OrgId', '', 'htmlspecialchars'),
                    'ChannelFlag'          => I('ChannelFlag', '', 'htmlspecialchars'),
                    'Public_key'           => I('Public_key', '', 'htmlspecialchars'),
                    'Private_key'          => I('Private_key', '', 'htmlspecialchars'),
                    'CustomerServiceSysNo' => session('data')['SysNo']
                );

                echo 111;
                exit();
//                $url  = C( 'SERVER_HOST' ) . "IPP3Customers/IPP3CustomerConfigEdit";
//                $arr  = array(
//                    "CustomerServiceSysNO" => session( 'data' )['SysNo'],
//                    "APPID"                => I( 'sx_appid', '', 'htmlspecialchars' ),
//                    "NCHID"                => I( 'sx_fwsbh', '', 'htmlspecialchars' ),
//                    "KEY"                  => I( 'sx_shkey', '', 'htmlspecialchars' ),
//                    "APPSECRET"            => I( 'sx_appsecret', '','htmlspecialchars' ),
//                    "sub_mch_id"           => (int) I( 'sx_zshid', '','htmlspecialchars' ),
//                    "SSLCERT_PATH"         => I( 'safe', '','htmlspecialchars' ),
//                    "Status"               => 0,
//                    "SSLCERT_PASSWORD"     => (int) I( 'sx_pass', '','htmlspecialchars' ),
//                );
//                $arrData  = http( $url, $arr );
//                $this->ajaxReturn( $arrData );
//                exit();
            } else {
                $arrData['Code']        = 1;
                $arrData['Description'] = "该角色无权限,进行该操作!";
                $this->ajaxReturn($arrData);
                exit();
            }
        } else {

        }


        $this->display();

    }

}