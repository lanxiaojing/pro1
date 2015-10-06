<?php

//处理是否是登录用户
header("charset=utf-8");
session_start();
if(isset($_SESSION['nickName'])){
    $a=$_SESSION['nickName'];
}
else {
    $a = "";
}
echo $a;