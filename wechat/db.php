<?php
    
   $mod=new PDO('mysql:host=localhost;dbname=anli','root','');
   //设置编码
   $mod->exec('set names utf8');