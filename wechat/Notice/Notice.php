<?php
 
class Notice extends Tool{

	const API_GET_INDUSTRY='https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token=';

 	const API_SEND='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=';
  
    private $message;  //就是组装数据用的
	/**
	 * [get_industry 获取模板的行业信息]
	 * @return [type] [description]
	 */
	public  function get_industry(){
    	$url=self::API_GET_INDUSTRY.$this->access_token;
    	return  $this->parse_data($url);
    }
    public  function send($data=''){
    	$url=self::API_SEND.$this->access_token;
    	//目标就是利用php的方法拼接一个这样的数据
       if(empty($data)){
       		$data=$this->message;
       	}
       return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));
    }

    /**
     * [__call 魔术方法当调用不存在的方法的时候会调用]
     * @param  [type] $method [调用的方法名]
     * @param  [type] $args   [调用的参数名]
     * @return [type]         [description]
     */
    public function __call($method,$args){

    	   //通过call魔术方法实现数据的拼接

    	   //映射数组，通过外部调用的方法名，来查找到具体的键名是什么
    	   //方法名=>具体要拼接的数据之间的对应关系，确定当前发送模板消息需要哪些数据
    	   $map=[
    	   		'template' =>'template_id',
    	   		'to'=>'touser',
    	   		'link'=>'url',
    	   		'url'=>'url',
    	   		'data'=>'data',
    	   		'wish'=>'data'
    	   ];
    	   //判断方法在数组当中存不存在,不存在就不拼接
    	   if(isset($map[$method])){
    	   		//拼接数组
    	   		$this->message[$map[$method]]=$args[0];
    	   		//$message['url']='www.baidu.com';
    	   }
    	   //echo $map[$method]; //得到具体的键值
           //var_dump($method,$args);
           //echo '------','<br/>';
           return $this;
    }


}

