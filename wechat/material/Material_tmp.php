<?php
  //临时素材管理类
  class Material_tmp extends Tool{

  	 /*临时素材文件*/
  	 public  function get($mediaId){
  	      $url=' https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->access_token.'&media_id='.$mediaId;
          $this->http_request($url);
  	 }

  	 /*上传语音*/
  	 public function uploadVoice(){
  	 
     }
  	 public function uploadImage($fileName){
          $url='https://api.weixin.qq.com/cgi-bin/media/upload?access_token='.$this->access_token.'&type=image';
           //上传临时的素材，必须要给的参数  //CURLFile 用于跟curl来配合使用的类
          $data=['media'=>new CURLFile(realpath($fileName))];
          $res=$this->http_request($url,$data);
          if(!empty($res)){
              return json_decode($res);
          }
  	 }
  	 
  	 public function uploadVideo(){

  	 }

     





  }

?>