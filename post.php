<?php
session_start();
header("content-type:text/html;charset=utf-8");
$name=$_POST['name'];
$email=$_POST['email'];
$content=$_POST['content'];
$vcode=$_POST['vcode'];
if($name==''){
    echo "<script>alert('你来了还不留下名字吗');location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
    exit;
}
if($content==''){

    echo "<script>alert('说几句话吧');location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
    exit;
}
if($vcode!=$_SESSION['VCODE']){

    echo"<script>alert('验证码错了啊老哥');location='".$_SERVER['HTTP_REFERER']. "'</script>";
    exit;
}
$conn=mysqli_connect('111.230.47.239','root','lzc1379lzc1379','liuyanban');
mysqli_set_charset($conn,'utf8');
if($conn){
    $sql=mysqli_prepare($conn,"insert into kaihua(name,email,content,ressage_time) VALUES (?,?,?,now())");
    $param=mysqli_stmt_bind_param($sql,'sss',$name,$email,$content);
    $result=mysqli_stmt_execute($sql);
    if($result){
        echo "<script>alert('留言成功');location.href='main.php';</script>";
    }else{
        echo"<script>alert('你的留言失败，请稍后重试');location.href='main.php';</script>";
        exit;
    }
}else{
    die("数据库连接失败".  mysqli_connect_error());
}
?>
<?php
/*
 * Created by PhpStorm.
 * User: boom
 * Date: 2018/10/14
 * Time: 21:53
 */
?>