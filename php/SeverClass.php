<?php
header( 'charset=utf-8 ');
//创建数据表类
class createTable{
    //创建数据表info，记录ID,用户名，昵称,密码，好友，上一次登录时间
    public function createInfo(){
        $servername='localhost';
        $username='root';
        $password='';
        $databasename='test';
        try{
            $conn=new PDO("mysql:host=$servername;dbname=$databasename",$username,$password);
            $sql="create table info(id int(6) not null auto_increment primary key,
            username varchar(50) not null,
            passward varchar(50) not null,
            nickname varchar(50) not null,
            frends varchar(5000),
            t TIMESTAMP(0) DEFAULT CURRENT_TIMESTAMP);";
            $conn->exec($sql);
            echo 'success creat info table!';
        }
        catch(PDOException $e){
            $e->getMessage();
            return 0;
        }
        $conn=null;
        return 1;
    }
    //创建数据表person，接收数据表名，记录ID,图片地址，图片名字，文本，上传时间
    public function createPerson($tbname){
        $servername='localhost';
        $username='root';
        $password='';
        $databasename='test';
        try{
            $conn=new PDO("mysql:host=$servername;dbname=$databasename",$username,$password);
            // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql="create table $tbname (id int(6) not null auto_increment primary key,
            imgurl varchar(100),
            imgname varchar(100),
            words varchar(500),
            t TIMESTAMP(0) DEFAULT CURRENT_TIMESTAMP);";
            $conn->exec($sql);

        }
        catch(PDOException $e){
            $e->getMessage();
            return 0;
        }
        $conn=null;
        return 1;
    }
}
//插入数据类
class insertData{
    //插入用户信息
    function insertInfo($username,$password,$nickname,$frends){
        $servername='localhost';
        $dusername='root';
        $dpassword='';
        $databasename='test';
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$databasename", $dusername, $dpassword);
            $sql="insert into info(username,passward,nickname,frends)VALUES('$username','$password','$nickname','$frends')";
            $conn->exec($sql);
            /*            echo $username.'注册成功';*/
        }
        catch(PDOException $e){
            $e->getMessage();
            return 0;
        }
        $conn=null;
        //同时生成一个用户自己的数据表：
        $fa=new createTable();
        if(($fa->createPerson($nickname))==1){
            /*           echo 'create'.$nickname.'table!';*/
            return 1;
        }
        return 2;


    }
    //插入用户资源信息
    function insertPerson($tbname,$imgurl,$imgname,$words){
        $servername='localhost';
        $dusername='root';
        $dpassword='';
        $databasename='test';
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$databasename", $dusername, $dpassword);
            $sql="insert into $tbname(imgurl,imgname,words)VALUES('$imgurl','$imgname','$words')";
            $conn->exec($sql);
            /*            echo $tbname.'资源录入成功';*/
            $conn=null;
            return 1;
        }
        catch(PDOException $e){
            $e->getMessage();
            $conn=null;
            return 0;
        }
    }

    //为用户添加朋友
    function addFrend($user,$frend){

    }

}
/*$b=new createTable();
$b->createInfo();*/

/*$a=new insertData();
$a->insertInfo('2222@qq.com','2222','ye','1111@qq.com,3333@qq.com');
$a->insertPerson('ye','/picture/two.png,/picture/tree.png','two,tree','sandtpicturetry');*/





?>

