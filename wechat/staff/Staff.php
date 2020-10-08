<?php
 /*客服管理类*/


 class Staff extends Tool{

 	const API_CREATE='https://api.weixin.qq.com/customservice/kfaccount/add?access_token=';

 	const API_INVITE='https://api.weixin.qq.com/customservice/kfaccount/inviteworker?access_token=';

 	const API_LINE='https://api.weixin.qq.com/cgi-bin/customservice/getonlinekflist?access_token=';

 	
	




    /**
     * [create 添加账号的操作]
     * @param  [type] $kf_account [description]
     * @param  [type] $nickname   [description]
     * @return [type]             [description]
     */
 	 public  function create($kf_account,$nickname){
 	 	
 	 	$url=self::API_CREATE.$this->access_token;

 	 	$data=[
           "kf_account" =>$kf_account,
           "nickname" => $nickname
        ];

	    return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));
    }


    /**
     * [getOnLineList 获取客服的在线状态]
     * @return [type] [description]
     */
 	public  function getOnLineList(){
 	 	$url=self::API_LINE.$this->access_token;
	    return  $this->parse_data($url);
    }

    /**
     * [uploadhead 上传客服头像]
     * @param  [type] $kf_account [description]
     * @return [type]             [description]
     */
    public  function uploadhead($fileName,$kf_account){

 	 	$url=self::API_UPLOAD_HEAD.$this->access_token.'&kf_account='.$kf_account;
        $data=['media'=>new CURLFile(realpath($fileName))];
	    return  $this->parse_data($url,$data);

    }


     /**
      * [invite 邀请微信用户成为客服]
      * @param  [type] $kf_account [description]
      * @param  [type] $nickname   [description]
      * @return [type]             [description]
      */
     public  function invite($kf_account,$wx){
     	 	$url=self::API_INVITE.$this->access_token;
     	 	
     	 	$data=[
               "kf_account" =>$kf_account,
               "invite_wx" => $wx
            ];
    	    return  $this->parse_data($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        }
 }
