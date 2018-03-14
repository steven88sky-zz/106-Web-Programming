<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE["passed"];
	
  /*  如果 cookie 中的 passed 變數不等於 TRUE，
      表示尚未登入網站，將使用者導向首頁 index.htm */
  if ($passed != "TRUE")
  {
    header("location:index.htm");
    exit();
  }
	
  /*  如果 cookie 中的 passed 變數等於 TRUE，
      表示已經登入網站，將使用者的帳號刪除 */	
	else
	{
		require_once("dbtools.inc.php");
		$id = $_COOKIE["id"];
		
		
		@$order = $_POST["order"];
		//建立資料連接
		$link = create_connection();
		if($order != NULL)
		{
			forEach($order as $value)
			{
				$sql = "DELETE FROM orderlist Where ordercode = '$value'";
				$result = execute_sql($link, "restaurant", $sql);
			}
		}
		
		
		
    //關閉資料連接
    mysqli_close($link);
	
  }
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>會員取消定位成功</title>
  </head>
  <body>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style type="text/css"> 
	body
	{
		background-color:rgba(255,255,255,0.8);
		background-image: url("restaurant.jpg");
		background-blend-mode: lighten;
		margin-bottom: 100px;
		margin-top: 80px;
		margin-right: 200px;
		margin-left: 200px;
	}
	</style>
	<?php
	if($order != NULL)
	{
		header('refresh:5;url="main.php"');
	?>
    <p align="center"><img src="erase.png"></p>
    <p align="center">
      <label><font size='5'>您的訂單已從本站中刪除，若要再次訂位，請重新預約，謝謝。</font></label>
    </p>
	<?php
	}else
	{
	?>
	<p align="center"><img src="erase.png"></p>
    <p align="center">
      <label><font size='5'>您尚未勾選任何訂單</font></label>
    </p>
	<?php
	header('refresh:3;url="cancelconfirm.php"');
	}
	?>
  </body>
</html>