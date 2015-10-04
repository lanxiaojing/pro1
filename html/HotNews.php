<?php
header("Content-Type: text/html; charset=UTF-8");
$data["username"]=array("蓝小静1号","蓝小静2号","蓝小静3号");
$data["userimg"]=array("../img/wallhaven256004.jpg","","");
$data["imgurl"]=array("../img/wallhaven256004.jpg,../img/wallhaven256004.jpg","../img/wallhaven-256856.jpg","../img/wallhaven256004.jpg");
$data["word"]=array("我终于会说中文了","好高兴","么么哒");
$data=json_encode($data);
echo $data;