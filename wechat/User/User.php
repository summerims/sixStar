<?php
  class User extends Tool{

  	const API_GET='https://api.weixin.qq.com/cgi-bin/user/info';

  	const API_BATCH_GET='https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token=';

  	const API_REMARK='https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token=';

  	const API_BATCH_BLACK_LIST='https://api.weixin.qq.com/cgi-bin/tags/members/batchblacklist?access_token=';

  	
  
	/**
	 * [获取单个用户的信息]
	 * @return [type] [description]
	 */
	public  function get($openid,$lang='zh_CN'){

		$url=self::API_GET.'?access_token='.$this->access_token.'&openid='.$openid.'&lang='.$lang;
		return  $this->parse_data($url);
	}

	/**
	 * [batchGet 批量获取用户的信息]
	 * @param  [type] $openid_list [description]
	 * @return [type]              [description]
	 */
	public  function batchGet($openid_list,$lang="zh_CN"){

		$url=self::API_BATCH_GET.$this->access_token;

        //匿名函数默认是不能得到外面的变量的内容
        $data['user_list']=array_map(

        	function($openid) use ($lang) {  //引用外部的变量
        	    return [
				        "openid"=>$openid, 
                        "lang"=>$lang
        		];
        	  },$openid_list);

		return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));

	}

	/**
	 * [remark 设置用户标签]
	 * @param  [type] $openid [description]
	 * @param  [type] $remark [description]
	 * @return [type]         [description]
	 */
	public  function remark($openid,$remark){


		$url=self::API_REMARK.$this->access_token;
        $data=[    
            "openid"=>$openid,
            "remark"=>$remark
        ];

		return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));

	}

	/**
	 * 加入黑名单
	 * $openid_list 用户列表
	 */

	public  function blackList($openid_list){


		$data['openid_list']=$openid_list;


		$url=self::API_BATCH_BLACK_LIST.$this->access_token;
		return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));

		



	}



    //22:20



  }

