<?php 
class Oauth extends Tool{
	 const API_CREATE='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=';

	 const API_TARGET='https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=STATE#wechat_redirect';
	 const API_GET_TOKEN='https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code';

	 const API_GET_INFO='https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN';	  
	
	 /*  
	 private $url;
	 private $appid;
	 private $appsecret;
	 private $redirect_uri;
	 private $scope;
	 */
	
	 /**
	  * [config 接收配置信息]
	  * @param  [type] $config [description]
	  * @return [type]         [description]
	  */
	 public function config($config){

	 		if(empty($config)){
	 			return '请正确传递参数';
	 		}
	 		//做一个映射数组，如果键存在就赋值，否则就不赋值
	 		$map=[''];
	 		//循环赋值相关的属性
	 		foreach ($config as $key => $value) {
	 					$this->$key=$value; //为属性赋值
	 					//$this->appid='123456';
	 		}
	 		return $this;
	 }

	 /**
	  * [redirect 跳转到授权链接处]
	  * @return [type] [description]
	  */
	 public function redirect(){
	 	//做判断，判断要使用的数据是否存在
	 	if(empty($this->appid) || empty($this->redirect_uri) || empty($this->scope)){
	 		return '回调参数传递有误';		
	 	}
	 	$this->url=sprintf(self::API_TARGET,$this->appid,urlencode($this->redirect_uri),$this->scope);
	 	
	 	if(!empty($this->url)){
	 		header('location:'.$this->url);
	 	}

	 }

	 /**
	  * [user 获取用户信息]
	  * @return [type] [description]
	  */
	 public function user(){
	 	 //参数判断是否存在
	 	if(isset($_GET['code'])){
	 		$code=$_GET['code'];
	 		$token_url=sprintf(self::API_GET_TOKEN,$this->appid,$this->appsecret,$code);
	 		$token=$this->parse_data($token_url); //或得到授权令牌
	 		
	 		if($token->scope=='snsapi_userinfo'){
	 			$info_url=sprintf(self::API_GET_INFO,$token->access_token,$token->openid);
	 		    $info=$this->parse_data($info_url); //拉取用户信息
	 		    return $info;
	 		}
	 		return $token->openid;
	 	 }else{
	 	 	return '';
	 	 }
	 	

	 }




}