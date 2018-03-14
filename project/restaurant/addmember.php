<?php
  require_once("dbtools.inc.php");
  
  //取得表單資料
  $account = $_POST["account"];
  $password = $_POST["password"]; 
  $name = $_POST["name"]; 
  $sex = $_POST["sex"];
  $year = $_POST["year"]; 
  $month = $_POST["month"]; 
  $day = $_POST["day"];
  $telephone = $_POST["telephone"]; 
  $cellphone = $_POST["cellphone"]; 	
  $address = $_POST["address"];
  $email = $_POST["email"]; 
  $url = $_POST["url"]; 	
  $comment = $_POST["comment"];

  //建立資料連接
  $link = create_connection();
			
  //檢查帳號是否有人申請
  $sql = "SELECT * FROM users Where account = '$account'";
  $result = execute_sql($link, "restaurant", $sql);

  //如果帳號已經有人使用
  if (mysqli_num_rows($result) != 0)
  {
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result);
		
    //顯示訊息要求使用者更換帳號名稱
    echo "<script type='text/javascript'>";
    echo "alert('您所指定的帳號已經有人使用，請使用其它帳號');";
    echo "history.back();";
    echo "</script>";
  }
	
  //如果帳號沒人使用
  else
  {
    //釋放 $result 佔用的記憶體	
    mysqli_free_result($result);
		
    //執行 SQL 命令，新增此帳號
    $sql = "INSERT INTO users (account, password, name, sex, 
            year, month, day, telephone, cellphone, address,
            email, url, comment) VALUES ('$account', '$password', 
            '$name', '$sex', $year, $month, $day, '$telephone', 
            '$cellphone', '$address', '$email', '$url', '$comment')";

    $result = execute_sql($link, "restaurant", $sql);
  }
	
  //關閉資料連接	
  mysqli_close($link);
  header('refresh:15;url="index.htm"');
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>新增帳號成功</title>
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
		margin-top: 30px;
		margin-right: 200px;
		margin-left: 200px;
	}
	</style>
    <p align="center"><img src="success.png"> 
	<br>	
	<table border='3'  align='center' class = 'table table-striped' bordercolor='rhba(255,255,255,0)'>
		<tr class='info'> 
			<td colspan='2' align='center'> 
				<label><font size='5'>恭喜您已經註冊成功了，您的資料如下：（請勿按重新整理鈕）</font></label>
			</td>
		</tr> 
		<tr> 
			<td align='center'> 
				<label><font size='5'>帳號：</font></label>
			</td>
			<td align='center'>
				 <label><font color="#FF0000" size='5'><?php echo $account ?></font></label>
			</td>
		</tr>
		<tr> 
			<td align='center'> 
				<label><font size='5'>加密後密碼：</font></label>
			</td>
			<td align='center'>
				 <label><font color="#FF0000" size='5'><?php echo $password ?></font></label>
			</td>
		</tr>
		<tr class='danger'> 
			<td colspan='2' align='center'> 
				<label><font size='5'>請牢記您的帳號及密碼，然後再登入網站。</font></label>
			</td>
		</tr>
		<tr>
          <td colspan='2' align="center"> 
			<div class="form-group">
				<div class="col-sm-offset-0 col-sm-0">
					<br>
					<button type="button" class="btn btn-success" onClick='location.href="index.htm"'><label><font size='4'>登入網站</label></font></button>
				</div>
			</div>
          </td>
		</tr>
	</table>
    </p>
  </body>
</html>