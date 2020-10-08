<?php
  /*工具类，执行相关的操作*/
  class Tool{
  	public $access_token;
 	public function __construct(){
 	 		$this->access_token=$this->getToken();
 	}
    public function getToken(){
 	 	 $res=@file_get_contents('access_token.json');
 	 	 $result=json_decode($res,true);
 	 	 $expires_time= $result['expires_time'];
 	 	 $token=$result['access_token'];
 	 	 //如果超过了有效时间，那么重新生成
 	 	 if(time()>$expires_time){
 	 	 	$url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxff92185282f6a37c&secret=5759e2f3dc26c9addcccd0a8f74498f3';
 	 	 	$json=json_decode($this->http_request($url),true);
 	 	    $expires_time=time()+7100; //最大的token的生存时间
 			$save_token='{"access_token":"'.$json['access_token'].'","expires_time":"'.$expires_time.'"}';
 			$token=$json['access_token'];
 	 	    file_put_contents('access_token.json',$save_token);
 	 	 }
 	 	 return  $token;
 	}
  	public function http_request($url,$data=''){
	    $ch= curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url );
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设置内容是不是返回
	    if(!empty($data)){
	            curl_setopt($ch, CURLOPT_POST, 1); //设置post提交数据
	            curl_setopt($ch,CURLOPT_POSTFIELDS,$data); //设置post提交数据
	    }
	    //判断当前是不是有post数据的发
	    $output=curl_exec($ch);
	    if ($output === FALSE) {
	        $output="curl 错误信息: " . curl_error($ch);
	    }
		    curl_close($ch);
	        return $output;
   }

   public function parse_data($url,$data=''){
		
		if(!empty($data)){
			$res=$this->http_request($url,$data);
		 }else{
		 	$res=$this->http_request($url);
		 }
        if(!empty($res)){
              return json_decode($res);
        }

	}



  }

?>