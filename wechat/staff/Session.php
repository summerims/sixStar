<?php
/*客服消息会话控制类*/
class Session extends Tool{

	const API_CREATE='https://api.weixin.qq.com/customservice/kfsession/create?access_token=';

	const API_CLOSE='https://api.weixin.qq.com/customservice/kfsession/close?access_token=';

 	
	/**
	 * [create 创建会话]
	 * @param  [type] $kf_account [客服账号]
	 * @param  [type] $openid     [粉丝ID]
	 * @return [type]             [description]
	 */
	public  function create($kf_account,$openid){
    	$url=self::API_CREATE.$this->access_token;
    	
    	$data=[
			    "kf_account" =>$kf_account,
  				"openid"=>$openid
    	];
	   return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));
    }

    //会话关闭
    public  function close($kf_account,$openid){
    	$url=self::API_CLOSE.$this->access_token;
  
    	$data=[
			    "kf_account" =>$kf_account,
  				"openid"=>$openid
    	];
	   return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));
    }
   

   
    

}