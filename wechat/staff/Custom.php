<?php
/*客服消息类*/
class Coustom extends Tool{


	const API_SEND='https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=';
 	
 	/*获得当前用户发送的消息内容*/
 	public function message($message){
 			$this->message=$message;
 			return $this;
 	}
 	/**
 	 * [to 发送到哪一个客户上]
 	 * @return [type] [description]
 	 */
 	public function to($openId){
 			$this->to=$openId;
 			return $this;
 	}
  

   /* public function a1(){


   }
    //举栗子,我有多少的数据要写多少个方法
    $custom->message('我是peter')->to('openId')->a1()->a2()->a3()->send('text');
    */

 	/**
 	 * [send 发送消息到指定的客户]
 	 * @param  [type] $type    [消息类型]
 	 * @param  [type] $message [消息内容]
 	 * @param  [type] $to      [发送给谁]
 	 * @return [type]          [description]
 	 */
    public  function send($type){
    	
		     $func='send'.ucfirst(strtolower($type));
             if(method_exists($this,$func)){
                   $result=$this->$func();
             }else{  
                    $result='方法不存在';
             }
             return  $result;
             
	}

	public  function sendText(){
    	$url=self::API_SEND.$this->access_token;
    	$data=[
			    "touser"=>$this->to,
			    "msgtype"=>"text",
			    "text"=>
			    [
			         "content"=>$this->message
			    ]
    	];
	   return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));
    }

    //客服会话管理，消息转发，以及群发限制

    public  function sendNews($openid,$message){
	  return  $this->parse_data($url,$json);
    }
   

    /*
    	消息发送，测试号可以，主动消息发送

     */

    

}