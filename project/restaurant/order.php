<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE{"passed"};
	
  //如果 cookie 中的 passed 變數不等於 TRUE
  //表示尚未登入網站，將使用者導向首頁 index.htm
  if ($passed != "TRUE")
  {
    header("location:index.htm");
    exit();
  }
	
  //如果 cookie 中的 passed 變數等於 TRUE
  //表示已經登入網站，取得使用者資料	
  else
  {
    require_once("dbtools.inc.php");
		
    $id = $_COOKIE{"id"};
		
    //建立資料連接
    $link = create_connection();
?>
<!doctype html>
<html>
  <head>
    <title>會員訂位</title>
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
		margin-bottom: 100px;
		margin-right: 100px;
		margin-left: 100px;
	}
	</style>
    <p align="center" ><b><font size="8">會員訂位</font></b></p>
    <form class="form-inline" name="dataForm" method="post" action="ordersucceed.php" >
      <table border="3"  align="center" class = "table table-striped" bordercolor="rhba(255,255,255,0)">
	  <?php
		$sql = "SELECT * FROM users Where id = $id";
		$result = execute_sql($link, "restaurant", $sql);
		$row = mysqli_fetch_assoc($result);
		echo "<tr class='info'><td colspan='3' align='center'><label><font size='3'> 親愛的";
		echo $row{'name'};
		echo "您好，請勾選您的訂單</font></label></td></tr>";
		$sql = "SELECT MAX(foodid) FROM menu Where 1";
		$result = execute_sql($link, "restaurant", $sql);
		$max = (int)implode("",mysqli_fetch_assoc($result));
		for($i=1;$i<=$max;$i++)
		{
			//執行 SELECT 陳述式取得使用者資料
			$sql = "SELECT * FROM menu Where foodid = $i";
			$result = execute_sql($link, "restaurant", $sql);
			$row = mysqli_fetch_assoc($result);
			if(($i-1) % 3 == 0)
				echo "<tr>";
			$string = "<td><br><p align='center'><label><font size='3'>";
			$string .= $row{"foodname"};
			echo $string;
			echo "</font></label><br><br><img src=\""."menu\\".$i.".jpg\" width = '300' height = '200'><br><br>";
			echo "<input type='checkbox' name = 'food[]' value = $i></td>";
			if(($i-1) % 3 == 2)
				echo "</tr>";
		}
		?>
	  <td align="center" colspan="3">
		<div class="form-group">
				<div class="col-sm-offset-0 col-sm-20">
					<button type="submit" class="btn btn-primary">送出訂單</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<button type="reset" class="btn btn-default">重填</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<button type="button" class="btn btn-default" onClick='location.href="main.php"'>回上頁</button>
				</div>
			</div>
      </td>
    </form>
  </body>
</html>
<?php
    //釋放資源及關閉資料連接
    mysqli_free_result($result);
    mysqli_close($link);
  }
?>
