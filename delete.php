<?php
header("content-type:text/html;charset=utf-8");
$conn=mysqli_connect("******************","************","****************","**********************");
$id=$_GET['id'];
if($conn){
    $sql="delete from kaihua where id ='$id' ";
    $que=mysqli_query($conn,$sql);
    if($que){
        echo"<script>alert('删除成功，返回首页');location.href='main.php';</script>";
    }else{
        echo "<script>alert('删除失败');location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        exit;
    }
}die("数据库连接失败" .mysqli_connect_error());
?>
<?php
/*
 * Created by PhpStorm.
 * User: boom
 * Date: 2018/10/14
 * Time: 21:53
 */
?>
