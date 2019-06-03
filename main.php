<?php
session_start();
header("content-type:text/html;charset=utf-8");
$page=isset($_GET['page']) ?$_GET['page'] :1 ;
$page=!empty($page) ? $page :1;
$conn=mysqli_connect("*************","**********","**************","**************");
mysqli_set_charset($conn,'utf8');
$table_name="kaihua";
$perpage=7;
$total_sql="select count(*) from $table_name";
$total_result =mysqli_query($conn,$total_sql);
$total_row=mysqli_fetch_row($total_result);
$total = $total_row[0];
$total_page = ceil($total/$perpage);
$page=$page>$total_page ? $total_page:$page;
$start=($page-1)*$perpage;
$sql= "select * from kaihua order by id desc limit $start ,$perpage";
$result=mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<style>
    .header{
        background:linear-gradient(-142deg, #B0C4DE 10%, #F0FFFF 100%);
        text-align:center;
        padding:5px;
    }

    .header1{
        background:#F0FFFF;
        text-align:center;
        padding:5px;
        margin:0;
        width:490px;
    }

    .y{
        text-align:right;
        position:relative;
        top:80px;
        right:50px;
    }

    .l{
        text-align:center;
    }

    .ss{
        background:#D2E9FF;
        width:50px;
    }

    .tj{
        width: 270px;
        height: 40px;
        border-width: 0px;
        border-radius: 3px;
        background: #1E90FF;
        cursor: pointer;
        outline: none;
        font-family: Microsoft YaHei;
        color: white;
        font-size: 17px;
        position:relative;
        left:100px;
        top:15px;
    }

    .tj1{
        width: 150px;
        height: 40px;
        border-width: 1px;
        border-radius: 3px;
        background: #F5F5F5;
        cursor: pointer;
        outline: none;
        font-family: Microsoft YaHei;
        color: white;
        font-size: 17px;
        position:relative;
        left:15px;
        top:0;
        border-radius:20px;
    }

    .main{
        width:1200px;
        height:900px;
        position:relative;
        left:300px;
    }

    .r{
        width:500px;
        height:730px;
        float:right;
        border-style: solid;
        border-color:grey;
        position:relative;
        top:20px;
        background:linear-gradient(-142deg, #E0FFFF 10%, #F5F5F5 100%);
    }

    .image-one{
        position:absolute;
        left:60px;
        top:15px;
    }

    .image-two{
        position:absolute;
        left:220px;
        top:90px;
    }

    .k1{
        height:30px;
        background:#eeeeee;
        width:470px;
        margin:5px;
        position:relative;
        left:10px;
    }

    .k2{
        height:320px;
        background:#eeeeee;
        width:350px;
        margin:5px;
        position:relative;
        left:0;
        iframe scrolling:yes;
        overflow: scroll;
    }

    .z{
        width:580px;
        height:720px;
        background:#F0F8FF;
        position:absolute;
        top:-10px;;
        right:580px;
        margin:10px;
        padding:5px;
        border:1px solid #CCEFF5;
        border-radius:20px;
    }

    hr.style{
        width:550px;
        margin:0 auto;
        border: 0;
        height: 1px;
        background: #333;
        background-image: linear-gradient(to right, #ccc, #333, #ccc);
    }

    .time{
        float:right;
        text-align:right;
    }

    .pagination-bar {
        font-size: 0px;
        padding: 20px 0px;
        text-align: center;
    }

    .pagination-bar a {
        display: inline-block;
        padding: 5px 7.5px;
        text-decoration: none;
        min-width: 20px;
        font-size: 16px;
    }

    .pagination-bar a:not(.disabled) {
        background-color: #FFF;
        color: #666;
        border: 1px solid #BBBBBB;
    }

    .pagination-bar a.disabled {
        background-color: #666;
        color: #FFF;
        border: 1px solid #444;
    }

    .page-prev {
        border-radius: 15px 0px 0px 15px;
    }

    .page-next {
        border-radius: 0px 15px 15px 0px
    }

    .pagination-bar span:not(.active) {
        display: inline-block;
        padding: 5px 7.5px;
        font-size: 16px;
    }

    label{
        width: 50px;
        display: inline-block;
        text-align: center;
    }

    input#rightcode{
        font-family: Arial;
        font-style: italic;
        color: red;
        padding: 2px 3px;
        letter-spacing: 2px;
        font-weight: bolder;
    }

    .dl{
        position:relative;
        left:110px;
        top:-10px;
    }

    .footer{
        background:linear-gradient(-142deg, #B0C4DE 10%, #F0FFFF 100%);
        text-align:center;
        padding:5px;
        height:45px;
        position:absolute;
        right:0;
        top:750px;
        width:1190px;
    }

    table.imagetable {
        font-family: verdana,arial,sans-serif;
        font-size:11px;
        color:#333333;
        border-width: 1px;
        border-color: #999999;
        border-collapse: collapse;
        width:500px;
        height:120px;
    }
    table.imagetable th {
        background:#E0FFFF url(img/cell-blue.jpg);
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #999999;
    }
    table.imagetable td {
        background:#F0F8FF url(img/cell-grey.jpg);
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #999999;
    }

    canvas {
        background-color: #eee;
        display: block;
        margin: 0 auto;
        position:absolute;
        z-index:0;
        height:960px;
    }
</style>

<head>
    <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js">    //外链js
    </script>
    <script>
        $(document).ready(function(){
            $("button").click(function(){
                $("form").toggle();
            });
        });
        function foo(){
            if(myform.name.value=="")
            {
                alert("请输入你的姓名");   //js弹出对话框
                myform.name.focus();
                return false;
            }
            if (myform.content.value=="")
            {
                alert("留言内容不能为空");
                myform.content.focus();
                return false;
            }
            if(myform.vcode.value==""){
                alert('验证码不能为空');
                myform.vcode.focus();
                return false;
            }
        }
    </script>

</head>
<body>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<canvas id="canvas"></canvas>
<script>
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");
    var cw = canvas.width = window.innerWidth,
        cx = cw / 2;
    var ch = canvas.height = window.innerHeight,
        cy = ch / 2;

    ctx.fillStyle = "#000";
    var linesNum = 16;
    var linesRy = [];
    var requestId = null;

    function Line(flag) {
        this.flag = flag;
        this.a = {};
        this.b = {};
        if (flag == "v") {
            this.a.y = 0;
            this.b.y = ch;
            this.a.x = randomIntFromInterval(0, ch);
            this.b.x = randomIntFromInterval(0, ch);
        } else if (flag == "h") {
            this.a.x = 0;
            this.b.x = cw;
            this.a.y = randomIntFromInterval(0, cw);
            this.b.y = randomIntFromInterval(0, cw);
        }
        this.va = randomIntFromInterval(25, 100) / 100;
        this.vb = randomIntFromInterval(25, 100) / 100;

        this.draw = function() {
            ctx.strokeStyle = "#ccc";
            ctx.beginPath();
            ctx.moveTo(this.a.x, this.a.y);
            ctx.lineTo(this.b.x, this.b.y);
            ctx.stroke();
        }

        this.update = function() {
            if (this.flag == "v") {
                this.a.x += this.va;
                this.b.x += this.vb;
            } else if (flag == "h") {
                this.a.y += this.va;
                this.b.y += this.vb;
            }

            this.edges();
        }

        this.edges = function() {
            if (this.flag == "v") {
                if (this.a.x < 0 || this.a.x > cw) {
                    this.va *= -1;
                }
                if (this.b.x < 0 || this.b.x > cw) {
                    this.vb *= -1;
                }
            } else if (flag == "h") {
                if (this.a.y < 0 || this.a.y > ch) {
                    this.va *= -1;
                }
                if (this.b.y < 0 || this.b.y > ch) {
                    this.vb *= -1;
                }
            }
        }

    }

    for (var i = 0; i < linesNum; i++) {
        var flag = i % 2 == 0 ? "h" : "v";
        var l = new Line(flag);
        linesRy.push(l);
    }

    function Draw() {
        requestId = window.requestAnimationFrame(Draw);
        ctx.clearRect(0, 0, cw, ch);

        for (var i = 0; i < linesRy.length; i++) {
            var l = linesRy[i];
            l.draw();
            l.update();
        }
        for (var i = 0; i < linesRy.length; i++) {
            var l = linesRy[i];
            for (var j = i + 1; j < linesRy.length; j++) {
                var l1 = linesRy[j]
                Intersect2lines(l, l1);
            }
        }
    }

    function Init() {
        linesRy.length = 0;
        for (var i = 0; i < linesNum; i++) {
            var flag = i % 2 == 0 ? "h" : "v";
            var l = new Line(flag);
            linesRy.push(l);
        }

        if (requestId) {
            window.cancelAnimationFrame(requestId);
            requestId = null;
        }

        cw = canvas.width = window.innerWidth,
            cx = cw / 2;
        ch = canvas.height = window.innerHeight,
            cy = ch / 2;

        Draw();
    };

    setTimeout(function() {
        Init();

        addEventListener('resize', Init, false);
    }, 15);

    function Intersect2lines(l1, l2) {
        var p1 = l1.a,
            p2 = l1.b,
            p3 = l2.a,
            p4 = l2.b;
        var denominator = (p4.y - p3.y) * (p2.x - p1.x) - (p4.x - p3.x) * (p2.y - p1.y);
        var ua = ((p4.x - p3.x) * (p1.y - p3.y) - (p4.y - p3.y) * (p1.x - p3.x)) / denominator;
        var ub = ((p2.x - p1.x) * (p1.y - p3.y) - (p2.y - p1.y) * (p1.x - p3.x)) / denominator;
        var x = p1.x + ua * (p2.x - p1.x);
        var y = p1.y + ua * (p2.y - p1.y);
        if (ua > 0 && ub > 0) {
            markPoint({
                x: x,
                y: y
            })
        }
    }

    function markPoint(p) {
        ctx.beginPath();
        ctx.arc(p.x, p.y, 2, 0, 2 * Math.PI);
        ctx.fill();
    }

    function randomIntFromInterval(mn, mx) {
        return ~~(Math.random() * (mx - mn + 1) + mn);
    }</script>
<div class="main">
    <div class="header">
        <form class="y">
            <b>搜索留言：</b>
            <input type="text" name="搜索留言：">
            <form action="/demo/demo_form.asp">
                <select name="ways">
                    <option value="用户名">用户名</option>
                    <option value="关键词">关键词</option>
                </select>
                <input type="submit" value="搜索" class="ss">
            </form>
        </form>
        <div class="image-one">
            <img src="http://p5.sinaimg.cn/2097558524/180/04041366623329"/ width="80px";height="80px">
        </div>
        <div class="l">
            <span style="font-size:80px ;font-family:华文琥珀">留言板</span>
        </div>
    </div>

    <div class="r">
        <div class="header1">
            <span ><b> <a href="" style="font-size:30px;color:#B0C4DE;text-decoration:none;">首页</a></span>
            <span style="font-size:30px;"|</b></span>
            <button class="tj1"><span style="font-size:28px ;color:#D8BFD8"><b>我要留言</button></b></span>
            <div>
                <p1 style="font-size:28px ;color:#1E90F3">精弘网络开发部</p1>
            </div>
        </div>
        </br>
        <div>
            <div class="dl">
                <form method="post"  action="post.php" style="display:none;" onsubmit="return foo();" name="myform" ">
                <div>
                    <label for="name">&emsp;&emsp;&emsp;&emsp;<b>姓名</b></label>
                    <input name="name" type="text"><br/>
                    <label for="name">&emsp;&emsp;&emsp;&emsp;<b>邮箱</b></label>
                    <input name="email" type="email"><br/>
                    <label for="vcode">&emsp;&emsp;&emsp;<b>验证码</b></label>
                    <span><input type="text" name="vcode" id="yan"></span>
                    <span><img src="yzm.php" onClick="this.src='yzm.php?nocache='+Math.random()" style="cursor:hand" width="100px";height="15px" class="image-two"></span>
                    </br></br>
                    <span style="font-family:华文行楷;font-size:20px">&emsp;&emsp;请输入你的留言内容:</span>
                    </br></br>
                    <textarea class="k2"  value="请输入你的留言内容:" cols="30" rows="7" name="content"></textarea>
                    <button input type="submit" value="发送留言" class="tj">发送留言</button>
                </div>
                </form>
            </div>
        </div>


        <div class="z">
            <h1><b>留言内容</b></h1>
            <hr />

            <p>
                <?php
                if($result==null){
                    echo"暂时没有留言";
                }  ?>
            </p>
                <?php
            while($row=mysqli_fetch_array($result)){
            ?>
                <table  class="imagetable" border="1" cellspacing="0">
                <tr>
                    <td>姓名：<?php  echo $row['name']?></td>
                    <td style="text-align: center">留言时间:<?php echo $row['ressage_time']?></td>
                    <td><a href="delete.php?id=<?php echo $row['id']?>" >删除留言</a> </td>
                </tr>
                <tr>
                    <td colspan="3" rowspan="3">你的留言:<?php echo $row['content']?></td>
                </tr>
            </table>
            <?php
            }?>
            <div id="baner" style="margin-top: 20px">
                <a href="<?php
                echo "$_SERVER[PHP_SELF]?page=1"
                ?>">首页</a>
                <a href="<?php
                echo "$_SERVER[PHP_SELF]?page=".($page-1)
                ?>">上一页</a>
                <?php
                for($i=1;$i<=$total_page;$i++){
                    if($i==$page){
                        echo "<a  style='padding: 5px 5px;background: #000;color: #FFF' href='$_SERVER[PHP_SELF]?page=$i'>$i</a>";
                    }else{
                        echo "<a  style='padding: 5px 5px' href='$_SERVER[PHP_SELF]?page=$i'>$i</a>";
                    }
                }
                ?>
                <a href="<?php
                echo "$_SERVER[PHP_SELF]?page=".($page+1)
                ?>">下一页</a>
                <a href="<?php
                echo "$_SERVER[PHP_SELF]?page={$total_page}"
                ?>">末页</a>
                <span>共<?php echo $total?>条</span>
            </div>
        </div>


        <div class="footer">
            <span style="font-family:华文细黑;font-size:25px;"><b>Copyright &#174; 开花三人小分队</b></span>
        </div>

    </div>
</body>
<?php
/*
 * Created by PhpStorm.
 * User: boom
 * Date: 2018/10/14
 * Time: 21:53
 */
?>