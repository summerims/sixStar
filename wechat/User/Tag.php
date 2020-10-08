<?php
//用户标签管理类
class  Tag extends Tool{

	const API_GET='https://api.weixin.qq.com/cgi-bin/tags/get?access_token=';
	const API_CREATE='https://api.weixin.qq.com/cgi-bin/tags/create?access_token=';
	const API_BATCH_TAG='https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=';
	const API_GET_USERS='https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token=';

	/**
	 * [lists 获取公众平台所有标签]
	 * @return [type] [description]
	 */
	public  function lists(){

		$url=self::API_GET.$this->access_token;
		return  $this->parse_data($url);
	}
	/**
	 * $name 标签名称
	 */

	public function create($name){

		$url=self::API_CREATE.$this->access_token;

		$data=['tag'=>[
				"name" =>$name//标签名
		]];

		return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));

	}                                                 
	/**
	 * 为用户设置标签分组
	 */

	public function batchTagUsers($openid_list,$tag_id){

		$url=self::API_BATCH_TAG.$this->access_token;
		$data=[
			  'openid_list'=>$openid_list,
			  'tagid'=>$tag_id
			  ];
		return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));

	}
   
    //获取单个标签下的用户
	public function users_get_tag($tag_id,$openid=''){

		$url=self::API_GET_USERS.$this->access_token;
		$data=[
			  'tagid'=>$tag_id,
			  'next_openid'=>$openid
			  ];
		return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));

	}

	
}


?>