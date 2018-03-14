<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE["passed"];
	
  /*  如果 cookie 中的 passed 變數不等於 TRUE
      表示尚未登入網站，將使用者導向首頁 index.htm	*/
  if ($passed != "TRUE")
  {
    header("location:index.htm");
    exit();
  }
?>
<!doctype html>
<html>
  <head>
    <title>我要訂位</title>
    <meta charset="utf-8">
  </head>
  <body>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style type="text/css"> 
	body
	{
		background-color:rgba(255,255,255,0.8);
		background-image: url("restaurant.jpg");
		background-blend-mode: lighten;
	}
	</style>
	<p align="center" ><b><font size="8">會員專區</font></b></p> 
    <p align="center">
      <a href="modify.php"><button type="button" class="btn btn-primary"><font size="5">會員基本資料修改</font></button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="deleteconfirm.php"><button type="button" class="btn btn-primary"><font size="5">會員基本資料刪除</font></button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="orderlist.php"><button type="button" class="btn btn-primary"><font size="5">會員訂單查詢</font></button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="order.php"><button type="button" class="btn btn-primary"><font size="5">會員訂位</font></button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="cancelconfirm.php"><button type="button" class="btn btn-primary"><font size="5">會員取消訂位</font></button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="logout.php"><button type="button" class="btn btn-danger"><font size="5">登出網站</font></button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </p>
  </body>
</html>