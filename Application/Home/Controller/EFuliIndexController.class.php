<?php
namespace Home\Controller;
use Think\Controller;

class EFuliIndexController extends Controller {
    public function index() {
        $data = GetCustomerInfoBySysNo(I('systemUserSysNo'));
        $Query_Data['CustomerTopSysNo'] =  $data['CustomersTopSysNo'];
//      $Query_Data['CustomerTopSysNo'] =  $data['CustomersTopSysNo'];
        $Query_Url = 'http://suibian.yunlaohu.cn/IPP3EFuli/EFuli_Money_TypeList';
        //        $Query_Url = C('SERVER_HOST').'IPP3EFuli/EFuli_Money_TypeList';
        $Query_List = http($Query_Url, $Query_Data);
        foreach($Query_List['Data'] as $key=>$row){
            foreach($row as $k =>$v) {
                if($k=='Money'){
                    $temp[$key]['SysNo'] = $row['SysNo'];
                    $temp[$key]['Field_One'] = fee2yuan($row['Field_One']);
                    $temp[$key]['Money'] = fee2yuan($v);
                }
            }
        }
        $this->assign('data',$temp);
        $this->display();
    }

    public function explain() {
        $this->display();
    }

    public function cashCoupon() {
        R("EFuliIndex/index");
    }

   


}

