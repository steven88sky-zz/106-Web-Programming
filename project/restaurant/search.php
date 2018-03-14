<?php
  require_once("dbtools.inc.php");
  header("Content-type: text/html; charset=utf-8");
  
  //取得表單資料
  $account = $_POST["account"]; 

  //建立資料連接
  $link = create_connection();
			
  //檢查查詢的帳號是否存在
  $sql = "SELECT name, password FROM users WHERE 
          account = '$account'";
  $result = execute_sql($link, "restaurant", $sql);

  //如果帳號不存在
  if (mysqli_num_rows($result) == 0)
  {
    //顯示訊息告知使用者，查詢的帳號並不存在
    echo "<script type='text/javascript'>
            alert('您所查詢的資料不存在，請檢查是否輸入錯誤。');
            history.back();
          </script>";
  }
  else  //如果帳號存在
  {
    $row = mysqli_fetch_object($result);
    $name = $row->name;
    $password = $row->password;
    $message = "
      <!doctype html>
      <html>
        <head>
          <title></title>
          <meta charset='utf-8'>
        </head>
        <body>
			<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
			<style type='text/css'> 
			body
			{
				background-color:rgba(255,255,255,0.8);
				background-image: url('restaurant.jpg');
				background-blend-mode: lighten;
				margin-bottom: 100px;
				margin-top: 100px;
				margin-right: 350px;
				margin-left: 350px;
			}
			</style>
			<table border='3'  align='center' class = 'table table-striped' bordercolor='rhba(255,255,255,0)'>
				<tr class='info'> 
					<td colspan='2' align='center'> 
						<label><font size='5'>$name 您好，您的帳號資料如下：</font></label>
					</td>
				</tr>
				<tr bgcolor='#99FF99'> 
					<td align='left'><label><font size = '5'>帳號：</font></label></td>
					<td><label><font size = '5'>$account</font></label></td>
				</tr>
				<tr bgcolor='#99FF99'> 
					<td align='left'><label><font size = '5'>加密後密碼：</font></label></td>
					<td><label><font size = '5'>$password</font></label></td>
				</tr>
				<td colspan='2' align='center'> 
					<div class='form-group'>
						<div class='col-sm-offset-0 col-sm-0'>
							<br>
							<button type='button' class='btn btn-primary' onClick='location.href=\"main.php\"'><label><font size = '3'>回上頁</font></label></font></label></button>
						</div>
					</div>
				</td>
			</table>
        </body>
      </html>
    ";
      echo $message;   //顯示訊息告知使用者帳號密碼
  }

  //釋放 $result 佔用的記憶體
  mysqli_free_result($result);
		
  //關閉資料連接	
  mysqli_close($link);
?>