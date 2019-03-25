<?php
namespace Home\Controller;

use Think\Controller;

//use Common\Compose\Base;

class ExtendController extends Controller {

    public function querybalance() {
		$data['CardNumber']=I('CardNum');
		$url = C('SERVER_HOST')."IPP3PoliceCard/QueryBalance";
		$list = http($url,$data);
		if($list['Code']==0){
			$returnList['Code']=$list['Code'];
			$returnList['Data']['balance']=fee2yuan($list['Data']['balance']);
		}else{
		$returnList=$list;
		}
        $this->ajaxreturn($returnList);
    }

    
}

