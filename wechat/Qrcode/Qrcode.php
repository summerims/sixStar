<?php
  class Qrcode extends Tool{


  	/*获取带参数的二维码的过程包括两步，
  	  首先创建二维码ticket，
  	然后凭借ticket到指定URL换取二维码。*/
  	 const API_CREATE='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=';
  	 const API_TICKET='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=';

  	 
  	  /**
  	   * $scene 场景值
  	   * $expire 时间
  	   */
  	  
  	  public function temporary($scene,$expire){
  	  		//为什么要把数据提取出来原因是什么，生成临时的二维码，数据内容会改变
  	  		
  	  		if(is_int($scene)){ //通过判断参数的类型确定当前的二维码生成的场景类型
				$scene=array (
			      'scene_id' =>$scene,
			    );
			    $action_name='QR_SCENE';
  	  		}else{
  	  			$scene=array (
			      'scene_str' =>$scene,
			    );
			    $action_name='QR_STR_SCENE';
  	  		}
  	  		
  	  	  return  $this->create($scene,$action_name,$expire);
  	  }

     //专门用来创建的方法  
  	  public function create($scene,$action_name,$expire=''){

  	  	//下面的这段代码都是重复的
  	  	$data=array (
			  'action_name' =>$action_name ,
			  'action_info' => 
			  array (
			    'scene' =>$scene
			  )
		);
  	  		//判断过器时间
		if(!empty($expire)){
  	  			$data['expire_seconds']=$expire;
  	  	}
  	  	$url=self::API_CREATE.$this->access_token;
 	 	return $this->parse_data($url,json_encode($data));//发送数据
  	  }


  	  /**
  	   * [forever 永久二维码]
  	   * @return [type] [description]
  	   */
  	  public function forever($scene){

  	  		if(is_int($scene)){ //通过判断参数的类型确定当前的二维码生成的场景类型
				$scene=array (
			      'scene_id' =>$scene,
			    );
			    $action_name='QR_LIMIT_SCENE';
  	  		}else{
  	  			$scene=array (
			      'scene_str' =>$scene,
			    );
			    $action_name='QR_LIMIT_STR_SCENE';
  	  		}
  	  		return  $this->create($scene,$action_name);

  	  }

  	  public function url($ticket){
 	 	 return  self::API_TICKET.$ticket;//发送数据
  	 }





  }