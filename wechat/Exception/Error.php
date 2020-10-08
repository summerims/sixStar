<?php
error_reporting(0);//所有的错误都隐藏掉
//注册一个捕获错误的函数（接管）
set_error_handler('error_handler');
//注册一个捕获异常的函数 （接管）
set_exception_handler('exception_handler');
//注册一个脚本终止时会运行的函数,无论有没有错误都会运行
register_shutdown_function('shutdown__handler');
function error_handler($errno,$errstr,$errfile,$errline){
    new Error($errno,$errstr,$errfile,$errline);
}
//Exception 在出现异常的时候，set_exception_handler 有一个动作会注入这个参数
function exception_handler(Exception $e){
    new Error($e->getCode(),$e->getMessage(),$e->getFile(),$e->getLine());
}

//可以捕获致命错误的信息函数
function shutdown__handler(){
     $error=error_get_last(); 
     if(!empty($error)){
       new Error($error['type'],$error['message'],$error['file'],$error['line']);
     }
}
//错误处理类
class Error{
     public function __construct($errno,$errstr,$errfile,$errline){
         $time=date('Y-m-d H:i:s');
         $str=$time."  错误号:{$errno}|错误文件:{$errfile}|错误行号:{$errline}|错误消息:{$errstr}".PHP_EOL;
         $path=__DIR__.'/error'; //错误日志目录
         if(!is_dir($path)) mkdir($path,0755);
         $fileName=$path.'/'.date('Y-m-d').'.log';
         file_put_contents($fileName,$str,FILE_APPEND);
        //echo $errno,$errstr,$errfile,$errline;

     }
}
