<?php 
session_start();
//echo urlencode('http://peterxu.s1.natapp.cc/wechat/login.php');

//$url='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxff92185282f6a37c&redirect_uri=http%3A%2F%2Fpeterxu.s1.natapp.cc%2Fwechat%2Flogin.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';



/*
//获取code
http://peterxu.s1.natapp.cc/wechat/login.php?code=051pOhy60r2ydH1gQJx603ndy60pOhyW&state=STATE

//请求token
https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code=CODE&grant_type=authorization_code 

//拉取用户信息
https://api.weixin.qq.com/sns/userinfo?access_token=ACCESS_TOKEN&openid=OPENID&lang=zh_CN 

*/

header('content-type:text/html;charset=utf-8');
include 'Tool.php';
include 'xml.php';
include 'wx.php';
include 'Qrcode/Qrcode.php';
include 'Menu.php';
include 'Oauth/Oauth.php';



$json='{
     "button":[
     {	
          "type":"click",
          "name":"点击测试",
          "key":"V1001_TODAY_MUSIC"
      },
      {
           "type":"view",
           "name":"微信上墙",
           "url":"http://peterxu.s1.natapp.cc/wechat/wall/session.php",
           "sub_button":[]
     }]   
 }';

  
$obj=new wx();
$menu=$obj->menu;


$data=array (
	    array (
	      'type' => 'click',
	      'name' => '点击测试',
	      'key' => 'peter', //是推送的一个值
	    ),
	    array(
	      'type' => 'view',
	      'name' => '微信上墙',
	      'url' => 'http://peterxu.s1.natapp.cc/wechat/wall/session.php',
	      'sub_button' =>[]
	    )
);

var_dump($menu->add($data));
exit;
$obj=new wx();
$auth=$obj->oauth;
$config=[
    'appid'=>'wxff92185282f6a37c',
    'redirect_uri'=>'http://peterxu.s1.natapp.cc/wechat/test.php',
    'scope'=>'snsapi_userinfo',
    'appsecret'=>'5759e2f3dc26c9addcccd0a8f74498f3'
];




//不为空就已经授权不需要，再次授权
//如果都为空，那么就重新授权，否则就直接从session当中获取
//var_dump(empty($_SESSION['user']) && empty($user=$auth->config($config)->user()));

//假设用户信息能否获取，不能重新去授权
if(empty($_SESSION['user']) && empty($user=$auth->config($config)->user())){
	   $auth->config($config)->redirect(); //重新授权
}























/*
//生成临时二维码
$ticket=$Qrcode->temporary('wifi',5);
$url = $Qrcode->url($ticket->ticket);
$content = file_get_contents($url); // 得到二进制图片内容
file_put_contents(__DIR__ . '/code.jpg', $content); // 写入文件
*/


/*
$ticket=$Qrcode->forever('abc');
$url = $Qrcode->url($ticket->ticket);
$content = file_get_contents($url); // 得到二进制图片内容
file_put_contents(__DIR__ . '/code1.jpg', $content); // 写入文件
*/


?>


