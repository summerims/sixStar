<?php

 class Broadcast extends Tool{
 	const API_PREVIEW='https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=';

 	const API_SEND_ALL='https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=';

 	const API_SEND='https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=';

 	public  function send($type,$message,$to){
			 
		     $func='send'.ucfirst(strtolower($type));
		     $to=$this->build($to); //解析当前是发送给openid的列表用户还是标签
             if(method_exists($this,$func)){
                   $result=$this->$func($to,$message);
             }else{  
                    $result='方法不存在';
             }
             return  $result;
	}

	public function build($to){
		    
		    if(is_array($to)){ //假设传递的是数组
		     	  $key="touser";
		     	  $value=$to;
		     	  $url=self::API_SEND;
		    }else{
		    	 $key="filter";
		    	 $value=[
				      "is_to_all"=>false,
				      "tag_id"=>$to
				 ];
				 $url=self::API_SEND_ALL;
		    }
		   //21:48 
		   return [$key,$value,$url];

	}

  	//自行修改
    public  function sendNews($openid,$message){
    	$json='{
		   "filter":{
		      "is_to_all":false,
		      "tag_id":"'.$openid.'"
		   },
		   "mpnews":{
		      "media_id":"'.$message.'"
		   },
		    "msgtype":"mpnews",
		    "send_ignore_reprint":1
		}';
	  return  $this->parse_data($url,$json);

    }

    public  function sendText($to,$message){
    	//数组的值转变成两个变量，提取出来
    	list($key,$value,$url)=$to;
    	$url=$url.$this->access_token;
        //公共部分
    	$data=[
    		$key=>$value,  //手动拼接数据
    		"msgtype"=>"text",
		    "text"=> ["content"=>$message]
    	];
	  return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));
    }
 	/**
 	 * [preview description]
 	 * @param  [type] $type    [description]
 	 * @param  [type] $message [description]
 	 * @param  [type] $openid  [description]
 	 * @return [type]          [description]
 	 */
	public  function preview($type,$message,$openid){
		
			 $url=self::API_PREVIEW.$this->access_token;
		     $func='preview'.ucfirst(strtolower($type)); 
                if(method_exists($this,$func)){
                   $result=$this->$func($url,$openid,$message);
                }else{  
                    $result='方法不存在';
                }
                return  $result;
	}

	public  function previewText($url,$openid,$message){
			$data=[
				"touser"=>$openid,
			    "text"=>[           
			           "content"=>$message            
			           ],     
			    "msgtype"=>"text"
			];
		 return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));
	}

	/*图文消息群发预览*/
	public  function previewNews($url,$openid,$message){
			$data=[
				"touser"=>$openid,
			    "mpnews"=>[           
			           "media_id"=>$message            
			           ],     
			    "msgtype"=>"mpnews"
			];
		 return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));

	}

	public  function previewImage($url,$openid,$message){
			
			$data=[
				"touser"=>$openid,
			    "image"=>[           
			           "media_id"=>$message            
			           ],     
			    "msgtype"=>"image"
			];
		 return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));
	}


	public  function previewVoice($url,$openid,$message){
			$data=[
				"touser"=>$openid,
			    "text"=>[           
			           "content"=>$message            
			           ],     
			    "msgtype"=>"text"
			];

		 return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));

	}

   public  function previewVideo($url,$openid,$message){
			$data=[
				"touser"=>$openid,
			    "text"=>[           
			           "content"=>$message            
			           ],     
			    "msgtype"=>"text"
			];
		 return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));
	}



 }