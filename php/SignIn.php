<?php
header( 'Content-Type:text/html;charset=utf-8 ');
//写入注册信息
include 'SeverClass.php';
class regist{
    function insertdatabase($username,$password,$nickname){
        $servername='localhost';
        $dusername='root';
        $dpassword='';
        $databasename='test';
        //先过滤字段
        $a=$username;
        $b=$password;
        $c=$nickname;
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$databasename", $dusername, $dpassword);
            $sql = "select * from info where username='$a'";
            $result1 = $conn->query($sql);
            $result1->setFetchMode(PDO::FETCH_ASSOC);//设置返回格式为关联数组
            $row = $result1->fetch();
            $result = $result1->rowCount();//统计结果数
            if ($result != 0) {
                $conn=null;
                return 1;//用户存在
            }
            $sql = "select * from info where username='$c'";
            $result1 = $conn->query($sql);
            $result1->setFetchMode(PDO::FETCH_ASSOC);//设置返回格式为关联数组
            $row = $result1->fetch();
            $result = $result1->rowCount();//统计结果数
            if ($result != 0) {
                $conn=null;
                return 1;//昵称存在
            }
        }
        catch(PDOException $e){
            $e->getMessage();
            $conn=null;
            return 3;
        }
        $classa=new insertData();
        if(($classa->insertInfo($username,$password,$nickname,''))==1){
            return 2;
        }
        return 4;
    }
}
/*
0：验证码错误
1：用户存在
2：成功
3：数据库连接异常
4:写入异常
*/
//实例化测试
$a=new regist();
if(($a->insertdatabase($_POST["Email"],$_POST["pwd"],$_POST["newUser"]))==2){
    echo '你好新用户'.$_POST["newUser"].'将于1秒钟后跳转'.'<br>';
    echo "<script>
function go(){window.location='../html/signUp.html';}
window.setTimeout(go,1000)</script>";
}
else{
    echo "<script>
alert('注册失败!');
window.location='../html/signIn.html'
</script>";
}

?>