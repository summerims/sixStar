<?php
/*专门处理文本的消息*/
 class Text{
 	private $obj;
 	public function handleText($message,$content){
 		 $this->obj=$message;
         if (is_array($content)){
	                return  $this->replayNews($content);
	        }else{
	                return  $this->replayText($content);
 	 	 }
 	 }
     
 	 public function replayText($content){
 	 	//返回一个格式化的xml信息
 		$ToUserName=$this->obj->ToUserName;//开发者账号
        $FromUserName=$this->obj->FromUserName;//用户账号
        return sprintf(Xml::getXml('title').Xml::getXml('text'),$FromUserName,$ToUserName,time(),$content);
 	 }
 	 
    public function replayCustom($message){
        //返回一个格式化的xml信息
        $ToUserName=$message->ToUserName;//开发者账号
        $FromUserName=$message->FromUserName;//用户账号
        return sprintf(Xml::getXml('title').Xml::getXml('custom'),$FromUserName,$ToUserName,time());
     }



 	 /*回复图文*/
    public function replayNews($newsArray){
        if(!is_array($newsArray)){
            return "";
        }
        //遍历循环
        $itemTpl=Xml::getXml('news_item');  
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $xmlTpl=Xml::getXml('title').Xml::getXml('news');
        $result = sprintf($xmlTpl, $this->obj->FromUserName, $this->obj->ToUserName, time(), count($newsArray),$item_str);
        return $result;
    }

 }


?>