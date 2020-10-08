<?php
	session_start();
	header('content-type:text/html;charset=utf-8');
	include 'Tool.php';
	include 'xml.php';
	include 'wx.php';
	include 'Qrcode/Qrcode.php';
	include 'Oauth/Oauth.php';
	$obj=new wx();
	$auth=$obj->oauth;

	$config=[
        'appid'=>'wxff92185282f6a37c',
        'appsecret'=>'5759e2f3dc26c9addcccd0a8f74498f3'
   ];

  
  //获取用户信息
  $user=$auth->config($config)->user());
  $_SESSION['user']=$user;

?>