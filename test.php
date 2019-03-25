<?php
//class Aes{
//    private $privateKey;
//    private $iv;
//    function __construct($privateKey,$iv){
//        $this->privateKey=$privateKey;
//        $this->iv=$iv;
//    }
//    function encrypt($data){
//
//        $encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->privateKey, $data, MCRYPT_MODE_CBC, $this->iv);
//        return urlencode(base64_encode($encrypted));
//    }
//
//    function decrypt($data){
//        $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->privateKey, base64_decode(urldecode($data)), MCRYPT_MODE_CBC, $this->iv);
//        return $decrypted;
//    }
//}
//
//$privateKey = "1234qwer5678asda";
//$iv     = "yCJXKLv4GvySreYK";
//$Aes = new Aes($privateKey,$iv);
//echo $encryptedData = $Aes->encrypt("hello word");
//echo "id<br/>";
//echo $Aes->decrypt('sU3ou%2BRDlK5Ed582ksxYLA%3D%3D');
//echo "amount<br/>";
//echo $Aes->decrypt('iZ%2Fd3f0ntUAnHdziEUx8bA%3D%3D');
//echo "out_trade_no<br/>";
//echo $Aes->decrypt('cE2ZPG1IUq9rwSrklxs7EJjeymtm9Zm5Ei9Ewa6MGKYHn6L4PeFUXlM%2FfNZeNLxYQ5OGmPPdoSa8DOPHLWfxneMBf19lyN0DDf8srKkT3UA%3D');
//echo "<br/>";

//
$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
$URL['PHP_SELF'] = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['ORIG_PATH_INFO']);   //当前页面名称
            $URL['DOMAIN'] = $_SERVER['SERVER_NAME'];  //域名(主机名)
            $URL['QUERY_STRING'] = $_SERVER['QUERY_STRING'];   //URL 参数
            $URL['URI'] = $URL['PHP_SELF'].($URL['QUERY_STRING'] ? "?".$URL['QUERY_STRING'] : "");
            $baseUrl = urlencode($http_type.$URL['DOMAIN'].$URL['PHP_SELF'].($URL['QUERY_STRING'] ? "?".$URL['QUERY_STRING'] : ""));
echo $baseUrl;exit;
