<?php
header("Content-type: text/html; charset=utf-8");
//账号密码正确性检查类
//验证码验证状态说明： 0：验证码错误；1：成功
//密码验证状态值返回说明： 0：账号密码为空，1：没有该账号，2：密码错误，3：正确，4：数据库连接异常
class check{
    public $userInfo=array();
    public function yanzhengmacheck($yanzhengma1,$yanzhengma){
        if($yanzhengma==$yanzhengma1){
            return 1;
        }
        return 0;
    }
    public function match($name,$mima){
        //验证登陆文件
        $servername='localhost';
        $username='root';
        $password='';
        $databasename='test';

        //账号密码转义
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            return $data;
        }
        $a= test_input($name);
        $b=test_input($mima);

        //验证账号密码是否为空
        if(!$a||!$b)
        {
            return 0;//账号密码为空
        }
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
            $conn->query('set names utf8');//连接数据库
            $sql = "select * from info where username='$a'";
            $result1 = $conn->query($sql);
            $result1->setFetchMode(PDO::FETCH_ASSOC);//设置返回格式为关联数组
            $row = $result1->fetch();
            $result = $result1->rowCount();//统计结果数
            if ($result == 0) {
                $conn=null;
                return 1;//无用户
            }
            if ($row['passward'] != $b)//判断密码是否正确
            {
                $conn=null;
                return 2;//密码错误
            }
            $conn=null;
            $this->userInfo=$row;
            return 3;//一切正常
        }
        catch(PDOException $e){
            $e->getMessage();
            $conn=null;
            return 4;//数据库有问题
        }

    }

}

//实例化
$a=new check();
$c = $a->match($_POST["userName"], $_POST["passwords"]);
if($c==3){
    session_start();
    $_SESSION['user']=$_POST["userName"];
    $_SESSION['nickName']=$a->userInfo['nickname'];
    echo '你好'.$_SESSION['nickName'].'将于1秒钟后跳转'.'<br>';
    echo "<script>
function go(){window.location='../html/index.html';}
window.setTimeout(go,1000)</script>'";
}
if($c==2){
    echo"<script>alert('密码错误！');</script>";
    echo "<script>window.location='../html/signUp.html';</script>";
}
if($c==1){
    echo"<script>alert('无该用户！！');</script>";
    echo "<script>window.location='../html/signUp.html';</script>";
}
else if($c==4){
    echo"<script>alert('未知错误！');</script>";
    echo "<script>window.location='../html/signUp.html';</script>";
}
?>