<?php

  //永久素材管理类
  class Material extends Tool{

     const API_UPLOAD='https://api.weixin.qq.com/cgi-bin/material/add_material';
     const API_NEWS='https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=';

     const API_BATCH='https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=';

  	 public  function get($mediaId){
  	      /*$url=' https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->access_token.'&media_id='.$mediaId;
          $this->http_request($url);*/
          $media_id=['media_id'=>$mediaId];
  	 }

     public function batchget($type,$offset,$count){
          $data=[
                "type"=>$type,
                "offset"=>$offset,
                "count"=>$count
          ];
          $url=self::API_BATCH.$this->access_token;
          $res=$this->http_request($url,json_encode($data,JSON_UNESCAPED_UNICODE));
          if(!empty($res)){
              return json_decode($res);
          }
     }

  	 /*上传语音*/
  	 public function uploadVoice(){
     }
     
  	 public function uploadImage($fileName){
          
          $url='https://api.weixin.qq.com/cgi-bin/material/add_material?access_token='.$this->access_token.'&type=image';
        
          $data=['media'=>new CURLFile(realpath($fileName))];

          $res=$this->http_request($url,$data);

          if(!empty($res)){
              return json_decode($res);
          }
  	 }

      // __call

     /*上传视频*/
  	 public function uploadVideo($fileName,$title,$introduction){
         $url=self::API_UPLOAD.'?access_token='.$this->access_token.'&type=video';
          $data=[
                 'media'=>new CURLFile(realpath($fileName)),
                 'description'=>json_encode([
                      "title"=>$title, 
                      "introduction"=>$introduction
                  ],JSON_UNESCAPED_UNICODE)
          ];
          $res=$this->http_request($url,$data);
          if(!empty($res)){
              return json_decode($res);
          }
  	 }


     public function uploadNews($media_id){
           /*{
              "articles": [{
                   "title": TITLE,
                   "thumb_media_id": THUMB_MEDIA_ID,
                   "author": AUTHOR,
                   "digest": DIGEST,
                   "show_cover_pic": SHOW_COVER_PIC(0 / 1),
                   "content": CONTENT,
                   "content_source_url": CONTENT_SOURCE_URL
                },
                //若新增的是多图文素材，则此处应还有几段articles结构
             ]
            }*/
          $article['articles'][]=[
                   "title"=>'这是一篇神奇的文章',
                   "thumb_media_id"=>$media_id,
                   "author"=>'peter',
                   "digest"=>"我是摘要",
                   "show_cover_pic"=>1,
                   "content"=>'测试神奇的文章',
                   "content_source_url"=>'www.liuxingedu.com'
          ];
          $url=self::API_NEWS.$this->access_token;
          $res=$this->http_request($url,json_encode($article,JSON_UNESCAPED_UNICODE));
          
          if(!empty($res)){
              return json_decode($res);
          }

     }


     





  }

?>