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
    <title>會員訂單查詢</title>
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
		margin-right: 200px;
		margin-left: 200px;
	}
	</style>
    <p align="center" ><b><font size="8">會員訂單查詢</font></b></p>
      <table border="3" align="center" class = "table table-striped" bordercolor="rhba(255,255,255,0)">
        <tr> 
          <td colspan="2" bgcolor="#6666FF" align="center"> 
            <font color="#FFFFFF">
			<?php
				//執行 SELECT 陳述式取得使用者資料
				$sql = "SELECT * FROM users Where id = $id";
				$result = execute_sql($link, "restaurant", $sql);
				$row = mysqli_fetch_assoc($result);
				echo $row{"name"};
				
				$sql = "SELECT * FROM orderlist Where id = $id";
				$result = execute_sql($link, "restaurant", $sql);
				$num = mysqli_num_rows($result);
				
				$sql = "SELECT * FROM users U, orderlist O Where U.id = $id && O.id = $id ORDER BY ordercode ASC";
				$result = execute_sql($link, "restaurant", $sql);
				$row = mysqli_fetch_assoc($result);
				
			?>
			的訂單
			</font>
          </td>
        </tr>
		<?php
		if($num == 0)
		{
			$echostring = "<tr bgcolor='#99FF99'>
								<td align='center'>您尚未預約</td>
						   </tr>";
			echo $echostring;
		}
		for($i=0;$i<$num;$i++)
		{
			$echostring = "<tr bgcolor='#99FF99'>
								<td align='center'>訂單編號</td>
								<td align='center'>".$row{"ordercode"}."</td>
							</tr>
							<tr bgcolor='#99FF99'> 
									<td align='center'>訂單明細</td>
									<td align='center'>";
			echo $echostring;
			$temp = $row{"orderlist"};
			$picture = explode(",", $temp);
			foreach($picture as $value)
			{
				$sql = "SELECT * FROM menu Where foodid = $value";
				$result2 = execute_sql($link, "restaurant", $sql);
				$row2 = mysqli_fetch_assoc($result2);
				echo $row2{"foodname"};
				echo "<br><img src=\""."menu\\".$value.".jpg\" width = '100'><br>";
			}
			echo "</td></tr>";
			$result++;
			$row = mysqli_fetch_assoc($result);
		} 
		?>
		  
        <tr bgcolor="#99FF99"> 
          <td colspan="2" align="CENTER"> 
			<div class="form-group">
				<div class="col-sm-offset-0 col-sm-20">
					<button type="button" class="btn btn-default" onClick='location.href="main.php"'>回上頁</button>
				</div>
			</div>
          </td>
        </tr>
      </table>
  </body>
</html>
<?php
    //釋放資源及關閉資料連接
	if($num != 0)
	{
		mysqli_free_result($result);
		mysqli_free_result($result2);
		mysqli_close($link);
	}
    
  }
?>
