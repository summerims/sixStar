<?php
 /*
 	用来生成自定义菜单的类
  */
 class Menu extends Tool{

 	 public function add($buttons,$matchRule=''){
 	 	//根据不同的用户生成个性化的菜单
 	 	if(!empty($matchRule)){
	 	 	$url='https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token='.$this->access_token;
	 	 	//因为微信自定义菜单不支持\uxxx类型我的数据，所以 加上JSON_UNESCAPED_UNICODE，不让中文转义
	 	 	$json=json_encode(['button'=>$buttons,'matchrule'=>$matchRule],JSON_UNESCAPED_UNICODE);


	 	 	return  $this->http_request($url,$json);
 	 	}

 	 	$url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->access_token;
 	 	$json=json_encode(['button'=>$buttons],JSON_UNESCAPED_UNICODE);
 	 	return  $this->http_request($url,$json);
 	 }
	 public function all(){
	 	
	 }
	 /**
	 *  [destory 删除菜单]
	 *  @param  string $menuId [菜单id]
	 *  @return [type]         [description]
	 */
	public function destory($menuId=''){
			if(empty($menuId)){
				$url='https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$this->access_token;
				return json_decode($this->http_request($url),true);
			}else{
				$url='https://api.weixin.qq.com/cgi-bin/menu/delconditional?access_token='.$this->access_token;
				return json_decode($this->http_request($url,json_encode(['menuid'=>$menuId])),true);
			}
	}


	




 }


?>