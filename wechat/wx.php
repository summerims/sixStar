<?php

/**
 * [response 响应回复消息]
 * @return [type] [description]
 */
class Wx{

    public $objText=null; //文本
    public $ToUserName;//开发者账号
    public $FromUserName;//用户账号
    //模板属性
    public $obj=null;//接收微信发送过来的消息

    //调用不存在或者没有权限访问的属性触发,相关的对象操作类只在需要的时候才加载
    public function __get($name){
        $name=ucfirst(strtolower($name)); //先转换成小写，然后首字母大小
        if(class_exists($name)){
            return new $name; 
        }
    }




    /**
     * $func 是一个匿名函数
     */
    /*处理消息得到结果（xml）,返回结果*/
    public function setMessageHandle($func){
            
            $data=$GLOBALS['HTTP_RAW_POST_DATA']; //获取微信发送过来
            $this->logInfo('J'.$data);
            if(empty($data))exit;
            $this->obj=simplexml_load_string($data,'SimpleXMLElement',LIBXML_NOCDATA);
            echo $func($this->obj);  //打印输出的就是一个xml

    }

    
    public function response(){
                $data=$GLOBALS['HTTP_RAW_POST_DATA']; //获取微信发送过来
                $this->logInfo('J'.$data);
                if(empty($data))exit;
                $this->obj=simplexml_load_string($data,'SimpleXMLElement',LIBXML_NOCDATA); //接收到的的数据转换成对象了

                $this->ToUserName=$this->obj->ToUserName;//开发者账号
                $this->FromUserName=$this->obj->FromUserName;//用户账号
                $content=trim($this->obj->Content); //内容
                $msgType=$this->obj->MsgType;
        
                //拼接一个函数名是变量
                $func='handle'.ucfirst($msgType); 
                if(method_exists('Wx',$func)){
                   $result=$this->$func();
                }else{  
                    $result='方法不存在';
                }
                echo $result;//微信捕获到
                 //加一个标记，标记是写入还是发送
                $this->logInfo('S'.$result); 
                //10:07
        }
    /**
     * [valid 验证接入的函数]
     * @return [type] [description]
     */
     public  function valid(){
            $signature=$_GET['signature']; //加密签名
            $timestamp=$_GET['timestamp'];//时间戳
            $nonce=$_GET['nonce'];//随机数
            $echostr=$_GET['echostr'];//随机字符串
             //对数组排序
            $arr=[$timestamp,$nonce,TOKEN];
            sort($arr,SORT_STRING);
            $str=sha1(implode($arr));
             //该请求是来源于微信
            if($signature==$str){
                echo $echostr;
            }
        }

     /**
     * [logInfo 日志记录]
     * $message  日志内容
     * $fileName 文件名称
     * @return [type] [description]
     */
    private function logInfo($message,$fileName='log'){
        $debugInfo=debug_backtrace();
        //时间
        $message=date('Y-m-d H:i:s').PHP_EOL.$message.PHP_EOL;
        //哪一个文件，哪一行
        $message.='['.$debugInfo[0]['file'].']'.' line '.$debugInfo[0]['line'].PHP_EOL;
        //每一天来打包日志
        file_put_contents($fileName.'-'.date('Y-m-d').'.log',$message,FILE_APPEND);
    }

}

?>