<?php
header('content-type:text/html;charset=utf-8');
define('TOKEN','peter'); //跟微信平台上所填写的token必须一致
include 'Exception/Error.php';
include 'Tool.php'; //先包含的
include 'xml.php';
include 'Menu.php';
include 'Material/Material_tmp.php';
include 'Material/Material.php';
include 'User/tag.php';
include 'User/User.php';
include 'broadcast/broadcast.php';
include 'staff/Staff.php';
include 'staff/Custom.php';
include 'staff/Session.php';
include 'db.php';
include 'Text.php';
include 'wx.php';



$obj=new Wx();
$obj->setMessageHandle(function($message){
    
     if($message->Event=='SCAN'){ //用户扫码之后才进入到的公众好
        //抽奖、记录渠道、绑定账号（分销商城）
        $xml=(new Text)->handleText($message,$message->EventKey);
        return $xml;
     }

    
     $xml=(new Text)->handleText($message,'你好');
     return $xml;
});







/*查询快递*/
function getExpress($nu){
   if(empty($nu)){
        return '单号为空';
   }
  //帮助识别物流公司类型
   $url='http://www.kuaidi100.com/autonumber/autoComNum?text='.$nu;
   $com=json_decode(file_get_contents($url),true);
   $type=''; //公司类型
   $url='http://www.kuaidi100.com/query?type='.$com['auto'][0]['comCode'].'&postid=402228116006';
   $res=json_decode(file_get_contents($url),true);
   krsort($res); 
   $str='';
   foreach ($res['data'] as $key => $value) {
      $str.="{$value['time']}\r\n{$value['context']}\r\n";
   }
   return $str;
}


function weather(){
        $location=urlencode('长沙');
        $url='http://api.map.baidu.com/telematics/v3/weather?location='.$location.'&output=json&ak=T6wxGlZ0C5PPsPXIVqsBDF6d';
        $res=json_decode(file_get_contents($url),true);  //get请求
        $weatherArray[]=['Title'=>$res['results'][0]['currentCity'].'天气预报','Description'=>'','PicUrl'=>'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1498147049841&di=6380d69e8ebe98a1e9878dc7efe72309&imgtype=0&src=http%3A%2F%2Fimg.tupianzj.com%2Fuploads%2Fallimg%2F160415%2F9-1604150U328.jpg','url'=>''];
        foreach ($res['results'][0]['weather_data'] as  $value) {
            $weatherArray[]=['Title'=>$value['date'].' '.$value['weather'].$value['wind'].' '.$value['temperature'],'Description'=>'','PicUrl'=>$value['dayPictureUrl'],'url'=>''];
        }
    return $weatherArray;
}

?>