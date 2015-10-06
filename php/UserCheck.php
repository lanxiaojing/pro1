<?php
//验证邮箱是否注册
$userValue=$_POST["userValue"];
//先过滤用户输入的内容
$userValue=strip_tags($userValue);
//开始判断
$a=UserCheck($userValue);
echo $a;
function UserCheck($userValue){
    $servername='localhost';
    $dusername='root';
    $dpassword='';
    $databasename='test';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$databasename", $dusername, $dpassword);
        $sql = "select * from info where nickname='$userValue'";
        $result1 = $conn->query($sql);
        $result1->setFetchMode(PDO::FETCH_ASSOC);//设置返回格式为关联数组
        $row = $result1->fetch();
        $result = $result1->rowCount();//统计结果数
        if ($result != 0) {
            $conn = null;
            return 0;//用户存在
        }
        else{
            return 1;
        }
    }
    catch(PDOException $e){
        $e->getMessage();
        $conn=null;
        return 0;
    }
}

