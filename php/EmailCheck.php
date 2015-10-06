<?php
//验证邮箱是否注册
$email=$_POST['email'];
//先过滤用户输入的内容
$email=strip_tags($email);
//开始判断
$a=EmailCheck($email);
echo $a;
function EmailCheck($email){
    $servername='localhost';
    $dusername='root';
    $dpassword='';
    $databasename='test';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$databasename", $dusername, $dpassword);
        $sql = "select * from info where username='$email'";
        $result1 = $conn->query($sql);
        $result1->setFetchMode(PDO::FETCH_ASSOC);//设置返回格式为关联数组
        $result = $result1->rowCount();//统计结果数
        if ($result != 0) {
            $conn = null;
            return 0;//用户存在
        }
        else {
            return 1;
        }
    }
    catch(PDOException $e){
            $e->getMessage();
            $conn=null;
            echo 0;
            return 0;
        }
}

